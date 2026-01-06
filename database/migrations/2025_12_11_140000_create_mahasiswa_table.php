<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();

            $table->string('nipd')->unique();
            $table->string('nama_mhs');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');

            $table->unsignedBigInteger('id_kelas');
            $table->string('bidang_keahlian');
            $table->string('email');
            $table->string('alamat');
            $table->string('agama');
            $table->string('no_tlp');
            $table->string('foto')->default('default.png');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('kelas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
