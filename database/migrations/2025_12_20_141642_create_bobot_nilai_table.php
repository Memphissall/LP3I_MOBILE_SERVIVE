<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bobot_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique();
            $table->integer('kehadiran');
            $table->integer('sikap');
            $table->integer('formatif');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('kode_mk')
                ->references('kode_mk')
                ->on('matakuliah')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bobot_nilai');
    }
};
