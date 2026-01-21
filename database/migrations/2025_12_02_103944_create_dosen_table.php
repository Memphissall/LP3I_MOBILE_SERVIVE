<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendidik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('id_pendidik')->unique();
            $table->string('nama_pendidik');
            $table->string('pendidikan');
            $table->string('bidang');
            $table->string('tempat');
            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            $table->string('agama');
            $table->string('email')->unique();
            $table->string('no_telp');
            // Status lengkap
            $table->enum('status', [
                'aktif',
                'tidak aktif',
                'kontrak',
                'tetap',
                'honorer'
            ])->default('aktif');

            // Upload foto
            $table->string('foto')->nullable();

            $table->integer('honor_per_sks');
            $table->integer('total_gaji_diterima')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendidik');
    }
};
