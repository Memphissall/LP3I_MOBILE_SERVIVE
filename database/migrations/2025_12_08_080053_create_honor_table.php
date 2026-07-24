<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('honor')) {
            Schema::create('honor', function (Blueprint $table) {

                $table->unsignedInteger('id_honor')->autoIncrement();

                // ✅ SAMAKAN DENGAN PENDIDIK
                $table->string('id_pendidik', 10);

                $table->unsignedBigInteger('id_mk');
                $table->unsignedBigInteger('id_kelas');

                $table->integer('pertemuan')->nullable();
                $table->date('tanggal')->nullable();
                $table->integer('sks')->nullable();
                $table->integer('honor_per_sesi')->default(0)->nullable();
                $table->integer('honor_mengajar')->default(0)->nullable();

                $table->string('jenis_honor')->nullable();
                $table->tinyInteger('bulan')->nullable();
                $table->integer('biaya_pembuatan_soal')->default(0)->nullable();
                $table->integer('biaya_koreksi_jawaban')->default(0)->nullable();

                $table->integer('total_kotor')->default(0)->nullable();
                $table->integer('ppn')->default(0)->nullable();
                $table->integer('gaji_bersih')->default(0)->nullable();

                $table->integer('semester')->nullable();
                $table->year('tahun')->nullable();

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
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('honor');
    }
};