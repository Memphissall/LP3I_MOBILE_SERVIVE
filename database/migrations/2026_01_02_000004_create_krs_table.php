<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id('id_krs');
            
            // Identitas mahasiswa
            $table->string('nipd');
            $table->string('nama_mhs');
            
            // Akademik
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_jadwal');
            $table->integer('semester');
            $table->enum('periode', ['Ganjil', 'Genap']);
            $table->string('tahun_akademik');
            
            // Status
            $table->enum('status', ['Draft', 'Submitted', 'Approved', 'Rejected'])->default('Draft');
            $table->text('catatan')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            
            // Unique constraint - satu mahasiswa tidak bisa ambil jadwal yang sama 2x
            $table->unique(['nipd', 'id_jadwal', 'tahun_akademik'], 'krs_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
