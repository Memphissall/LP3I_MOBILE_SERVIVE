<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
protected $fillable = [
    'nipd',
    'nama_mhs',
    'jenis_kelamin',
    'tempat_lahir',
    'tgl_lahir',
    'id_kelas',
    'bidang_keahlian',
    'email',
    'alamat',
    'agama',
    'no_tlp',
    'foto',
    'status'
];
    
    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function user()
{
    // Sesuaikan foreign key-nya, misalnya 'id_user' atau 'user_id'
    return $this->belongsTo(User::class, 'id_user'); 
}
}
