<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('jadwal')) {
            Schema::create('jadwal', function (Blueprint $table) {

                $table->unsignedInteger('id_jadwal')->autoIncrement();
                $table->string('hari');

                // Lebih baik pakai time, bukan string
                $table->time('jam_mulai');
                $table->time('jam_selesai');

                $table->integer('semester');

                $table->unsignedBigInteger('id_mk');

                // 🔥 INI YANG DIUBAH
                $table->string('id_pendidik', 10);

                $table->unsignedInteger('id_kelas');
                $table->unsignedInteger('id_ruangan')->nullable();

                $table->timestamps();

                $table->foreign('id_mk')
                      ->references('id_mk')
                      ->on('matakuliah')
                      ->onDelete('cascade');

                $table->foreign('id_pendidik')
                      ->references('id_pendidik')
                      ->on('pendidik')
                      ->onDelete('cascade');

                $table->foreign('id_kelas')
                      ->references('id_kelas')
                      ->on('kelas')
                      ->onDelete('cascade');

                $table->foreign('id_ruangan')
                      ->references('id_ruangan')
                      ->on('ruangan')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};