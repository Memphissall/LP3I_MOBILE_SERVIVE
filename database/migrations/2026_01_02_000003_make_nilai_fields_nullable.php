<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('nilai', function (Blueprint $table) {
        // Cek dulu, kalau kolom id_mahasiswa ada, baru diubah jadi nullable
        if (Schema::hasColumn('nilai', 'id_mahasiswa')) {
            $table->unsignedBigInteger('id_mahasiswa')->nullable()->change();
        }

        // Kalau ada kolom lain yang mau dibuat nullable, tambahkan di sini dengan cara yang sama
        // Contoh untuk kolom yang PASTI ada di tabel kamu:
        if (Schema::hasColumn('nilai', 'nidn')) {
            $table->string('nidn')->nullable()->change();
        }
        if (Schema::hasColumn('nilai', 'nipd')) {
            $table->string('nipd')->nullable()->change();
        }
    });
    }
};
