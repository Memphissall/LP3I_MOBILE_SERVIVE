<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // 1. Add missing fields for KHS (Gunakan check agar tidak double add)
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
            
            // 2. Rename nilai_attitude to nilai_sikap (DENGAN PENGECEKAN)
            if (Schema::hasColumn('nilai', 'nilai_attitude')) {
                $table->renameColumn('nilai_attitude', 'nilai_sikap');
            } else {
                // Jika attitude ga ada, pastikan kolom nilai_sikap tetap ada/dibuat
                if (!Schema::hasColumn('nilai', 'nilai_sikap')) {
                    $table->integer('nilai_sikap')->nullable()->after('tahun_akademik');
                }
            }
            
            // 3. Add calculated fields (DENGAN PENGECEKAN DUPLIKAT)
            if (!Schema::hasColumn('nilai', 'nilai_akhir')) {
                $table->decimal('nilai_akhir', 5, 2)->after('nilai_uas')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'mutu')) {
                $table->string('mutu', 2)->after('nilai_akhir')->nullable();
            }
            if (!Schema::hasColumn('nilai', 'bobot_ip')) {
                $table->decimal('bobot_ip', 3, 2)->after('mutu')->nullable();
            }
            
            // 4. Add foreign key for kelas (Gunakan check agar tidak error jika foreign key sudah dibuat)
            $foreignKeys = Schema::getForeignKeys('nilai');
            $fkExists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_kelas', $fk['columns']);
            });

            if (!$fkExists && Schema::hasColumn('nilai', 'id_kelas')) {
                $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Drop foreign key safely
            $foreignKeys = Schema::getForeignKeys('nilai');
            $fkExists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_kelas', $fk['columns']);
            });

            if ($fkExists) {
                $table->dropForeign(['id_kelas']);
            }

            $table->dropColumn([
                'nidn', 'nipd', 'nama_mhs', 'id_kelas', 'kode_mk',
                'semester', 'periode', 'tahun_akademik',
                'nilai_akhir', 'mutu', 'bobot_ip'
            ]);
            
            if (Schema::hasColumn('nilai', 'nilai_sikap')) {
                $table->renameColumn('nilai_sikap', 'nilai_attitude');
            }
        });
    }
};