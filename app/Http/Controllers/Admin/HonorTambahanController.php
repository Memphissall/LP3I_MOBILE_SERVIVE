<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidik;
use App\Models\Honor;

class HonorTambahanController extends Controller
{
    /**
     * Halaman utama honor tambahan (FORM)
     */
    public function index()
    {
        $pendidik = Pendidik::orderBy('nama_pendidik')->get();
        return view('admin.akademik.tambahan_honor', compact('pendidik'));
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
        'id_pendidik' => 'required',
        'semester' => 'required',
        'jenis_honor' => 'required',
        'bulan' => 'required|integer|min:1|max:12',
        'uang_pembuatan_soal' => 'numeric',
        'uang_koreksi_jawaban' => 'numeric',
    ]);

    $tahun = date('Y');

    // 🔒 CEK DATA SAMA
    $cek = Honor::where('id_pendidik', $request->id_pendidik)
        ->where('semester', $request->semester)
        ->where('tahun', $tahun)
        ->where('jenis_honor', $request->jenis_honor)
        ->where('bulan', $request->bulan)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Honor pada periode ini sudah diinput.');
    }

    $totalKotor =
        (int) $request->uang_pembuatan_soal +
        (int) $request->uang_koreksi_jawaban;

    $ppn = (int) ($totalKotor * 0.05);

    Honor::create([
        'id_pendidik' => $request->id_pendidik,
        'semester' => $request->semester,
        'tahun' => $tahun,
        'jenis_honor' => $request->jenis_honor,
        'bulan' => $request->bulan,
        'uang_pembuatan_soal' => $request->uang_pembuatan_soal ?? 0,
        'uang_koreksi_jawaban' => $request->uang_koreksi_jawaban ?? 0,
        'total_kotor' => $totalKotor,
        'ppn' => $ppn,
        'gaji_bersih' => $totalKotor - $ppn,
    ]);

    return back()->with('success', 'Honor berhasil disimpan');
}

}
