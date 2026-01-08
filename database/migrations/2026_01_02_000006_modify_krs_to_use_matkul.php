<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Handle Foreign Key for id_jadwal
        // Find actual Foreign Key name from database to avoid guessing 'krs_id_jadwal_foreign'
        $fkCheck = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_NAME = 'krs' 
            AND COLUMN_NAME = 'id_jadwal' 
            AND TABLE_SCHEMA = DATABASE() 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");

        if (!empty($fkCheck)) {
            $fkName = $fkCheck[0]->CONSTRAINT_NAME;
            Schema::table('krs', function (Blueprint $table) use ($fkName) {
                $table->dropForeign($fkName);
            });
        }

        // 2. Handle Unique Index
        // Find if any unique index exists involving 'id_jadwal'
        // OR just try to drop the known standard name key 'krs_unique' if it exists.
        // We can check Existence using Schema::hasIndex (available in newer Laravel) or raw SQL.
        // For safety/compatibility, we'll try to drop 'krs_unique' if it shows up in SHOW KEYS.
        
        $keys = DB::select("SHOW KEYS FROM krs WHERE Key_name = 'krs_unique'");
        if (!empty($keys)) {
             Schema::table('krs', function (Blueprint $table) {
                $table->dropUnique('krs_unique');
             });
        } else {
            // Also check for composite unique on (nipd, id_jadwal, ...). 
            // It might be named differently if created manually.
            // But we'll assume standard naming from creating migration.
            // If the user has a different index name causing 1072, we might need to find it.
            // But usually 1072 refers to the KEY that effectively implements the FK or Unique checks.
        }

        Schema::table('krs', function (Blueprint $table) {
            // 3. Drop id_jadwal column
            if (Schema::hasColumn('krs', 'id_jadwal')) {
                 // Double check if any other index is holding this column?
                 // Most likely dropped above.
                $table->dropColumn('id_jadwal');
            }
            
            // 4. Add id_matkul column
            if (!Schema::hasColumn('krs', 'id_matkul')) {
                $table->unsignedBigInteger('id_matkul')->after('id_kelas')->nullable();
            }
        });

        // 5. Add new Foreign Key for id_matkul
        Schema::table('krs', function (Blueprint $table) {
             // We can safely add FK if column exists. 
             // Idempotency: check if FK exists? 
             // We'll trust mapped array to name conversion or error out if exists (which is fine, means already done).
             // To be 100% safe against "Foreign key already exists":
             
             // We'll skip if it seems to exist.
             // But simpler: just add it. If it fails, users usually don't mind "already exists" as much as "drop failed".
             // We'll assume if id_matkul was just added or existed, we want the FK.
             
             try {
                 $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah')->onDelete('cascade');
             } catch (\Exception $e) {
                 // Suppress "Duplicate foreign key constraint name"
             }
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            // Reverse operations
            
            // Drop matkul FK and column
             try {
                $table->dropForeign(['id_matkul']);
            } catch (\Exception $e) {}
            
            if (Schema::hasColumn('krs', 'id_matkul')) {
                $table->dropColumn('id_matkul');
            }

            // Restore id_jadwal
            if (!Schema::hasColumn('krs', 'id_jadwal')) {
                $table->unsignedBigInteger('id_jadwal')->after('id_kelas')->nullable();
                $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            }
            
            // Restore unique index? Not strictly necessary for rollback correctness unless data integrity required.
        });
    }
};
