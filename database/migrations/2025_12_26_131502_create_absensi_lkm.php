
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
        Schema::create('absensi_lkm', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->foreignId('id_pendidik');
            $table->foreignId('id_mk');
            $table->foreignId('id_kelas');
            $table->foreignId('id_mahasiswa');
            $table->string('nama_mhs');
            $table->date('tanggal');
            $table->integer('pertemuan');
            $table->enum('status', ['Hadir', 'Izin', 'Alpha', 'Sakit'])->nullable();
            $table->string('materi')->nullable();
            $table->text('catatan')->nullable();
            $table->text('sub_pembahasan')->nullable();
            $table->string('metode_mengajar')->default('Teori')->nullable();
            $table->foreign('id_pendidik')->references('id_pendidik')->on('pendidik')->onDelete('cascade');
            $table->foreign('id_mk')->references('id_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
