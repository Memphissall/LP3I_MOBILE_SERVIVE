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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('id_ruangan'); 
            $table->string('nidn');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('jenis_perkuliahan', ['Tatap Muka', 'Online', 'Tidak Masuk'])->default('Tatap Muka');
            $table->timestamps();
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan'); 
            $table->foreign('nidn')->references('nidn')->on('dosen'); 
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas'); 
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
