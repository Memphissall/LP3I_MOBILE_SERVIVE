<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Tambah field bobot_kompetensi
            $table->integer('bobot_kompetensi')->default(0)->after('sks');
            
            // Rename jurusan ke bidang_keahlian
            $table->renameColumn('jurusan', 'bidang_keahlian');
            
            // Hapus kolom jenis
            $table->dropColumn('jenis');
        });
    }

    public function down(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Rollback: hapus bobot_kompetensi
            $table->dropColumn('bobot_kompetensi');
            
            // Rollback: rename bidang_keahlian ke jurusan
            $table->renameColumn('bidang_keahlian', 'jurusan');
            
            // Rollback: tambah kembali kolom jenis
            $table->enum('jenis', ['Wajib', 'Pilihan'])->default('Wajib');
        });
    }
};
