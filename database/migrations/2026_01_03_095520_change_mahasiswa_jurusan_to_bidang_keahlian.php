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
            
            // Add id_program_studi foreign key
            $table->unsignedBigInteger('id_program_studi')->nullable()->after('nama');
            
            // Add foreign key constraint
            $table->foreign('id_program_studi')
                ->references('id_program_studi')
                ->on('bidang_keahlian')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['id_program_studi']);
            $table->dropColumn('id_program_studi');
            
            // Restore jurusan column
            $table->string('jurusan')->after('nama');
        });
    }
};
