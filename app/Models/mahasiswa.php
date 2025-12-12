<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'id_kelas',
        'nidn',
        'nama_mhs',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'jurusan',
        'email',
        'alamat',
        'no_telp'
    ];

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
