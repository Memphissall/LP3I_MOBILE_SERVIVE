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
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->id('id_mk');
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->text('deskripsi');
            $table->boolean('tipe_matakuliah')->default(0);
            $table->foreignId('id_program_studi')->nullable();
            $table->foreign('id_program_studi')->references('id_program_studi')->on('program_studi')->onDelete('cascade');
            $table->integer('semester');
            $table->integer('sks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah');
    }
};