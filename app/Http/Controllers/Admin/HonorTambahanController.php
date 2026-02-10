<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidik;
use App\Models\Honor;
use App\Models\Kelas;
use App\Models\Matakuliah;


class HonorTambahanController extends Controller
{





    
    /**
     * Halaman utama honor tambahan (FORM)
     */
   public function index()
{
    $pendidik   = Pendidik::orderBy('nama_pendidik')->get();
    $kelas      = Kelas::orderBy('nama_kelas')->get();
    $matakuliah = Matakuliah::orderBy('nama_mk')->get();

    return view('admin.akademik.tambahan_honor', compact(
        'pendidik',
        'kelas',
        'matakuliah'
    ));
}
    /**
     * (Opsional) Kalau mau pisah halaman create
     * Bisa hapus kalau tidak dipakai
     */
    public function create()
    {
        return redirect()->route('admin.akademik.tambahan-honor');
    }

    /**
     * Simpan / Update honor tambahan
     */
    public function store(Request $request)
{
    $request->validate([
        'id_pendidik' => 'required|integer',
        'semester' => 'required|in:1,2',
         'tanggal' => 'required|date',
        'id_mk' => 'nullable|integer',
        'id_kelas' => 'nullable|integer',
        'jenis_honor' => 'required|string',
        'bulan' => 'required|integer|min:1|max:12',
        'uang_pembuatan_soal' => 'nullable|numeric',
        'uang_koreksi_jawaban' => 'nullable|numeric',
    ]);

    $tahun = date('Y');

    // CEK DUPLIKAT
    $exists = Honor::where('id_pendidik', $request->id_pendidik)
        ->where('semester', $request->semester)
        ->where('tahun', $tahun)
        ->where('jenis_honor', $request->jenis_honor)
        ->where('bulan', $request->bulan)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Honor pada periode/bulan ini sudah diinput.');
    }

    $biayaSoal = (int) ($request->uang_pembuatan_soal ?? 0);
    $biayaKoreksi = (int) ($request->uang_koreksi_jawaban ?? 0);

    $totalKotor = $biayaSoal + $biayaKoreksi;
    $ppn = (int) ($totalKotor * 0.05);

    Honor::create([
        'id_pendidik' => $request->id_pendidik,
    
         'tanggal' => $request->tanggal,
        'id_mk' => $request->id_mk,
         'id_kelas' => $request->id_kelas,
        'semester' => $request->semester,
        'tahun' => $tahun,
        'jenis_honor' => $request->jenis_honor,
        'bulan' => $request->bulan,

        // SESUAI MIGRASI
        'biaya_pembuatan_soal' => $biayaSoal,
        'biaya_koreksi_jawaban' => $biayaKoreksi,

        'total_kotor' => $totalKotor,
        'ppn' => $ppn,
        'gaji_bersih' => $totalKotor - $ppn,
    ]);

    return back()->with('success', 'Honor tambahan berhasil disimpan ✅');

}


}
