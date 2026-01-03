<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            // Drop foreign key to jadwal if exists
            $foreignKeys = DB::select("SHOW KEYS FROM krs WHERE Key_name='krs_id_jadwal_foreign'");
            if (!empty($foreignKeys)) {
                $table->dropForeign(['id_jadwal']);
            }
            
            // Drop id_jadwal column
            if (Schema::hasColumn('krs', 'id_jadwal')) {
                $table->dropColumn('id_jadwal');
            }
            
            // Add id_matkul column
            if (!Schema::hasColumn('krs', 'id_matkul')) {
                $table->unsignedBigInteger('id_matkul')->after('id_kelas')->nullable();
            }
        });

        // Add foreign key to mata_kuliah
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        if (!DB::select("SHOW KEYS FROM krs WHERE Key_name='krs_id_matkul_foreign'")) {
            Schema::table('krs', function (Blueprint $table) {
                $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah')->onDelete('cascade');
            });
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign(['id_matkul']);
            $table->dropColumn('id_matkul');
            $table->unsignedBigInteger('id_jadwal')->after('id_kelas')->nullable();
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
        });
    }
};
