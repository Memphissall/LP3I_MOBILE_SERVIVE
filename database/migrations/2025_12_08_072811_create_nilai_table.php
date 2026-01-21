<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
    $table->id('id_nilai');

    // Identitas
    $table->string('id_pendidik');
    $table->string('nipd');
    $table->string('nama_mhs');

    // Akademik
    $table->unsignedBigInteger('id_kelas');
    $table->string('kode_mk');
    $table->integer('semester');
    $table->enum('periode', ['Ganjil', 'Genap']);
    $table->string('tahun_akademik');

    // Nilai mentah
    $table->integer('nilai_kehadiran')->nullable();
    $table->integer('nilai_sikap')->nullable();
    $table->integer('nilai_formatif')->nullable();
    $table->integer('nilai_tugas')->nullable();
    $table->integer('nilai_uts')->nullable();
    $table->integer('nilai_uas')->nullable();

    // HASIL OLAHAN
    $table->decimal('nilai_akhir', 5, 2)->nullable();
    $table->string('mutu', 2)->nullable();
    $table->decimal('bobot_ip', 3, 2)->nullable();

    $table->timestamps();

    $table->unique(
        ['nipd', 'kode_mk', 'semester', 'id_kelas', 'tahun_akademik'],
        'nilai_unique'
    );
});

    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
