
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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nipd')->unique();
            $table->string('nama_mhs');
            $table->text('alamat');
            $table->string('domisili');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('angkatan');
            $table->string('periode');
            $table->string('email')->unique();
            $table->string('agama');
            $table->string('no_tlp');
            $table->string('tahun_lulus')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('jenis_kelas')->nullable();
            $table->string('status_verifikasi')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proof_path')->nullable();
            $table->string('payment_bank_origin')->nullable();
            $table->string('payment_account_name')->nullable();
            $table->string('payment_sender_name')->nullable();
            $table->string('payment_transfer_date')->nullable();
            $table->string('payment_expires_at')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('file_path')->nullable();
            $table->string('ktp_path')->nullable();
            $table->string('akte_kelahiran_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->string('surat_sudah_bekerja_path')->nullable();
            $table->string('instagram_path')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('telp_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('whatsapp_wali')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreignId('id_program_studi');
            $table->foreign('id_program_studi')->references('id_program_studi')->on('program_studi')->onDelete('cascade');
            $table->foreignId('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
