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
            'semester' => 'required',
            'id_kelas' => 'required',
        ]);

        $matkul = Matakuliah::where('semester', $request->semester)
            ->where(function ($q) use ($request) {
                $q->whereHas('kelas', function ($sub) use ($request) {
                    $sub->where('kelas_matakuliah.id_kelas', $request->id_kelas);
                })
                ->orWhere('tipe_matakuliah', 1);
            })
            ->orderBy('nama_mk')
            ->get(['kode_mk', 'nama_mk']);

        return response()->json($matkul);
    }

    // Form input absensi per kelas
    public function create($id_kelas, $kode_mk, $semester)
    {
        $kelas = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();
        $mahasiswa = Mahasiswa::where('id_kelas', $id_kelas)->get();

        $pertemuanTerakhir = AbsensiLkm::where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->max('id_pertemuan') ?? 0;

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
            'kode_mk',
            'pertemuanSkrg',
            'semester',
            'sks',
            'durasiJam',
            'durasiMenit'
        ));
    }

    // Simpan absensi per kelas
    public function storeAbsen(Request $request, $id_kelas, $kode_mk)
{
    if (!$request->absensi) {
        return back()->with('error', 'Pilih absensi mahasiswa.');
    }

    $pendidik = Pendidik::where('user_id', Auth::id())->firstOrFail();
    $id_pendidik = $pendidik->id_pendidik;
    $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();
    $tanggal = now()->toDateString();


    // ======================
    // SIMPAN ABSENSI
    // ======================
    foreach ($request->absensi as $nipd => $status) {
        $mhs = Mahasiswa::where('nipd', $nipd)->first();

        AbsensiLkm::create([
            'id_pendidik'         => $id_pendidik,
            'id_kelas'     => $mhs->id_kelas,
            'kode_mk'      => $kode_mk,
            'tanggal'      => $tanggal,
            'id_pertemuan' => $request->id_pertemuan,
            'nipd'         => $nipd,
            'nama_mhs'     => $mhs->nama_mhs,
            'status'       => $status
        ]);
    }

    // ======================
    // HITUNG HONOR PENDIDIK
    // ======================
   $honorMengajar = $matkul->sks * $pendidik->honor_per_sks;

$uangSoal = $request->uang_pembuatan_soal ?? 0;
$uangKoreksi = $request->uang_koreksi_jawaban ?? 0;

$totalBruto = $honorMengajar + $uangSoal + $uangKoreksi;

$ppn = intval($totalBruto * 0.05);
$gajiBersih = $totalBruto - $ppn;

Honor::create([
    'id_pendidik' => $id_pendidik,
    'kode_mk' => $kode_mk,
    'semester' => $request->semester,
    'tahun' => date('Y'),
    'id_pertemuan' => $request->id_pertemuan,
    'tanggal' => now()->toDateString(),

    'sks' => $matkul->sks,
    'honor_per_sks' => $pendidik->honor_per_sks,

    'honor_mengajar' => $honorMengajar,
    'uang_pembuatan_soal' => $uangSoal,
    'uang_koreksi_jawaban' => $uangKoreksi,

    'total_bruto' => $totalBruto,
    'ppn' => $ppn,
    'gaji_bersih' => $gajiBersih,
]);


   

    // ======================
    // UPDATE TOTAL GAJI PENDIDIK
    // ======================
    $total = Honor::where('id_pendidik', $id_pendidik)->sum('gaji_bersih');

    $pendidik->update([
        'total_gaji_diterima' => $total
    ]);


    return redirect()->route(
        'admin.pendidik.lkm.form',
        [$id_kelas, $kode_mk, $request->semester]
    )->with('success', 'Absensi & honor berhasil disimpan.');
}




    public function totalGaji()
{
    $pendidik = Pendidik::where('user_id', Auth::id())->firstOrFail();

    $honor = Honor::where('id_pendidik', $pendidik->id_pendidik)->get();

    $total = $honor->sum('gaji_bersih');

    return view('admin.pendidik.gaji', compact('honor', 'total'));
}



    // Form buat LKM
    public function createLkm($id_kelas, $kode_mk, $semester)
    {
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();
        $pertemuanSkrg = AbsensiLkm::where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->max('id_pertemuan');

        $sks = $matkul->sks;
        $durasiJam = $sks;
        $durasiMenit = $sks * 60;

        return view('admin.pendidik.lkm.form', compact(
            'id_kelas',
            'kode_mk',
            'semester',
            'pertemuanSkrg',
            'sks',
            'durasiJam',
            'durasiMenit'
        ));
    }

    // Edit LKM
    public function editLkm($id_kelas, $kode_mk, $id_pertemuan)
    {
        $pendidik = Pendidik::where('user_id', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        $lkm = AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->where('id_pertemuan', $id_pertemuan)
            ->firstOrFail();

        return view('admin.pendidik.lkm.edit', compact(
            'lkm',
            'id_kelas',
            'kode_mk',
            'id_pertemuan'
        ));
    }

    // Simpan LKM
    public function storeLkm(Request $request, $id_kelas, $kode_mk)
    {
        $pendidik = Pendidik::where('user_id', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->where('id_pertemuan', $request->id_pertemuan)
            ->update([
                'materi'          => $request->materi,
                'catatan'         => $request->catatan,
                'metode_mengajar' => $request->metode_mengajar
            ]);

        return redirect()
            ->route('pendidik.lkm.list', [$id_kelas, $kode_mk])
            ->with('success', 'Data LKM berhasil diperbarui.');
    }

    // List LKM per kelas
    public function listLkm($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();
        $pendidik = Pendidik::where('user_id', Auth::id())->firstOrFail();
        $id_pendidik = $pendidik->id_pendidik;

        $riwayatLkm = AbsensiLkm::where('id_pendidik', $id_pendidik)
            ->where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->select('id_pertemuan','tanggal','materi','metode_mengajar')
            ->groupBy('id_pertemuan','tanggal','materi','metode_mengajar')
            ->orderBy('id_pertemuan')
            ->get();

        return view('admin.pendidik.lkm.view', compact(
            'riwayatLkm',
            'kelas',
            'matkul',
            'id_kelas',
            'kode_mk'
        ));
    }

    // Hapus LKM
    public function destroy($id_kelas, $kode_mk, $id_pertemuan)
    {
        AbsensiLkm::where('kode_mk', $kode_mk)
            ->where('id_kelas', $id_kelas)
            ->where('id_pertemuan', $id_pertemuan)
            ->delete();

        return redirect()->back()->with('success', 'LKM berhasil dihapus.');
    }

    // Detail absensi per kelas
    public function detailAbsensi($id_kelas, $kode_mk, $id_pertemuan)
    {
        $kelas = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        $absensi = AbsensiLkm::join('mahasiswa', 'mahasiswa.nipd', '=', 'absensi_lkm.nipd')
            ->where('absensi_lkm.kode_mk', $kode_mk)
            ->where('absensi_lkm.id_kelas', $id_kelas)
            ->where('absensi_lkm.id_pertemuan', $id_pertemuan)
            ->select('mahasiswa.nipd','mahasiswa.nama_mhs','absensi_lkm.status')
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
            'id_pertemuan'
        ));
    }
}
