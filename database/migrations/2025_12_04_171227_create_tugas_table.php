<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {

            $table->bigIncrements('id_tugas');

            $table->string('kode_mk');
            $table->unsignedBigInteger('id_kelas');

            $table->string('judul');
            $table->text('deskripsi')->nullable();

            // ⏰ WAKTU UPLOAD & DEADLINE (PAKAI JAM)
            $table->dateTime('tanggal_upload')->useCurrent();
            $table->dateTime('deadline');

            $table->string('file_tugas')->nullable();

            // STATUS MANUAL (TAPI NANTI DITENTUKAN CARBON)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // RELASI
            $table->foreign('kode_mk')
                  ->references('kode_mk')
                  ->on('matakuliah')
                  ->onDelete('cascade');

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
