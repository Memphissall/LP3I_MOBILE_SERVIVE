<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Drop old jurusan column
            $table->dropColumn('jurusan');
            
            // Add id_bidang_keahlian foreign key
            $table->unsignedBigInteger('id_bidang_keahlian')->nullable()->after('nama');
            
            // Add foreign key constraint
            $table->foreign('id_bidang_keahlian')
                ->references('id_bidang_keahlian')
                ->on('bidang_keahlian')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['id_bidang_keahlian']);
            $table->dropColumn('id_bidang_keahlian');
            
            // Restore jurusan column
            $table->string('jurusan')->after('nama');
        });
    }
};
