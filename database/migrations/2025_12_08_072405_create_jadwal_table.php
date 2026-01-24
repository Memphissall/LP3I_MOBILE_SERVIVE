
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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('hari');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->integer('semester');
            $table->foreignId('id_mk');
            $table->foreignId('id_pendidik');
            $table->foreignId('id_kelas');
            $table->foreignId('id_ruangan')->nullable();
            $table->foreign( 'id_mk')->references('id_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('id_pendidik')->references('id_pendidik')->on('pendidik')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
