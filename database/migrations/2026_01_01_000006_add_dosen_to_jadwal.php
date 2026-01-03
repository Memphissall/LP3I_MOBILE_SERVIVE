<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dosen')->nullable()->after('id_matkul');
            
            $table->foreign('id_dosen')
                  ->references('id_dosen')
                  ->on('dosen')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['id_dosen']);
            $table->dropColumn('id_dosen');
        });
    }
};
