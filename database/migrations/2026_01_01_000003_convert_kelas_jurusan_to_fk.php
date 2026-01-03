<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Add foreign key column
            $table->unsignedBigInteger('id_bidang_keahlian')->nullable()->after('nama_kelas');
            
            // Add foreign key constraint
            $table->foreign('id_bidang_keahlian')
                  ->references('id_bidang_keahlian')
                  ->on('bidang_keahlian')
                  ->onDelete('set null');
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

        foreach ($mapping as $jurusanName => $kode) {
            DB::statement("
                UPDATE kelas k
                JOIN bidang_keahlian bk ON bk.kode = ?
                SET k.id_bidang_keahlian = bk.id_bidang_keahlian
                WHERE k.jurusan = ?
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
        DB::statement("
            UPDATE kelas k
            JOIN bidang_keahlian bk ON bk.id_bidang_keahlian = k.id_bidang_keahlian
            SET k.jurusan = bk.nama
        ");

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['id_bidang_keahlian']);
            $table->dropColumn('id_bidang_keahlian');
        });
    }
};
