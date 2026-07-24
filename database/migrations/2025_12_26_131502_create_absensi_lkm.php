<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('absensi_lkm')) {
            Schema::create('absensi_lkm', function (Blueprint $table) {

                $table->unsignedInteger('id_absensi')->autoIncrement();

                // ✅ SAMAKAN DENGAN PENDIDIK
                $table->string('id_pendidik', 10);

                $table->unsignedBigInteger('id_mk');
                $table->unsignedBigInteger('id_kelas');
                $table->unsignedBigInteger('id_mahasiswa');

                $table->string('nama_mhs');
                $table->date('tanggal');
                $table->integer('pertemuan');
                $table->enum('status', ['Hadir', 'Izin', 'Alpha', 'Sakit'])->nullable();
                $table->string('materi')->nullable();
                $table->text('catatan')->nullable();
                $table->text('sub_pembahasan')->nullable();
                $table->string('metode_mengajar')->default('Teori')->nullable();

                $table->timestamps();

                $table->foreign('id_pendidik')
                      ->references('id_pendidik')
                      ->on('pendidik')
                      ->onDelete('cascade');

                $table->foreign('id_mk')
                      ->references('id_mk')
                      ->on('matakuliah')
                      ->onDelete('cascade');

                $table->foreign('id_kelas')
                      ->references('id_kelas')
                      ->on('kelas')
                      ->onDelete('cascade');

                $table->foreign('id_mahasiswa')
                      ->references('id_mahasiswa')
                      ->on('mahasiswa')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_lkm');
    }
};