<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->unsignedBigInteger('mhs_id');
            $table->unsignedBigInteger('tugas_id');

            // File jawaban
            $table->string('file_tugas_mhs');

            // Penilaian
            $table->decimal('nilai', 5, 2)->nullable();

            // Status
            $table->enum('status', ['submitted', 'late', 'revised'])
                  ->default('submitted');

            // Waktu submit
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            // FK Mahasiswa
            $table->foreign('mhs_id')
                  ->references('id')
                  ->on('mahasiswa')
                  ->onDelete('cascade');

            // FK Tugas (MATCH DENGAN MIGRATION TUGAS)
            $table->foreign('tugas_id')
                  ->references('id_tugas')
                  ->on('tugas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
