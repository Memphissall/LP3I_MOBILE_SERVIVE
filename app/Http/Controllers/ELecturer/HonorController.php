<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Honor;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\AbsensiLkm;
use Illuminate\Support\Facades\Auth;

class HonorController extends Controller
{
    public static function hitungHonor($kode_mk, $id_pertemuan)
    {
        $nidn = Auth::id();

        // CEK SUDAH PERNAH DIHITUNG ATAU BELUM
        $cek = Honor::where('nidn', $nidn)
            ->where('kode_mk', $kode_mk)
            ->where('id_pertemuan', $id_pertemuan)
            ->first();

        if ($cek) {
            return; // ⛔ sudah pernah dihitung
        }

        // AMBIL MATKUL
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        // AMBIL DOSEN
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();

        $sks = $matkul->sks;
        $honorPerSks = $dosen->honor_per_sks;

        $totalGaji = $sks * $honorPerSks;

        Honor::create([
            'nidn'          => $nidn,
            'kode_mk'       => $kode_mk,
            'id_pertemuan'  => $id_pertemuan,
            'sks'           => $sks,
            'honor_per_sks' => $honorPerSks,
            'total_gaji'    => $totalGaji,
            'tanggal'       => now()->toDateString()
        ]);
    }
}
