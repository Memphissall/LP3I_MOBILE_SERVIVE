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
        // Using raw SQL to avoid doctrine/dbal dependency
        // Assuming MySQL
        DB::statement("ALTER TABLE mahasiswa MODIFY COLUMN status VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to ENUM
        DB::statement("ALTER TABLE mahasiswa MODIFY COLUMN status ENUM('Aktif', 'Tidak Aktif') NOT NULL");
    }
};
