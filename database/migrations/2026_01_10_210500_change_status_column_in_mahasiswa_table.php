<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL to avoid doctrine/dbal dependency
        // SQLite doesn't support MODIFY COLUMN and stores columns as TEXT anyway
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE mahasiswa MODIFY COLUMN status VARCHAR(255) NULL");
        }
        // For SQLite, the column is already TEXT and nullable, no action needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to ENUM
        // SQLite doesn't support ENUM
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE mahasiswa MODIFY COLUMN status ENUM('Aktif', 'Tidak Aktif') NOT NULL");
        }
    }
};
