<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\BobotNilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // =======================
    // INDEX
    // =======================
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.dosen.nilai.index', compact('kelas'));
    }

    // =======================
    // AJAX MATKUL
    // =======================
    public function getMatkulBySemester(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'id_kelas' => 'required'
        ]);

        $matkul = Matakuliah::where('semester', $request->semester)
            ->where(function ($q) use ($request) {
                $q->whereHas('kelas', function ($sub) use ($request) {
                    $sub->where('kelas_matakuliah.id_kelas', $request->id_kelas);
                })->orWhere('tipe_matakuliah', 1);
            })
            ->orderBy('nama_mk')
            ->get(['kode_mk', 'nama_mk']);

        return response()->json($matkul);
    }

    // =======================
    // FORM INPUT NILAI
    // =======================
    public function input($id_kelas, $kode_mk, Request $request)
    {
        $semester = $request->semester;

        // hitung periode & tahun akademik
        $periode = $semester % 2 == 1 ? 'Ganjil' : 'Genap';
        $tahun   = now()->year;

        $tahunAkademik = $periode == 'Ganjil'
            ? "$tahun/" . ($tahun + 1)
            : ($tahun - 1) . "/$tahun";

        // 🔥 AMBIL NIPD YANG SUDAH ADA NILAI
        $nipdSudahDinilai = Nilai::where('id_kelas', $id_kelas)
            ->where('kode_mk', $kode_mk)
            ->where('semester', $semester)
            ->where('tahun_akademik', $tahunAkademik)
            ->pluck('nipd')
            ->toArray();

        // 🔥 AMBIL MAHASISWA YANG BELUM DINILAI
        $mahasiswa = Mahasiswa::where('id_kelas', $id_kelas)
            ->whereNotIn('nipd', $nipdSudahDinilai)
            ->orderBy('nama')
            ->get();

        return view('admin.dosen.nilai.input', compact(
            'mahasiswa',
            'id_kelas',
            'kode_mk',
            'semester',
            'periode',
            'tahunAkademik'
        ));
    }

    // =======================
    // SIMPAN NILAI
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'kode_mk'  => 'required',
            'semester' => 'required',
            'nipd'     => 'required|array'
        ]);

        // NIDN DOSEN LOGIN
        $nidn = auth()->user()->dosen->nidn;

        // periode & tahun akademik
        $semester = $request->semester;
        $periode  = $semester % 2 == 1 ? 'Ganjil' : 'Genap';
        $tahun    = now()->year;

        $tahunAkademik = $periode == 'Ganjil'
            ? "$tahun/" . ($tahun + 1)
            : ($tahun - 1) . "/$tahun";

        // bobot nilai
        $bobot = BobotNilai::where('kode_mk', $request->kode_mk)->firstOrFail();

        foreach ($request->nipd as $i => $nipd) {
            // skip baris kosong
            if (
                $request->nilai_kehadiran[$i] === null &&
                $request->nilai_sikap[$i] === null &&
                $request->nilai_formatif[$i] === null &&
                $request->nilai_tugas[$i] === null &&
                $request->nilai_uts[$i] === null &&
                $request->nilai_uas[$i] === null
            ) {
                continue;
            }

            // hitung nilai akhir
            $nilaiAkhir =
                ($request->nilai_kehadiran[$i] * $bobot->kehadiran / 100) +
                ($request->nilai_sikap[$i]     * $bobot->sikap / 100) +
                ($request->nilai_formatif[$i] * $bobot->formatif / 100) +
                ($request->nilai_tugas[$i]    * $bobot->tugas / 100) +
                ($request->nilai_uts[$i]      * $bobot->uts / 100) +
                ($request->nilai_uas[$i]      * $bobot->uas / 100);

            // konversi mutu
            if ($nilaiAkhir >= 85)      { $mutu = 'A';  $ip = 4; }
            elseif ($nilaiAkhir >= 80)  { $mutu = 'A-'; $ip = 3.75; }
            elseif ($nilaiAkhir >= 75)  { $mutu = 'B+'; $ip = 3.5; }
            elseif ($nilaiAkhir >= 70)  { $mutu = 'B';  $ip = 3; }
            elseif ($nilaiAkhir >= 65)  { $mutu = 'C+'; $ip = 2.5; }
            elseif ($nilaiAkhir >= 60)  { $mutu = 'C';  $ip = 2; }
            elseif ($nilaiAkhir >= 50)  { $mutu = 'D';  $ip = 1; }
            else                        { $mutu = 'E';  $ip = 0; }

            Nilai::create([
                'nidn'           => $nidn,
                'nipd'           => $nipd,
                'nama_mhs'       => $request->nama_mhs[$i],
                'id_kelas'       => $request->id_kelas,
                'kode_mk'        => $request->kode_mk,
                'semester'       => $semester,
                'periode'        => $periode,
                'tahun_akademik' => $tahunAkademik,
                'nilai_kehadiran'=> $request->nilai_kehadiran[$i],
                'nilai_sikap'    => $request->nilai_sikap[$i],
                'nilai_formatif' => $request->nilai_formatif[$i],
                'nilai_tugas'    => $request->nilai_tugas[$i],
                'nilai_uts'      => $request->nilai_uts[$i],
                'nilai_uas'      => $request->nilai_uas[$i],
                'nilai_akhir'    => round($nilaiAkhir, 2),
                'mutu'           => $mutu,
                'bobot_ip'       => $ip,
            ]);
        }

        // 🔥 REDIRECT BENAR (BUKAN /nilai/store)
        return redirect()
    ->route('nilai.input', [
        'id_kelas' => $request->id_kelas,
        'kode_mk'  => $request->kode_mk,
        'semester' => $request->semester
    ])
    ->with('success', 'Nilai berhasil disimpan');

    }

    public function view($id_kelas, $kode_mk, $semester)
{
    $nilai = \App\Models\Nilai::where('id_kelas', $id_kelas)
        ->where('kode_mk', $kode_mk)
        ->where('semester', $semester)
        ->get();

    return view('admin.dosen.nilai.view', compact(
        'nilai',
        'id_kelas',
        'kode_mk',
        'semester'
    ));
}

public function edit($id_nilai)
{
    $nilai = Nilai::findOrFail($id_nilai);

    return view('admin.dosen.nilai.edit', compact('nilai'));
}


public function update(Request $request, $id_nilai)
{
    $request->validate([
        'nilai_kehadiran' => 'required|numeric|min:0|max:100',
        'nilai_sikap'     => 'required|numeric|min:0|max:100',
        'nilai_formatif' => 'required|numeric|min:0|max:100',
        'nilai_tugas'    => 'required|numeric|min:0|max:100',
        'nilai_uts'      => 'required|numeric|min:0|max:100',
        'nilai_uas'      => 'required|numeric|min:0|max:100',
    ]);

    $nilai = Nilai::findOrFail($id_nilai);

    $bobot = BobotNilai::where('kode_mk', $nilai->kode_mk)->firstOrFail();

    $nilaiAkhir =
        ($request->nilai_kehadiran * $bobot->kehadiran / 100) +
        ($request->nilai_sikap     * $bobot->sikap / 100) +
        ($request->nilai_formatif * $bobot->formatif / 100) +
        ($request->nilai_tugas    * $bobot->tugas / 100) +
        ($request->nilai_uts      * $bobot->uts / 100) +
        ($request->nilai_uas      * $bobot->uas / 100);

    if ($nilaiAkhir >= 85)      { $mutu = 'A';  $ip = 4; }
    elseif ($nilaiAkhir >= 80)  { $mutu = 'A-'; $ip = 3.75; }
    elseif ($nilaiAkhir >= 75)  { $mutu = 'B+'; $ip = 3.5; }
    elseif ($nilaiAkhir >= 70)  { $mutu = 'B';  $ip = 3; }
    elseif ($nilaiAkhir >= 65)  { $mutu = 'C+'; $ip = 2.5; }
    elseif ($nilaiAkhir >= 60)  { $mutu = 'C';  $ip = 2; }
    elseif ($nilaiAkhir >= 50)  { $mutu = 'D';  $ip = 1; }
    else                        { $mutu = 'E';  $ip = 0; }

    $nilai->update([
        'nilai_kehadiran'=> $request->nilai_kehadiran,
        'nilai_sikap'    => $request->nilai_sikap,
        'nilai_formatif' => $request->nilai_formatif,
        'nilai_tugas'    => $request->nilai_tugas,
        'nilai_uts'      => $request->nilai_uts,
        'nilai_uas'      => $request->nilai_uas,
        'nilai_akhir'    => round($nilaiAkhir, 2),
        'mutu'           => $mutu,
        'bobot_ip'       => $ip,
    ]);

    return redirect()
        ->back()
        ->with('success', 'Nilai berhasil diperbarui');
}

}
