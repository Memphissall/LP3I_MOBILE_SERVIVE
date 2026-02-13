<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('mata_kuliah', 'id_program_studi')) {
                // Add foreign key column
                $table->unsignedBigInteger('id_program_studi')->nullable()->after('semester');

                // Add foreign key constraint
                $table->foreign('id_program_studi')
                    ->references('id_program_studi')
                    ->on('bidang_keahlian')
                    ->onDelete('set null');
            }
        });

        // Migrate existing data: map string bidang_keahlian to id
        // SQLite doesn't support UPDATE JOIN, so we use a subquery instead
        DB::statement("
            UPDATE mata_kuliah
            SET id_program_studi = (
                SELECT id_program_studi
                FROM bidang_keahlian
                WHERE bidang_keahlian.nama = mata_kuliah.bidang_keahlian
            )
            WHERE bidang_keahlian IS NOT NULL
        ");

        // Drop old string column
        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropColumn('bidang_keahlian');
        });
    }

    public function down(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Re-add string column
            $table->string('bidang_keahlian')->nullable()->after('semester');
        });

        // Migrate data back
        // SQLite doesn't support UPDATE JOIN, so we use a subquery instead
        DB::statement("
            UPDATE mata_kuliah
            SET bidang_keahlian = (
                SELECT nama
                FROM bidang_keahlian
                WHERE bidang_keahlian.id_program_studi = mata_kuliah.id_program_studi
            )
            WHERE id_program_studi IS NOT NULL
        ");

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropForeign(['id_program_studi']);
            $table->dropColumn('id_program_studi');
        });
    }
};
