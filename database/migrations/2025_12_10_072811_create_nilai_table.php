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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_mahasiswa');    
            $table->unsignedBigInteger('id_dosen');        
            $table->float('nilai_kehadiran')->nullable();
            $table->float('nilai_attitude')->nullable();
            $table->float('nilai_formatif')->nullable();
            $table->float('nilai_tugas')->nullable();   
            $table->float('nilai_uts')->nullable();
            $table->float('nilai_uas')->nullable();
            $table->float('ip_semester')->nullable();
            $table->float('ip_kumulatif')->nullable();
            $table->string('huruf_mutu')->nullable();
            $table->timestamps();
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa'); 
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
