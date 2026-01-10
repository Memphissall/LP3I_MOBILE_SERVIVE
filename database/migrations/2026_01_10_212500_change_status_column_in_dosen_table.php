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
        // Change status from ENUM to VARCHAR to allow flexible values
        // Using raw SQL for MySQL
        DB::statement("ALTER TABLE dosen MODIFY COLUMN status VARCHAR(255) NULL DEFAULT 'Aktif'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to ENUM (Warning: potential data loss if non-enum values exist)
        DB::statement("ALTER TABLE dosen MODIFY COLUMN status ENUM('Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer') DEFAULT 'Aktif'");
    }
};
