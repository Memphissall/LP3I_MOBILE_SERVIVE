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
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Add registration payment validation status
            $table->string('registration_payment_status')->default('unpaid')->after('payment_status');
            // Add registration verification validation status
            $table->string('registration_verification_status')->default('pending')->after('status_verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['registration_payment_status', 'registration_verification_status']);
        });
    }
};
