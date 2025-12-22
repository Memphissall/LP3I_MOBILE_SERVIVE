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
        Schema::create('kelas_matakuliah', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('id_kelas');
    $table->string('kode_mk');

    $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
    $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_matakuliah');
    }
};
