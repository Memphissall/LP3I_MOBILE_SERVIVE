
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_pendidik');
            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_mk');
            $table->integer('semester');
            $table->enum('periode', ['Ganjil', 'Genap']);
            $table->string('tahun_akademik');
            $table->float('nilai_kehadiran')->nullable();
            $table->float('nilai_sikap')->nullable();
            $table->float('nilai_formative')->nullable();
            $table->float('nilai_tugas')->nullable();
            $table->float('nilai_uts')->nullable();
            $table->float('nilai_uas')->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('grade', 2)->nullable();
            $table->decimal('bobot_ip', 3, 2)->nullable();
            $table->foreign('id_pendidik')->references('id_pendidik')->on('pendidik')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_mk')->references('id_mk')->on('matakuliah')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
