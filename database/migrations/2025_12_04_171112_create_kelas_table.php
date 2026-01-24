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
            Schema::create('kelas', function (Blueprint $table) {
                $table->id('id_kelas');
                $table->string('nama_kelas');
                $table->string('nama_pa')->nullable();
                $table->foreignId('id_program_studi');
                $table->foreign('id_program_studi')->references('id_program_studi')->on('program_studi')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('kelas');
        }
    };