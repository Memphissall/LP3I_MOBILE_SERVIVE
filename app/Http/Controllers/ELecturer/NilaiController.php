<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\BobotNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    // =======================
    // INDEX
    // =======================
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.pendidik.nilai.index', compact('kelas'));
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

    //  TENTUKAN TAHUN AKADEMIK (HARUS SAMA DENGAN STORE)
    $periode  = $semester % 2 == 1 ? 'Ganjil' : 'Genap';
    $tahun    = now()->year;

    $tahunAkademik = $periode == 'Ganjil'
        ? "$tahun/" . ($tahun + 1)
        : ($tahun - 1) . "/$tahun";

    /**
     * =====================================
     * AMBIL NIPD YANG SUDAH PUNYA NILAI
     * =====================================
     */
    $nipdSudahInput = Nilai::where('id_kelas', $id_kelas)
        ->where('kode_mk', $kode_mk)
        ->where('semester', $semester)
        ->where('tahun_akademik', $tahunAkademik)
        ->pluck('nipd');

    /**
     * =====================================
     * AMBIL MAHASISWA YANG BELUM PUNYA NILAI
     * =====================================
     */
    $mahasiswa = Mahasiswa::where('id_kelas', $id_kelas)
        ->whereNotIn('nipd', $nipdSudahInput)
        ->orderBy('nama_mhs')
        ->get();

    /**
     * =====================================
     * HITUNG ALPHA (TETAP)
     * =====================================
     */
  $tidakHadirCount = DB::table('absensi_lkm')
    ->where('kode_mk', $kode_mk)
    ->whereIn('status', ['Alpha', 'Sakit', 'Izin'])
    ->groupBy('nipd')
    ->pluck(DB::raw('COUNT(*)'), 'nipd');


    // $nilaiKehadiran = [];
    // foreach ($mahasiswa as $mhs) {
    //     $alpha = $alphaCount[$mhs->nipd] ?? 0;
    //     $nilai = 100 - ($alpha * 5);
    //     $nilaiKehadiran[$mhs->nipd] = max($nilai, 0);
    // }
$totalPertemuan = 14;
$nilaiPerPertemuan = 100 / $totalPertemuan;

$nilaiKehadiran = [];

foreach ($mahasiswa as $mhs) {
    $tidakHadir = $tidakHadirCount[$mhs->nipd] ?? 0;
    $nilai = 100 - ($tidakHadir * $nilaiPerPertemuan);


    if ($nilai < 0) {
        $nilai = 0;
    }
$nilaiKehadiran[$mhs->nipd] = max(round($nilai, 2), 0);

}

    return view('admin.pendidik.nilai.input', compact(
        'mahasiswa',
        'id_kelas',
        'kode_mk',
        'semester',
        'nilaiKehadiran'
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

    $id_pendidik = auth()->user()->pendidik->id_pendidik;

    $semester = $request->semester;
    $periode  = $semester % 2 == 1 ? 'Ganjil' : 'Genap';
    $tahun    = now()->year;

    $tahunAkademik = $periode == 'Ganjil'
        ? "$tahun/" . ($tahun + 1)
        : ($tahun - 1) . "/$tahun";

    foreach ($request->nipd as $i => $nipd) {

         $fields = [
        'nilai_sikap',
        'nilai_formatif',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
    ];

    $filled = 0;

    foreach ($fields as $field) {
        if (
            isset($request->$field[$i]) &&
            $request->$field[$i] !== ''
        ) {
            $filled++;
        }
    }

    // ❌ sebagian diisi → STOP TOTAL
    if ($filled > 0 && $filled < count($fields)) {
        return back()
            ->withErrors([
                'error' => 'Ada mahasiswa yang nilainya belum lengkap.'
            ])
            ->withInput();
    }

    // ✅ kosong semua → lewati
    if ($filled === 0) {
        continue;
    }
    
        /**
         * ===============================
         *  HITUNG JUMLAH ALPHA
         * ===============================
         */
        $jumlahTidakHadir = DB::table('absensi_lkm')
        ->where('nipd', $nipd)
        ->where('kode_mk', $request->kode_mk)
        ->whereIn('status', ['Alpha', 'Sakit', 'Izin'])
        ->count();


        /**
         * ===============================
         *  NILAI KEHADIRAN (DEFAULT 100)
         * ===============================
         */
        // $nilaiKehadiran = 100 - ($jumlahAlpha * 7.14);
        // if ($nilaiKehadiran < 0) {
        //     $nilaiKehadiran = 0;
        // }
       $nilaiPerPertemuan = 100 / 14;

        $nilaiKehadiran = 100 - ($jumlahTidakHadir * $nilaiPerPertemuan);

        if ($nilaiKehadiran < 0) {
            $nilaiKehadiran = 0;
        }


        /**
         * ===============================
         * NILAI AKHIR
         * ===============================
         */
        $nilaiSikap     = $request->nilai_sikap[$i]     ?? 0;
        $nilaiTugas     = $request->nilai_tugas[$i]     ?? 0;
        $nilaiFormatif  = $request->nilai_formatif[$i]  ?? 0;
        $nilaiUTS       = $request->nilai_uts[$i]       ?? 0;
        $nilaiUAS       = $request->nilai_uas[$i]       ?? 0;

        $nilaiAkhir =
            ($nilaiKehadiran * 0.05) +
            ($nilaiSikap     * 0.05) +
            ($nilaiTugas     * 0.15) +
            ($nilaiFormatif  * 0.20) +
            ($nilaiUTS       * 0.25) +
            ($nilaiUAS       * 0.30);


        /**
         * ===============================
         *  KONVERSI MUTU
         * ===============================
         */
        if ($nilaiAkhir >= 85)      { $mutu = 'A';  $ip = 4.00; }
        elseif ($nilaiAkhir >= 80)  { $mutu = 'A-'; $ip = 3.60; }
        elseif ($nilaiAkhir >= 75)  { $mutu = 'B+'; $ip = 3.30; }
        elseif ($nilaiAkhir >= 70)  { $mutu = 'B';  $ip = 3.00; }
        elseif ($nilaiAkhir >= 65)  { $mutu = 'B-'; $ip = 2.60; }
        elseif ($nilaiAkhir >= 60)  { $mutu = 'C+'; $ip = 2.30; }
        elseif ($nilaiAkhir >= 55)  { $mutu = 'C';  $ip = 2.00; }
        elseif ($nilaiAkhir >= 50)  { $mutu = 'C-'; $ip = 1.60; }
        elseif ($nilaiAkhir >= 45)  { $mutu = 'D';  $ip = 1.30; }
        else                        { $mutu = 'E';  $ip = 1.00; }

        Nilai::create([
            'id_pendidik'           => $id_pendidik,
            'nipd'           => $nipd,
            'nama_mhs'       => $request->nama_mhs[$i],
            'id_kelas'       => $request->id_kelas,
            'kode_mk'        => $request->kode_mk,
            'semester'       => $semester,
            'periode'        => $periode,
            'tahun_akademik' => $tahunAkademik,
            'nilai_kehadiran'=> $nilaiKehadiran,
            'nilai_sikap'    => $nilaiSikap,
            'nilai_tugas'    => $nilaiTugas,
            'nilai_formatif' => $nilaiFormatif,
            'nilai_uts'      => $nilaiUTS,
            'nilai_uas'      => $nilaiUAS,

            'nilai_akhir'    => round($nilaiAkhir, 2),
            'mutu'           => $mutu,
            'bobot_ip'       => $ip,
        ]);
    }

    return redirect()
        ->route('nilai.input', [
            'id_kelas' => $request->id_kelas,
            'kode_mk'  => $request->kode_mk,
            'semester' => $semester
        ])
        ->with('success', 'Nilai berhasil disimpan');
}


    public function view($id_kelas, $kode_mk, $semester)
{
    $nilai = Nilai::where('id_kelas', $id_kelas)
        ->where('kode_mk', $kode_mk)
        ->where('semester', $semester)
        ->get();

    $matakuliah = Matakuliah::where('kode_mk', $kode_mk)->first();

    return view('admin.pendidik.nilai.view', compact(
        'nilai',
        'matakuliah',
        'id_kelas',
        'kode_mk',
        'semester'
    ));
}


public function edit($id_nilai)
{
    $nilai = Nilai::findOrFail($id_nilai);

    return view('admin.pendidik.nilai.edit', compact('nilai'));
}


public function update(Request $request, $id_nilai)
{
    $request->validate([
        'nilai_kehadiran' => 'required|numeric|min:0|max:100',
        'nilai_sikap'     => 'required|numeric|min:0|max:100',
        'nilai_tugas'    => 'required|numeric|min:0|max:100',
        'nilai_formatif' => 'required|numeric|min:0|max:100',
        'nilai_uts'      => 'required|numeric|min:0|max:100',
        'nilai_uas'      => 'required|numeric|min:0|max:100',
    ]);

    $nilai = Nilai::findOrFail($id_nilai);

    //  HITUNG NILAI AKHIR (FIX)
    $nilaiAkhir =
        ($request->nilai_kehadiran * 0.05) +
        ($request->nilai_sikap     * 0.05) +
        ($request->nilai_tugas    * 0.15) +
        ($request->nilai_formatif * 0.20) +
        ($request->nilai_uts      * 0.25) +
        ($request->nilai_uas      * 0.30);

    //  KONVERSI MUTU
    if ($nilaiAkhir >= 85)      { $mutu = 'A';  $ip = 4.00; }
    elseif ($nilaiAkhir >= 80)  { $mutu = 'A-'; $ip = 3.60; }
    elseif ($nilaiAkhir >= 75)  { $mutu = 'B+'; $ip = 3.30; }
    elseif ($nilaiAkhir >= 70)  { $mutu = 'B';  $ip = 3.00; }
    elseif ($nilaiAkhir >= 65)  { $mutu = 'B-'; $ip = 2.60; }
    elseif ($nilaiAkhir >= 60)  { $mutu = 'C+'; $ip = 2.30; }
    elseif ($nilaiAkhir >= 55)  { $mutu = 'C';  $ip = 2.00; }
    elseif ($nilaiAkhir >= 50)  { $mutu = 'C-'; $ip = 1.60; }
    elseif ($nilaiAkhir >= 45)  { $mutu = 'D';  $ip = 1.30; }
    else                        { $mutu = 'E';  $ip = 1.00; }

    $nilai->update([
        'nilai_kehadiran'=> $request->nilai_kehadiran,
        'nilai_sikap'    => $request->nilai_sikap,
        'nilai_tugas'    => $request->nilai_tugas,
        'nilai_formatif' => $request->nilai_formatif,
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
