<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$columns = DB::select('DESCRIBE pendidik');
foreach ($columns as $col) {
    if ($col->Field === 'jenis_kelamin') {
        echo "Column: " . $col->Field . "\n";
        echo "Type: " . $col->Type . "\n";
        echo "Null: " . $col->Null . "\n";
    }
}
