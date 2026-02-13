<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Drop old nama_pa column
            $table->dropColumn('nama_pa');
            
            // Add new id_pendidik foreign key
            $table->unsignedBigInteger('id_pendidik')->nullable()->after('tahun_ajaran');
            
            // Add foreign key constraint
            $table->foreign('id_pendidik')
                ->references('id_pendidik')
                ->on('pendidik')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['id_pendidik']);
            $table->dropColumn('id_pendidik');
            
            // Restore nama_pa column
            $table->string('nama_pa')->nullable();
        });
    }
};
