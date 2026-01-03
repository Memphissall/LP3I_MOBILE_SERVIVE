<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Add foreign key column
            $table->unsignedBigInteger('id_bidang_keahlian')->nullable()->after('semester');
            
            // Add foreign key constraint
            $table->foreign('id_bidang_keahlian')
                  ->references('id_bidang_keahlian')
                  ->on('bidang_keahlian')
                  ->onDelete('set null');
        });

        // Migrate existing data: map string bidang_keahlian to id
        DB::statement("
            UPDATE mata_kuliah mk
            JOIN bidang_keahlian bk ON bk.nama = mk.bidang_keahlian
            SET mk.id_bidang_keahlian = bk.id_bidang_keahlian
        ");

        // Drop old string column
        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropColumn('bidang_keahlian');
        });
    }

    public function down(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {
            // Re-add string column
            $table->string('bidang_keahlian')->nullable()->after('semester');
        });

        // Migrate data back
        DB::statement("
            UPDATE mata_kuliah mk
            JOIN bidang_keahlian bk ON bk.id_bidang_keahlian = mk.id_bidang_keahlian
            SET mk.bidang_keahlian = bk.nama
        ");

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropForeign(['id_bidang_keahlian']);
            $table->dropColumn('id_bidang_keahlian');
        });
    }
};
