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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi'); 
            $table->unsignedBigInteger('id_jadwal'); 
            $table->unsignedBigInteger('id_mahasiswa');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha']); 
            $table->boolean('validasi')->default(false); 
            $table->date('tanggal'); 
            $table->timestamps();
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
