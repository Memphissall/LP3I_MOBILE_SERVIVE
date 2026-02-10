<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiLkm;
use App\Models\Kelas;
use App\Models\Pendidik;
use App\Models\Honor;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class AbsensiLkmController extends Controller
{
    // Pilih kelas dulu sebelum buat absensi/LKM
    public function pilihKelasMK()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.pendidik.absensi.pilih', compact('kelas'));
    }

    // Ambil matkul berdasarkan semester dan kelas
    public function getMatkulBySemester(Request $request)
{
    $request->validate([
        'id_kelas' => 'required',
        'semester' => 'required'
    ]);

    $kelas = Kelas::findOrFail($request->id_kelas);

    $matkul = Matakuliah::where('id_program_studi', $kelas->id_program_studi)
        ->where('semester', $request->semester)
        ->orderBy('nama_mk')
        ->get(['id_mk', 'nama_mk']);

    return response()->json($matkul);
}


    // Form input absensi per kelas
    public function create($id_kelas, $id_mk, $semester)
    {
        $kelas = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();
        $mahasiswa = Mahasiswa::where('id_kelas', $id_kelas)->get();

       $pertemuanTerakhir = AbsensiLkm::where('id_mk', $id_mk)
        ->where('id_kelas', $id_kelas)
        ->max('pertemuan') ?? 0;


        if ($pertemuanTerakhir >= 14) {
            return redirect()->back()
                ->with('error', 'Pertemuan sudah mencapai batas maksimal (14)');
        }

        $pertemuanSkrg = $pertemuanTerakhir + 1;
        $sks = $matkul->sks;
        $durasiJam = $sks;
        $durasiMenit = $sks * 60;

        return view('admin.pendidik.absensi.index', compact(
            'mahasiswa',
            'kelas',
            'matkul',
            'id_kelas',
            'id_mk',
            'pertemuanSkrg',
            'semester',
            'sks',
            'durasiJam',
            'durasiMenit'
        ));
    }

    // Simpan absensi per kelas
    public function storeAbsen(Request $request, $id_kelas, $id_mk)
{
    if (!$request->absensi) {
        return back()->with('error', 'Pilih absensi mahasiswa.');
    }

    $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();
    $id_pendidik = $pendidik->id_pendidik;
    $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();
    $sks = $matkul->sks;
    $tanggal = now()->toDateString();


    // ======================
    // SIMPAN ABSENSI
    // ======================
    foreach ($request->absensi as $nipd => $status) {

    $mhs = Mahasiswa::where('nipd', $nipd)->firstOrFail();

    AbsensiLkm::create([
        'id_pendidik'  => $id_pendidik,
        'id_kelas'     => $mhs->id_kelas,
        'id_mk'        => $id_mk,
        'id_kelas'    => $id_kelas,
        'id_mahasiswa' => $mhs->id_mahasiswa, 
        'tanggal'      => $tanggal,
        'pertemuan'    => $request->pertemuan,
        'nama_mhs'     => $mhs->nama_mhs,
        'status'       => $status
    ]);
}
// =====================
    // HITUNG HONOR (FIX)
    // =====================
    $honorPerSesi = (float) $pendidik->rate_gaji; // DARI MIGRASI
   $jumlahSesi = $matkul->sks / 2;

    $honorMengajar = $jumlahSesi * $honorPerSesi;

    $biayaSoal   = $request->uang_pembuatan_soal ?? 0;
    $biayaKoreksi = $request->uang_koreksi_jawaban ?? 0;

    $totalKotor = $honorMengajar + $biayaSoal + $biayaKoreksi;
    $ppn = intval($totalKotor * 0.05);
    $gajiBersih = $totalKotor - $ppn;

    // =====================
    // SIMPAN KE TABEL HONOR
    // =====================
    Honor::create([
        'id_pendidik' => $pendidik->id_pendidik,
        'id_kelas'    => $id_kelas,
        'id_mk'       => $id_mk,
        'pertemuan'   => $request->pertemuan,
        'tanggal'     => $tanggal,
        'semester'    => $request->semester,
        'tahun'       => date('Y'),

        'sks' => $sks,
        'honor_per_sesi' => $honorPerSesi,
        'honor_mengajar' => $honorMengajar,

        'biaya_pembuatan_soal' => $biayaSoal,
        'biaya_koreksi_jawaban' => $biayaKoreksi,

        'total_kotor' => $totalKotor,
        'ppn' => $ppn,
        'gaji_bersih' => $gajiBersih,
    ]);

    // =====================
    // UPDATE TOTAL GAJI
    // =====================
    $totalGaji = Honor::where('id_pendidik', $pendidik->id_pendidik)
        ->sum('gaji_bersih');

    $pendidik->update([
        'total_gaji_diterima' => $totalGaji
    ]);

    return redirect()->route(
        'admin.pendidik.lkm.form',
        [$id_kelas, $id_mk, $request->semester]
    )->with('success', 'Absensi & honor berhasil disimpan.');
}

    




  public function totalGaji()
{
    $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();

    $honor = Honor::with([
            'matkul.kelas'
        ])
        ->where('id_pendidik', $pendidik->id_pendidik)
        ->orderBy('tanggal', 'desc')
        ->get();

    $total = $honor->sum('gaji_bersih');

    return view('admin.pendidik.gaji', compact('honor', 'total'));
}



    // Form buat LKM
    public function createLkm($id_kelas, $id_mk, $semester)
    {
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();
        $pertemuanSkrg = AbsensiLkm::where('id_mk', $id_mk)
            ->where('id_kelas', $id_kelas)
            ->max('pertemuan');

        $sks = $matkul->sks;
        $durasiJam = $sks;
        $durasiMenit = $sks * 60;

        return view('admin.pendidik.lkm.form', compact(
            'id_kelas',
            'id_mk',
            'semester',
            'pertemuanSkrg',
            'sks',
            'durasiJam',
            'durasiMenit'
        ));
    }

    // Edit LKM
    public function editLkm($id_kelas, $id_mk, $pertemuan)
    {
        $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        $lkm = AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('id_mk', $id_mk)
            ->where('id_kelas', $id_kelas)
            ->where('pertemuan', $pertemuan)
            ->firstOrFail();

        return view('admin.pendidik.lkm.edit', compact(
            'lkm',
            'id_kelas',
            'id_mk',
            'pertemuan'
        ));
    }

    // Simpan LKM
    public function storeLkm(Request $request, $id_kelas, $id_mk)
    {
        $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('id_mk', $id_mk)
            ->where('id_kelas', $id_kelas)
            ->where('pertemuan', $request->pertemuan)
            ->update([
                'materi'          => $request->materi,
                'catatan'         => $request->catatan,
                'metode_mengajar' => $request->metode_mengajar
            ]);

        return redirect()
            ->route('pendidik.lkm.list', [$id_kelas, $id_mk])
            ->with('success', 'Data LKM berhasil diperbarui.');
    }

    // List LKM per kelas
    public function listLkm($id_kelas, $id_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();
        $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        $riwayatLkm = AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('id_mk', $id_mk)
            ->where('id_kelas', $id_kelas)
            ->select('pertemuan','tanggal','materi','metode_mengajar')
            ->groupBy('pertemuan','tanggal','materi','metode_mengajar')
            ->orderBy('pertemuan')
            ->get();

        return view('admin.pendidik.lkm.view', compact(
            'riwayatLkm',
            'kelas',
            'matkul',
            'id_kelas',
            'id_mk'
        ));
    }

    // Hapus LKM
    public function destroy($id_kelas, $id_mk, $pertemuan)
    {
        AbsensiLkm::where('id_mk', $id_mk)
            ->where('id_kelas', $id_kelas)
            ->where('pertemuan', $pertemuan)
            ->delete();

        return redirect()->back()->with('success', 'LKM berhasil dihapus.');
    }

    // Detail absensi per kelas
    public function detailAbsensi($id_kelas, $id_mk, $pertemuan)
    {
        $kelas = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();

        $absensi = AbsensiLkm::join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'absensi_lkm.id_mahasiswa')
            ->where('absensi_lkm.id_mk', $id_mk)
            ->where('absensi_lkm.id_kelas', $id_kelas)
            ->where('absensi_lkm.pertemuan', $pertemuan)
            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama_mhs','absensi_lkm.status')
            ->orderBy('mahasiswa.nama_mhs')
            ->get();

        $rekap = (object) [
            'hadir' => $absensi->where('status', 'Hadir')->count(),
            'izin'  => $absensi->where('status', 'Izin')->count(),
            'sakit' => $absensi->where('status', 'Sakit')->count(),
            'alpha' => $absensi->where('status', 'Alpha')->count(),
        ];

        return view('admin.pendidik.lkm.detail', compact(
            'kelas',
            'matkul',
            'absensi',
            'rekap',        
            'pertemuan'
        ));
    }
}
