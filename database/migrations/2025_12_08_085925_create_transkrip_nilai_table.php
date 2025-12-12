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
        Schema::create('transkrip_nilai', function (Blueprint $table) {
           $table->id('id_transkrip'); 
            $table->string('nipd')->unique(); 
            $table->decimal('ipk', 3, 2)->nullable(); 
            $table->date('tanggal_lulus')->nullable(); 
            $table->timestamps();
            $table->foreign('nipd')->references('nipd')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transkrip_nilai');
    }
};
