<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update existing records to Title case
        DB::statement("UPDATE dosen SET status = 'Aktif' WHERE status = 'aktif'");
        DB::statement("UPDATE dosen SET status = 'Tidak Aktif' WHERE status = 'tidak aktif'");
        DB::statement("UPDATE dosen SET status = 'Kontrak' WHERE status = 'kontrak'");
        DB::statement("UPDATE dosen SET status = 'Tetap' WHERE status = 'tetap'");
        DB::statement("UPDATE dosen SET status = 'Honorer' WHERE status = 'honorer'");
        
        // Then, alter the enum column to use Title case values
        DB::statement("ALTER TABLE dosen MODIFY COLUMN status ENUM('Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer') DEFAULT 'Aktif'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to lowercase
        DB::statement("UPDATE dosen SET status = 'aktif' WHERE status = 'Aktif'");
        DB::statement("UPDATE dosen SET status = 'tidak aktif' WHERE status = 'Tidak Aktif'");
        DB::statement("UPDATE dosen SET status = 'kontrak' WHERE status = 'Kontrak'");
        DB::statement("UPDATE dosen SET status = 'tetap' WHERE status = 'Tetap'");
        DB::statement("UPDATE dosen SET status = 'honorer' WHERE status = 'Honorer'");
        
        // Revert enum to lowercase
        DB::statement("ALTER TABLE dosen MODIFY COLUMN status ENUM('aktif', 'tidak aktif', 'kontrak', 'tetap', 'honorer') DEFAULT 'aktif'");
    }
};
