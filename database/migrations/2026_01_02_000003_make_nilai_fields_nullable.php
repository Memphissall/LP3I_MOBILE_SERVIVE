<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa')->nullable()->change();
            $table->unsignedBigInteger('id_dosen')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa')->nullable(false)->change();
            $table->unsignedBigInteger('id_dosen')->nullable(false)->change();
        });
    }
};
