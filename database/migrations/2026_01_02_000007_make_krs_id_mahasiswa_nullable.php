<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            if (Schema::hasColumn('krs', 'id_mahasiswa')) {
                $table->unsignedBigInteger('id_mahasiswa')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa')->nullable(false)->change();
        });
    }
};
