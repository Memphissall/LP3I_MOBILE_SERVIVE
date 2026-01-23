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
        // Clear all NIPDs for records that don't have nipd_issued_at (old NIPDs from before the new logic)
        // Only clear for records where registration_payment_status != 'paid'
        \Illuminate\Support\Facades\DB::table('mahasiswas')
            ->where('registration_payment_status', '!=', 'paid')
            ->whereNotNull('nipd')
            ->whereNull('nipd_issued_at')
            ->update(['nipd' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration clears data, so down() doesn't restore it
        // No action needed for down()
    }
};
