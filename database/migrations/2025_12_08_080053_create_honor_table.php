<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('honor', function (Blueprint $table) {
            $table->id('id_honor');

            $table->string('nidn');
            $table->string('kode_mk');

            $table->integer('id_pertemuan');
            $table->date('tanggal');

            $table->integer('sks');
            $table->integer('honor_per_sks');

            $table->integer('gaji_total');

            $table->string('semester');
            $table->year('tahun');

            $table->timestamps();

            $table->unique(['nidn', 'kode_mk', 'id_pertemuan']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('honor');
    }
};
