<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('nidn')->unique();
            $table->string('nama_dosen');
            $table->string('pendidikan');
            $table->string('bidang');
            $table->string('tempat');
            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            $table->string('agama');
            $table->string('email')->unique();
            $table->string('no_telp');

            $table->integer('honor_per_sks');

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

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
