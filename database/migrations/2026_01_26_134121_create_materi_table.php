
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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->foreignId('id_mk');
            $table->foreignId('id_kelas');
            $table->foreignId('id_pendidik');
            $table->string('judul_materi');
            $table->text('deskripsi');
            $table->string('file_materi')->nullable();
            $table->text('link_materi')->nullable();
            $table->enum('tipe_materi', ['file', 'link']);
            $table->integer('pertemuan');
            $table->timestamp('tgl_upload')->useCurrent();
            $table->foreign('id_mk')->references('id_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_pendidik')->references('id_pendidik')->on('pendidik')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
