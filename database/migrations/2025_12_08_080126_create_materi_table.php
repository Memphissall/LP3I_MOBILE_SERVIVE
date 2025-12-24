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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_kelas');
            $table->string('judul_materi');
            $table->text('deskripsi')->nullable();
            $table->string('file_materi')->nullable();
            $table->dateTime('tanggal_upload');
            $table->integer('pertemuan');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen'); // Asumsi primary key tabel 'dosen' adalah 'nidn'
            $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah'); // Asumsi primary key tabel 'mata_kuliah' adalah 'kode_mk'
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');  // ke tabel kelas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
