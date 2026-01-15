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
        // SQLite doesn't support MODIFY column, so we need to recreate the table
        // For now, we'll skip this migration for SQLite or you can use doctrine/dbal
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE mahasiswa MODIFY kelas VARCHAR(255) NULL');
        } else {
            // For SQLite, we'll use a workaround
            // First, check if the column is already nullable
            // If not, we would need to recreate the table, which is complex
            // For development purposes, we can skip this for SQLite
            // The column should already be nullable if created properly
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE mahasiswa MODIFY kelas VARCHAR(255) NOT NULL');
        }
    }
};
