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
                $table->string('nipd')->nullable()->after('id_mahasiswa');
            }
            if (!Schema::hasColumn('krs', 'nama_mhs')) {
                $table->string('nama_mhs')->nullable()->after('nipd');
            }
            if (!Schema::hasColumn('krs', 'id_matkul')) {
                $table->unsignedBigInteger('id_matkul')->nullable()->after('id_mk');
            }
            if (!Schema::hasColumn('krs', 'periode')) {
                $table->enum('periode', ['Ganjil', 'Genap'])->nullable()->after('semester');
            }
            if (!Schema::hasColumn('krs', 'tahun_akademik')) {
                $table->string('tahun_akademik')->nullable()->after('periode');
            }
            if (!Schema::hasColumn('krs', 'status')) {
                $table->enum('status', ['Draft', 'Submitted', 'Approved', 'Rejected'])->default('Draft')->after('tahun_akademik');
            }
            if (!Schema::hasColumn('krs', 'catatan')) {
                $table->text('catatan')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $columns = ['nipd', 'nama_mhs', 'id_matkul', 'periode', 'tahun_akademik', 'status', 'catatan'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('krs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
