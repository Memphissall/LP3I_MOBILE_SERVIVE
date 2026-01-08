<?php

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\BidangKeahlian;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking Kelas...\n";
if (Kelas::count() == 0) {
    echo "No Kelas found. Creating dummy kelas...\n";
    // Ensure BidangKeahlian exists
    if (BidangKeahlian::count() == 0) {
        BidangKeahlian::create(['kode' => 'TI', 'nama' => 'Teknik Informatika']);
    }
    $bk = BidangKeahlian::first();
    
    Kelas::create([
        'kode_mk' => 'TI-1A',
        'nama_kelas' => 'TI-1A',
        'id_bidang_keahlian' => $bk->id_bidang_keahlian,
        'semester' => 1,
        'tahun_ajaran' => '2024/2025', // Should be string
        'nama_pa' => 'Dosen PA Dummy'
    ]);
}

echo "Fixing Mahasiswa with NULL id_kelas...\n";
$kelasIds = Kelas::pluck('id_kelas')->toArray();
$students = Mahasiswa::whereNull('id_kelas')->get();

foreach ($students as $student) {
    $randomKelasId = $kelasIds[array_rand($kelasIds)];
    $student->update(['id_kelas' => $randomKelasId]);
    echo "Fixed student {$student->nipd} -> Kelas ID {$randomKelasId}\n";
}

echo "Running NilaiSeeder...\n";
try {
    $seeder = new \Database\Seeders\NilaiSeeder();
    $seeder->setCommand(new \Illuminate\Console\Command()); // Mock command object if needed
    $seeder->run();
    echo "Done!\n";
} catch (\Exception $e) {
    echo "ERROR SEEDING: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
