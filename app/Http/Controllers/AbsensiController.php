<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Show Rekap Absensi page (server-side, GET form).
     */
    public function index(Request $request)
    {
        // --- Filter options ---
        $programStudiList = ProgramStudi::orderBy('nama_program_studi')->get();

        $kelasList = Kelas::with('programStudi')
            ->orderBy('nama_kelas')
            ->get();

        $angkatanList = Mahasiswa::whereNotNull('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        $semesterList = collect(range(1, 8));

        // --- Active filters ---
        $id_program_studi = $request->input('id_program_studi');
        $id_kelas         = $request->input('id_kelas');
        $angkatan         = $request->input('angkatan');
        $semester         = $request->input('semester');

        $hasFilters = $request->hasAny(['id_program_studi', 'id_kelas', 'angkatan', 'semester']);

        $mahasiswaRows = collect();
        $matkulList    = [];

        if ($hasFilters) {
            // Step 1: Get matching mahasiswa based on filter
            $query = Mahasiswa::query()->orderBy('nama_mhs');

            if ($id_program_studi) {
                $query->where('id_program_studi', $id_program_studi);
            }
            if ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            }
            if ($angkatan) {
                $query->where('angkatan', $angkatan);
            }

            $mahasiswaList = $query->get(['id_mahasiswa', 'nipd', 'nama_mhs', 'id_kelas']);

            if ($mahasiswaList->isNotEmpty()) {
                $idList  = $mahasiswaList->pluck('id_mahasiswa')->toArray();
                $kelasIds = $mahasiswaList->pluck('id_kelas')->unique()->filter()->toArray();

                // Step 2: Query absensi_lkm joined with matakuliah
                $absensiQuery = DB::table('absensi_lkm as a')
                    ->join('matakuliah as mk', 'a.id_mk', '=', 'mk.id_mk')
                    ->whereIn('a.id_mahasiswa', $idList)
                    ->select(
                        'a.id_mahasiswa',
                        'a.id_mk',
                        'mk.nama_mk',
                        'a.status'
                    );

                // Filter by id_kelas if selected
                if ($id_kelas) {
                    $absensiQuery->where('a.id_kelas', $id_kelas);
                } elseif (!empty($kelasIds)) {
                    $absensiQuery->whereIn('a.id_kelas', $kelasIds);
                }

                // Filter by semester via matakuliah.semester
                if ($semester) {
                    $absensiQuery->where('mk.semester', $semester);
                }

                $absensiRecords = $absensiQuery->get();

                // Step 3: Build unique matkul list (sorted by nama_mk)
                $matkulMap = [];
                foreach ($absensiRecords as $rec) {
                    $matkulMap[$rec->id_mk] = $rec->nama_mk;
                }
                asort($matkulMap);
                foreach ($matkulMap as $idMk => $nama) {
                    $matkulList[] = ['id_mk' => $idMk, 'nama_mk' => $nama];
                }

                // Step 4: Build pivot [id_mahasiswa][id_mk] => [hadir, total]
                $pivot = [];
                foreach ($absensiRecords as $rec) {
                    $idMhs = $rec->id_mahasiswa;
                    $idMk  = $rec->id_mk;
                    if (!isset($pivot[$idMhs][$idMk])) {
                        $pivot[$idMhs][$idMk] = ['hadir' => 0, 'total' => 0];
                    }
                    $pivot[$idMhs][$idMk]['total']++;
                    if ($rec->status === 'Hadir') {
                        $pivot[$idMhs][$idMk]['hadir']++;
                    }
                }

                // Step 5: Build output rows — % kehadiran per matkul
                $mahasiswaRows = $mahasiswaList->map(function ($mhs) use ($matkulList, $pivot) {
                    $nilaiPerMatkul = [];
                    $values = [];

                    foreach ($matkulList as $mk) {
                        $idMk = $mk['id_mk'];
                        if (isset($pivot[$mhs->id_mahasiswa][$idMk]) && $pivot[$mhs->id_mahasiswa][$idMk]['total'] > 0) {
                            $pct = round(
                                ($pivot[$mhs->id_mahasiswa][$idMk]['hadir'] / $pivot[$mhs->id_mahasiswa][$idMk]['total']) * 100,
                                1
                            );
                            $nilaiPerMatkul[$idMk] = $pct;
                            $values[] = $pct;
                        } else {
                            $nilaiPerMatkul[$idMk] = null;
                        }
                    }

                    $mhs->nilai_per_matkul = $nilaiPerMatkul;
                    $mhs->rata_rata        = count($values) > 0
                        ? round(array_sum($values) / count($values), 1)
                        : null;
                    return $mhs;
                });

                // Filter out students with no absensi data at all
                $mahasiswaRows = $mahasiswaRows->filter(
                    fn($m) => collect($m->nilai_per_matkul)->filter()->isNotEmpty()
                )->values();
            }
        }

        return view('akademik.rekap_absensi', compact(
            'programStudiList',
            'kelasList',
            'angkatanList',
            'semesterList',
            'mahasiswaRows',
            'matkulList',
            'id_program_studi',
            'id_kelas',
            'angkatan',
            'semester',
            'hasFilters'
        ));
    }
}
