<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Add missing fields for KHS
            $table->string('nidn')->after('id_nilai')->nullable();
            $table->string('nipd')->after('nidn')->nullable();
            $table->string('nama_mhs')->after('nipd')->nullable();
            $table->unsignedBigInteger('id_kelas')->after('nama_mhs')->nullable();
            $table->string('kode_mk')->after('id_kelas')->nullable();
            $table->integer('semester')->after('kode_mk')->nullable();
            $table->enum('periode', ['Ganjil', 'Genap'])->after('semester')->nullable();
            $table->string('tahun_akademik')->after('periode')->nullable();
            
            // Rename nilai_attitude to nilai_sikap
            $table->renameColumn('nilai_attitude', 'nilai_sikap');
            
            // Add calculated fields
            $table->decimal('nilai_akhir', 5, 2)->after('nilai_uas')->nullable();
            $table->string('mutu', 2)->after('nilai_akhir')->nullable();
            $table->decimal('bobot_ip', 3, 2)->after('mutu')->nullable();
            
            // Add foreign key for kelas
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
            $table->dropColumn([
                'nidn', 'nipd', 'nama_mhs', 'id_kelas', 'kode_mk',
                'semester', 'periode', 'tahun_akademik',
                'nilai_akhir', 'mutu', 'bobot_ip'
            ]);
            $table->renameColumn('nilai_sikap', 'nilai_attitude');
        });
    }
};
