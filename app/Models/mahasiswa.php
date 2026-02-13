<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nipd',
        'nama_mhs',
        'alamat',
        'domisili',
        'tempat_lahir',
        'tgl_lahir',
        'angkatan',
        'periode',
        'email',
        'agama',
        'no_tlp',
        'tahun_lulus',
        'kecamatan',
        'desa',
        'kode_pos',
        'jenis_kelamin',
        'jenis_kelas',
        'status_verifikasi',
        'payment_status',
        'payment_method',
        'payment_proof_path',
        'payment_bank_origin',
        'payment_account_name',
        'payment_sender_name',
        'payment_transfer_date',
        'payment_expires_at',
        'payment_amount',
        'asal_sekolah',
        'file_path',
        'ktp_path',
        'akte_kelahiran_path',
        'ijazah_path',
        'surat_sudah_bekerja_path',
        'instagram_path',
        'nama_wali',
        'telp_wali',
        'pekerjaan_wali',
        'whatsapp_wali',
        'foto',
        'status',
        'id_user',
        'id_program_studi',
        'id_kelas',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'payment_transfer_date' => 'date',
        'payment_expires_at' => 'datetime',
        'payment_amount' => 'decimal:2',
    ];

    // Relationship to Program Studi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_studi', 'id_program_studi');
    }

    // Relationship to Kelas
    public function data_kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    
    // Relationship to Nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'nipd', 'nipd');
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}