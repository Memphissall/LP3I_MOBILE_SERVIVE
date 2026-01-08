<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Add missing fields for KHS if they don't exist
            if (!Schema::hasColumn('nilai', 'nidn')) {
                $table->string('nidn')->after('id_nilai')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'nipd')) {
                $table->string('nipd')->after('nidn')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'nama_mhs')) {
                $table->string('nama_mhs')->after('nipd')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'id_kelas')) {
                $table->unsignedBigInteger('id_kelas')->after('nama_mhs')->nullable();
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            }
            if (!Schema::hasColumn('nilai', 'kode_mk')) {
                $table->string('kode_mk')->after('id_kelas')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'semester')) {
                $table->integer('semester')->after('kode_mk')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'periode')) {
                $table->enum('periode', ['Ganjil', 'Genap'])->after('semester')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'tahun_akademik')) {
                $table->string('tahun_akademik')->after('periode')->nullable();
            }
            
            // Rename nilai_attitude to nilai_sikap safely
            if (Schema::hasColumn('nilai', 'nilai_attitude') && !Schema::hasColumn('nilai', 'nilai_sikap')) {
                $table->renameColumn('nilai_attitude', 'nilai_sikap');
            }

            // Add calculated fields if they don't exist
            if (!Schema::hasColumn('nilai', 'nilai_akhir')) {
                $table->decimal('nilai_akhir', 5, 2)->after('nilai_uas')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'mutu')) {
                $table->string('mutu', 2)->after('nilai_akhir')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'bobot_ip')) {
                $table->decimal('bobot_ip', 3, 2)->after('mutu')->nullable();
            }
            
            // Add id_mahasiswa and id_dosen if they don't exist
            if (!Schema::hasColumn('nilai', 'id_mahasiswa')) {
                $table->unsignedBigInteger('id_mahasiswa')->nullable()->after('id_nilai');
            }
            if (!Schema::hasColumn('nilai', 'id_dosen')) {
                $table->unsignedBigInteger('id_dosen')->nullable()->after('id_mahasiswa');
            }
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            if (Schema::hasColumn('nilai', 'id_mahasiswa')) {
                $table->dropColumn('id_mahasiswa');
            }
            if (Schema::hasColumn('nilai', 'id_dosen')) {
                $table->dropColumn('id_dosen');
            }
            
            // Only drop other columns if we are sure they were added by this migration, 
            // which is hard to track. For safety, we can leave them or drop if exists.
            // Following standard practice:
             $columns = [
                'nidn', 'nipd', 'nama_mhs', 'kode_mk',
                'semester', 'periode', 'tahun_akademik',
                'nilai_akhir', 'mutu', 'bobot_ip'
            ];
            
            $columnsToDrop = [];
            foreach ($columns as $col) {
                if (Schema::hasColumn('nilai', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }

            if (Schema::hasColumn('nilai', 'id_kelas')) {
                // $table->dropForeign(['id_kelas']); // Optional: drop FK
                 $table->dropColumn('id_kelas');
            }

            if (Schema::hasColumn('nilai', 'nilai_sikap') && !Schema::hasColumn('nilai', 'nilai_attitude')) {
                 $table->renameColumn('nilai_sikap', 'nilai_attitude');
            }
        });
    }
};
