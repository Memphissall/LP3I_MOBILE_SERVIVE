<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->handle(
    new Symfony\Component\Console\Input\StringInput(''),
    new Symfony\Component\Console\Output\ConsoleOutput()
);

use Illuminate\Support\Facades\DB;

try {
    DB::statement("UPDATE mahasiswa SET status = 'Aktif' WHERE status IS NULL OR status NOT IN ('Aktif', 'Tidak Aktif')");
    DB::statement("ALTER TABLE mahasiswa MODIFY COLUMN status ENUM('Aktif', 'Tidak Aktif') NOT NULL DEFAULT 'Aktif'");
    echo "SUCCESS_REVERT";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
