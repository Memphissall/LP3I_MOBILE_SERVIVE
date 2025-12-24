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
        Schema::create('honor', function (Blueprint $table) {
            $table->id('id_honor'); 
            $table->unsignedBigInteger('id_dosen');
            $table->date('tanggal'); 
            $table->integer('total_sks'); 
            $table->unsignedBigInteger('honor_transport'); 
            $table->unsignedBigInteger('honor_per_sks');
            $table->unsignedBigInteger('honor_soal'); 
            $table->unsignedBigInteger('honor_koreksi'); 
            $table->unsignedBigInteger('total_honor'); 
            $table->timestamps();
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor');
    }
};
