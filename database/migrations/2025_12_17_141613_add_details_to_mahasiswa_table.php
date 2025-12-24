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
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas')->nullable()->after('id_mahasiswa');
            $table->string('angkatan')->nullable()->after('jurusan');
            $table->string('periode')->nullable()->after('angkatan');
            
            // Foreign key constraint if you want to enforce strictness
            // $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn(['id_kelas', 'angkatan', 'periode']);
        });
    }
};
