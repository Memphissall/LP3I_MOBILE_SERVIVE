<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
protected $fillable = [
    'nipd',
    'nama',
    'jenis_kelamin',
    'tempat_lahir',
    'tgl_lahir',
    'id_kelas',
    'jurusan',
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
}
