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
        // Using raw statement to modify column to be nullable without doctrine/dbal
        // Assuming MySQL/MariaDB
        DB::statement('ALTER TABLE mahasiswa MODIFY kelas VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE mahasiswa MODIFY kelas VARCHAR(255) NOT NULL');
    }
};
