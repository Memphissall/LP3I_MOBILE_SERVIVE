<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('kelas', 'id_program_studi')) {
                // Add foreign key column
                $table->unsignedBigInteger('id_program_studi')->nullable()->after('nama_kelas');

                // Add foreign key constraint
                $table->foreign('id_program_studi')
                    ->references('id_program_studi')
                    ->on('bidang_keahlian')
                    ->onDelete('set null');
            }
        });

        // Migrate existing data: map string jurusan to id
        // Mapping jurusan names to bidang keahlian
        $mapping = [
            'Office Administration Assistant' => 'OAA',
            'OAA' => 'OAA',
            'Accounting Information System' => 'AIS',
            'AIS' => 'AIS',
            'Advanced Software Engineering' => 'ASE',
            'ASE' => 'ASE',
            'Teknik Informatika' => 'ASE',
            'Sistem Informasi' => 'AIS',
            'Akuntansi' => 'AIS'
        ];

        // SQLite doesn't support UPDATE JOIN, so we use subquery instead
        foreach ($mapping as $jurusanName => $kode) {
            DB::statement("
                UPDATE kelas
                SET id_program_studi = (
                    SELECT id_program_studi
                    FROM bidang_keahlian
                    WHERE bidang_keahlian.kode = ?
                )
                WHERE jurusan = ?
            ", [$kode, $jurusanName]);
        }

        // Drop old string column
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('jurusan');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Re-add string column
            $table->string('jurusan')->nullable()->after('nama_kelas');
        });

        // Migrate data back
        // SQLite doesn't support UPDATE JOIN, so we use subquery instead
        DB::statement("
            UPDATE kelas
            SET jurusan = (
                SELECT nama
                FROM bidang_keahlian
                WHERE bidang_keahlian.id_program_studi = kelas.id_program_studi
            )
            WHERE id_program_studi IS NOT NULL
        ");

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['id_program_studi']);
            $table->dropColumn('id_program_studi');
        });
    }
};
