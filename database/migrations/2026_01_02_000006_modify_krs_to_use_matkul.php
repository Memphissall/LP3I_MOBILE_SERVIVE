<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Kita fokus tambah id_matkul saja tanpa menyentuh id_jadwal
        if (!Schema::hasColumn('krs', 'id_matkul')) {
            Schema::table('krs', function (Blueprint $table) {
                // Cek kolom referensi untuk posisi 'after'
                if (Schema::hasColumn('krs', 'id_mahasiswa')) {
                    $table->unsignedBigInteger('id_matkul')->nullable()->after('id_mahasiswa');
                } else {
                    $table->unsignedBigInteger('id_matkul')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            // Hapus id_matkul saat rollback
            if (Schema::hasColumn('krs', 'id_matkul')) {
                $table->dropColumn('id_matkul');
            }
            
            // Tambahkan kembali id_jadwal hanya jika diperlukan saat rollback
            if (!Schema::hasColumn('krs', 'id_jadwal')) {
                $table->unsignedBigInteger('id_jadwal')->nullable();
            }
        });
    }
};