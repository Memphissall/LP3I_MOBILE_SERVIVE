<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'id_kelas',
        'nipd',        // Changed from 'nidn' to match database
        'nama',        // Changed from 'nama_mhs' to match database
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'jurusan',
        'angkatan',
        'periode',
        'email',
        'alamat',
        'no_tlp',      // Changed from 'no_telp' to match database
        'kelas',       // Legacy column
        'foto',
        'status'
    ];

    // Relasi ke kelas (Renamed to dataKelas to avoid collision with 'kelas' string column)
    public function dataKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
