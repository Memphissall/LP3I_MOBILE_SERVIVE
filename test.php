<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mhs = App\Models\Mahasiswa::where('nama_mhs', 'like', '%Rafi%')->first();
if ($mhs) {
    file_put_contents(__DIR__.'/output.txt', json_encode($mhs->toArray(), JSON_PRETTY_PRINT));
} else {
    file_put_contents(__DIR__.'/output.txt', "No Mahasiswa found.");
}
