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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->string('judul_tugas');
            $table->string('file_tugas')->nullable();
            $table->text('deskripsi');
            $table->dateTime('tanggal_upload')->useCurrent();
            $table->dateTime('deadline');
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->foreignId('id_mk');
            $table->foreignId('id_kelas');
            $table->foreign('id_mk')->references('id_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};