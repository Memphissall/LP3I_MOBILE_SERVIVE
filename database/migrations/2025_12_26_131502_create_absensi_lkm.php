<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
     Schema::create('absensi_lkm', function (Blueprint $table) {
            // Primary Key
            $table->id('id_absensi');

            // Relasi / Identitas
            $table->string('id_pendidik');                     // id_pendidik pendidik
            $table->string('kode_mk');                  // Kode matakuliah
            $table->unsignedBigInteger('id_kelas');     // Kelas
            $table->string('nipd')->nullable();         // NIM / Nipd mahasiswa
            $table->string('nama_mhs')->nullable();     // Nama mahasiswa (opsional, bisa ambil dari mahasiswa)

            // Informasi absensi
            $table->date('tanggal');                    // Tanggal pertemuan
            $table->integer('id_pertemuan');           // Pertemuan ke-
            $table->enum('status', ['Hadir', 'Izin', 'Alpha', 'Sakit'])->nullable(); 

            // Informasi LKM
            $table->text('materi')->nullable();        // Materi yang diajarkan
            $table->text('catatan')->nullable();       // Catatan tambahan
            $table->string('metode_mengajar')->default('Teori'); // Metode mengajar

            // Timestamp
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
