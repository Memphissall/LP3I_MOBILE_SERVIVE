<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            // Add missing columns for KRS functionality
            if (!Schema::hasColumn('krs', 'nipd')) {
                $table->string('nipd')->after('id_krs')->nullable();
            }
            if (!Schema::hasColumn('krs', 'nama_mhs')) {
                $table->string('nama_mhs')->after('nipd')->nullable();
            }
            if (!Schema::hasColumn('krs', 'id_kelas')) {
                $table->unsignedBigInteger('id_kelas')->after('nama_mhs')->nullable();
            }
            if (!Schema::hasColumn('krs', 'id_jadwal')) {
                $table->unsignedBigInteger('id_jadwal')->after('id_kelas')->nullable();
            }
            if (!Schema::hasColumn('krs', 'semester')) {
                $table->integer('semester')->after('id_jadwal')->nullable();
            }
            if (!Schema::hasColumn('krs', 'periode')) {
                $table->enum('periode', ['Ganjil', 'Genap'])->after('semester')->nullable();
            }
            if (!Schema::hasColumn('krs', 'tahun_akademik')) {
                $table->string('tahun_akademik')->after('periode')->nullable();
            }
            if (!Schema::hasColumn('krs', 'status')) {
                $table->enum('status', ['Draft', 'Submitted', 'Approved', 'Rejected'])->after('tahun_akademik')->default('Draft');
            }
            if (!Schema::hasColumn('krs', 'catatan')) {
                $table->text('catatan')->after('status')->nullable();
            }
        });

        // Add foreign keys if they don't exist
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        if (!DB::select("SHOW KEYS FROM krs WHERE Key_name='krs_id_kelas_foreign'")) {
            Schema::table('krs', function (Blueprint $table) {
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            });
        }
        
        if (!DB::select("SHOW KEYS FROM krs WHERE Key_name='krs_id_jadwal_foreign'")) {
            Schema::table('krs', function (Blueprint $table) {
                $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            });
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
            $table->dropForeign(['id_jadwal']);
            $table->dropColumn([
                'nipd', 'nama_mhs', 'id_kelas', 'id_jadwal',
                'semester', 'periode', 'tahun_akademik', 'status', 'catatan'
            ]);
        });
    }
};
