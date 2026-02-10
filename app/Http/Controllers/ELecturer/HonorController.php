<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Honor;
use App\Models\Matakuliah;
use App\Models\Pendidik;
use App\Models\AbsensiLkm;
use Illuminate\Support\Facades\Auth;

class HonorController extends Controller
{
   public static function hitungHonor($id_mk, $pertemuan)
{
    $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();

    // CEK DUPLIKASI
    $cek = Honor::where('id_pendidik', $pendidik->id_pendidik)
        ->where('id_mk', $id_mk)
        ->where('pertemuan', $pertemuan)
        ->first();

    if ($cek) return;

    $matkul = Matakuliah::findOrFail($id_mk);

    $honorMengajar = $matkul->sks * $pendidik->honor_per_sks;

    $totalKotor = $honorMengajar;
    $ppn = intval($totalKotor * 0.05);
    $gajiBersih = $totalKotor - $ppn;

    Honor::create([
        'id_pendidik'     => $pendidik->id_pendidik,
        'id_kelas'    => $id_kelas,
        'id_mk'           => $id_mk,
        'pertemuan'       => $pertemuan,
        'tanggal'         => now()->toDateString(),
        'sks'             => $matkul->sks,
        'honor_per_sesi'  => $pendidik->honor_per_sks,
        'honor_mengajar'  => $honorMengajar,
        'total_kotor'     => $totalKotor,
        'ppn'             => $ppn,
        'gaji_bersih'     => $gajiBersih,
        'semester'        => $matkul->semester,
        'tahun'           => date('Y'),
    ]);
}

}
