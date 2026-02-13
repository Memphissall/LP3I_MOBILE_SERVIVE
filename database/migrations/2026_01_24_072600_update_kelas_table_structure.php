<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // // Rename id_program_studi to id_program_studi if it exists
            // if (Schema::hasColumn('kelas', 'id_program_studi') && !Schema::hasColumn('kelas', 'id_program_studi')) {
            //     $table->renameColumn('id_program_studi', 'id_program_studi');
            // }
            
            // Add semester column if not exists
            if (!Schema::hasColumn('kelas', 'semester')) {
                $table->integer('semester')->default(1)->after('id_program_studi');
            }
            
            // Add tahun_ajaran column if not exists
            if (!Schema::hasColumn('kelas', 'tahun_ajaran')) {
                $table->string('tahun_ajaran', 255)->nullable()->after('semester');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            if (Schema::hasColumn('kelas', 'semester')) {
                $table->dropColumn('semester');
            }
            if (Schema::hasColumn('kelas', 'tahun_ajaran')) {
                $table->dropColumn('tahun_ajaran');
            }
            if (Schema::hasColumn('kelas', 'id_program_studi') && !Schema::hasColumn('kelas', 'id_program_studi')) {
                $table->renameColumn('id_program_studi', 'id_program_studi');
            }
        });
    }
};
