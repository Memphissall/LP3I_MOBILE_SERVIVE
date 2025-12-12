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
            $table->string('nipd');             
            $table->string('nidn');              
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
            $table->foreign('nipd')->references('nipd')->on('mahasiswa'); 
            $table->foreign('nidn')->references('nidn')->on('dosen');
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
