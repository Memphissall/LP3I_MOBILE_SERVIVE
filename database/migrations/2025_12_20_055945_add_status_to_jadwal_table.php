<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->enum('status', ['Offline', 'Online', 'Libur', 'Kelas Tunjangan', 'Belum Ada Konfirmasi'])
                ->default('Belum Ada Konfirmasi')
                ->after('waktu');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
