<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'id_kelas',
        'nipd',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'jurusan',
        'angkatan',
        'periode',
        'email',
        'alamat',
        'no_tlp',
        'kelas',
        'foto',
        'status'
    ];

    // Diubah menjadi data_kelas agar sinkron dengan JavaScript di Blade
    public function data_kelas()
    {
        // id_kelas adalah foreign key di tabel mahasiswa
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}