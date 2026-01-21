<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('honor', function (Blueprint $table) {
    $table->id('id_honor');

    $table->string('id_pendidik');

    // ===== HONOR MENGAJAR =====
    $table->string('kode_mk')->nullable();
    $table->integer('id_pertemuan')->nullable();
    $table->date('tanggal')->nullable();
    $table->integer('sks')->nullable();
    $table->integer('honor_per_sks')->default(0);
    $table->integer('honor_mengajar')->default(0);

    // ===== HONOR TAMBAHAN =====
    $table->string('jenis_honor')->nullable(); // pembuatan_soal / koreksi
    $table->tinyInteger('bulan')->nullable(); // 1–12
    $table->integer('uang_pembuatan_soal')->default(0);
    $table->integer('uang_koreksi_jawaban')->default(0);

    // ===== PERHITUNGAN =====
    $table->integer('total_kotor')->default(0);
    $table->integer('ppn')->default(0);
    $table->integer('gaji_bersih')->default(0);

    $table->string('semester');
    $table->year('tahun');

    $table->timestamps();

    // 🔐 CEGAH DUPLIKASI
    $table->unique(
        ['id_pendidik', 'semester', 'tahun', 'jenis_honor', 'bulan'],
        'honor_unique_tambahan'
    );
});

    }

    public function down()
    {
        Schema::dropIfExists('honor');
    }
};
