<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create bidang_keahlian table
        Schema::create('bidang_keahlian', function (Blueprint $table) {
            $table->id('id_program_studi');
            $table->string('kode', 10)->unique();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Insert initial data
        DB::table('bidang_keahlian')->insert([
            [
                'kode' => 'OAA',
                'nama' => 'Office Administration Assistant',
                'deskripsi' => 'Program Studi Office Administration Assistant',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'AIS',
                'nama' => 'Accounting Information System',
                'deskripsi' => 'Program Studi Accounting Information System',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 'ASE',
                'nama' => 'Advanced Software Engineering',
                'deskripsi' => 'Program Studi Advanced Software Engineering',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bidang_keahlian');
    }
};
