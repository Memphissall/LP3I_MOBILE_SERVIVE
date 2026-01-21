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
    public static function hitungHonor($kode_mk, $id_pertemuan)
    {
        $id_pendidik = Auth::id();

        // CEK SUDAH PERNAH DIHITUNG ATAU BELUM
        $cek = Honor::where('id_pendidik', $id_pendidik)
            ->where('kode_mk', $kode_mk)
            ->where('id_pertemuan', $id_pertemuan)
            ->first();

        if ($cek) {
            return; // ⛔ sudah pernah dihitung
        }

        // AMBIL MATKUL
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        // AMBIL PENDIDIK
        $pendidik = Pendidik::where('id_pendidik', $id_pendidik)->firstOrFail();

        $sks = $matkul->sks;
        $honorPerSks = $pendidik->honor_per_sks;

        $totalGaji = $sks * $honorPerSks;

        Honor::create([
            'id_pendidik'          => $id_pendidik,
            'kode_mk'       => $kode_mk,
            'id_pertemuan'  => $id_pertemuan,
            'sks'           => $sks,
            'honor_per_sks' => $honorPerSks,
            'total_gaji'    => $totalGaji,
            'tanggal'       => now()->toDateString()
        ]);
    }
}
