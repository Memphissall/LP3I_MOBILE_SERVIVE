<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            // Make optional fields nullable to allow flexible seeding
            $table->unsignedBigInteger('id_matkul')->nullable()->change();
            $table->string('tempat')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('agama')->nullable()->change();
            $table->integer('honor_per_sks')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->unsignedBigInteger('id_matkul')->nullable(false)->change();
            $table->string('tempat')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->string('agama')->nullable(false)->change();
            $table->integer('honor_per_sks')->nullable(false)->change();
        });
    }
};
