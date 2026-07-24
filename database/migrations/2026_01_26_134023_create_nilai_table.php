<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('nilai')) {
            Schema::create('nilai', function (Blueprint $table) {

                $table->unsignedInteger('id_nilai')->autoIncrement();

                // SAMAKAN DENGAN PENDIDIK (STRING 10)
                $table->string('id_pendidik', 10);

                $table->unsignedBigInteger('id_mahasiswa');
                $table->unsignedBigInteger('id_kelas');
                $table->unsignedBigInteger('id_mk');

                $table->integer('semester');
                $table->enum('periode', ['Ganjil', 'Genap']);
                $table->string('tahun_akademik');

                $table->float('nilai_kehadiran')->nullable();
                $table->float('nilai_sikap')->nullable();
                $table->float('nilai_formative')->nullable();
                $table->float('nilai_tugas')->nullable();
                $table->float('nilai_uts')->nullable();
                $table->float('nilai_uas')->nullable();

                $table->decimal('nilai_akhir', 5, 2)->nullable();
                $table->string('grade', 2)->nullable();
                $table->decimal('bobot_ip', 3, 2)->nullable();

                $table->timestamps();

                $table->foreign('id_pendidik')
                      ->references('id_pendidik')
                      ->on('pendidik')
                      ->onDelete('cascade');

                $table->foreign('id_mahasiswa')
                      ->references('id_mahasiswa')
                      ->on('mahasiswa')
                      ->onDelete('cascade');

                $table->foreign('id_kelas')
                      ->references('id_kelas')
                      ->on('kelas')
                      ->onDelete('cascade');

                $table->foreign('id_mk')
                      ->references('id_mk')
                      ->on('matakuliah')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};