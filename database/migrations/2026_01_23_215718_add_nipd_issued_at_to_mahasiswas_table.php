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
            if (!Schema::hasColumn('mahasiswas', 'nipd_issued_at')) {
                $table->timestamp('nipd_issued_at')->nullable()->after('nipd')->comment('Timestamp when NIPD was issued');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswas', 'nipd_issued_at')) {
                $table->dropColumn('nipd_issued_at');
            }
        });
    }
};
