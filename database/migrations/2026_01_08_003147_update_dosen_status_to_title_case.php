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
        // Update existing records to Title case
        // SQLite doesn't support ENUM or MODIFY COLUMN, but we can still update the data
        // The column is stored as TEXT in SQLite, so no need to alter column type
        DB::statement("UPDATE dosen SET status = 'Aktif' WHERE status = 'aktif'");
        DB::statement("UPDATE dosen SET status = 'Tidak Aktif' WHERE status = 'tidak aktif'");
        DB::statement("UPDATE dosen SET status = 'Kontrak' WHERE status = 'kontrak'");
        DB::statement("UPDATE dosen SET status = 'Tetap' WHERE status = 'tetap'");
        DB::statement("UPDATE dosen SET status = 'Honorer' WHERE status = 'honorer'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to lowercase
        // SQLite doesn't support ENUM, but we can still revert the data
        DB::statement("UPDATE dosen SET status = 'aktif' WHERE status = 'Aktif'");
        DB::statement("UPDATE dosen SET status = 'tidak aktif' WHERE status = 'Tidak Aktif'");
        DB::statement("UPDATE dosen SET status = 'kontrak' WHERE status = 'Kontrak'");
        DB::statement("UPDATE dosen SET status = 'tetap' WHERE status = 'Tetap'");
        DB::statement("UPDATE dosen SET status = 'honorer' WHERE status = 'Honorer'");
    }
};
