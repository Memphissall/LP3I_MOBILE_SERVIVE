<?php

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    $mhs = Mahasiswa::first();
    if (!$mhs) die("No Mahasiswa\n");
    
    $dosen = Dosen::first();
    if (!$dosen) die("No Dosen\n");
    
    $mk = MataKuliah::first();
    if (!$mk) die("No Matkul\n");
    
    echo "Attempting to insert nilai for:\n";
    echo "NIPD: " . $mhs->nipd . "\n";
    echo "Kode MK: " . $mk->kode_mk . "\n";
    echo "ID Kelas: " . ($mhs->id_kelas ?? 'NULL') . "\n";
    echo "Tahun Akademik: 2023/2024\n";

    DB::table('nilai')->insert([
        'nidn' => $dosen->nidn,
        'nipd' => $mhs->nipd,
        'nama_mhs' => $mhs->nama,
        'id_kelas' => $mhs->id_kelas,
        'kode_mk' => $mk->kode_mk,
        'semester' => 1,
        'periode' => 'Ganjil',
        'tahun_akademik' => '2023/2024',
        'nilai_kehadiran' => 100,
        'nilai_sikap' => 100,
        'nilai_formatif' => 100,
        'nilai_tugas' => 100,
        'nilai_uts' => 100,
        'nilai_uas' => 100,
        'nilai_akhir' => 100,
        'mutu' => 'A',
        'bobot_ip' => 4.0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "SUCCESS!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
