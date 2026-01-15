<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // SQLite doesn't support information_schema or SHOW KEYS
        // We'll use try-catch to drop foreign keys and indexes

        // 1. Try to drop Foreign Key for id_jadwal
        try {
            Schema::table('krs', function (Blueprint $table) {
                $table->dropForeign(['id_jadwal']);
            });
        } catch (\Exception $e) {
            // FK doesn't exist or already dropped, ignore
        }

        // 2. Try to drop unique index if it exists
        try {
            Schema::table('krs', function (Blueprint $table) {
                $table->dropUnique('krs_unique');
            });
        } catch (\Exception $e) {
            // Unique index doesn't exist, ignore
        }

        Schema::table('krs', function (Blueprint $table) {
            // 3. Drop id_jadwal column
            if (Schema::hasColumn('krs', 'id_jadwal')) {
                $table->dropColumn('id_jadwal');
            }

            // 4. Add id_matkul column
            if (!Schema::hasColumn('krs', 'id_matkul')) {
                $table->unsignedBigInteger('id_matkul')->after('id_kelas')->nullable();
            }
        });

        // 5. Add new Foreign Key for id_matkul
        try {
            Schema::table('krs', function (Blueprint $table) {
                $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah')->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // FK already exists, ignore
        }
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            // Reverse operations

            // Drop matkul FK and column
            try {
                $table->dropForeign(['id_matkul']);
            } catch (\Exception $e) {
            }

            if (Schema::hasColumn('krs', 'id_matkul')) {
                $table->dropColumn('id_matkul');
            }

            // Restore id_jadwal
            if (!Schema::hasColumn('krs', 'id_jadwal')) {
                $table->unsignedBigInteger('id_jadwal')->after('id_kelas')->nullable();
                $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            }

            // Restore unique index? Not strictly necessary for rollback correctness unless data integrity required.
        });
    }
};
