<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();

            $table->string('judul_materi');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe_materi', ['file', 'link']);
            $table->string('file_materi')->nullable();
            $table->text('link_materi')->nullable();
            $table->integer('pertemuan');

            $table->unsignedBigInteger('id_kelas');
            $table->string('kode_mk');
            $table->string('nidn');

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->cascadeOnDelete();

            $table->foreign('kode_mk')
                  ->references('kode_mk')
                  ->on('matakuliah')
                  ->cascadeOnDelete();

            $table->foreign('nidn')
                  ->references('nidn')
                  ->on('dosen')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
        $table->dropColumn('tipe_materi');
    });
    }
};

