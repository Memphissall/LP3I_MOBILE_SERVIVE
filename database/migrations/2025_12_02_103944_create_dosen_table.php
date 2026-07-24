<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendidik', function (Blueprint $table) {

            // ID MANUAL MAX 10 KARAKTER
            $table->string('id_pendidik', 10)->primary();

            $table->unsignedBigInteger('id_user');
            $table->string('nama_pendidik');
            $table->string('pendidikan');
            $table->string('bidang');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('email')->unique();
            $table->string('no_tlp');
            $table->decimal('rate_gaji', 15, 2);
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer'])->default('Aktif');
            $table->string('foto')->nullable();
            $table->bigInteger('total_gaji_diterima')->default(0);
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendidik');
    }
};