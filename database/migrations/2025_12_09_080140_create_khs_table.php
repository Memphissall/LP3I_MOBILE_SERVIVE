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
        Schema::create('khs', function (Blueprint $table) {
            $table->id('id_khs'); 
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_matkul'); 
            $table->string('tahun_ajaran'); 
            $table->integer('semester');
            $table->decimal('ip_semester', 3, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah'); 
            $table->unique(['tahun_ajaran', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
