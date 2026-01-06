<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('matakuliah', function (Blueprint $table) {
    $table->string('kode_mk')->primary();
    $table->string('nama_mk');
    $table->integer('sks');
    $table->integer('semester');
    $table->boolean('tipe_matakuliah')->default(false);
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
};
