<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissi', function (Blueprint $table) {
            $table->id();

            // Kolom untuk mengaitkan mahasiswa
            $table->unsignedBigInteger('mahasiswa_id');

            // Kolom untuk mengaitkan tugas (id_kelas + kode_mk)
            $table->unsignedBigInteger('id_kelas');
            $table->string('kode_mk');

            // Data jawaban
            $table->string('file_jawaban')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Index untuk mempercepat query
            $table->index(['id_kelas', 'kode_mk']);
        });

        // Buat foreign key ke mahasiswa.id
        Schema::table('submissi', function (Blueprint $table) {
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissi');
    }
};
