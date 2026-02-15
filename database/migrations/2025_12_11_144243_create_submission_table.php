
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
        Schema::create('submission', function (Blueprint $table) {
            $table->id('id_submission');
            $table->string('file_tugas');
            $table->foreignId('id_tugas');
            $table->foreignId('id_mahasiswa');
            $table->enum('status', ['Dikumpulkan', 'Terlambat', 'Belum Mengumpulkan'])->default('Belum Mengumpulkan');
              $table->integer('nilai')->nullable();
            $table->text('catatan')->nullable();
            $table->dateTime('submitted_at');
            $table->foreign('id_tugas')->references('id_tugas')->on('tugas')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission');
    }
};
