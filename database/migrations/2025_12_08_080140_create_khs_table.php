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
            $table->string('nipd'); 
            $table->string('kode_mk'); 
            $table->string('tahun_ajaran'); 
            $table->integer('semester');
            $table->decimal('ip_semester', 3, 2)->nullable();
            $table->timestamps();
            $table->foreign('nipd')->references('nipd')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah'); 
            $table->unique(['nipd', 'kode_mk', 'tahun_ajaran', 'semester']);
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
