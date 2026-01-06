<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'judul_materi',
        'deskripsi',
        'file_materi',
        'pertemuan',
        'nidn',
        'kode_mk',
        'id_kelas'
    ];

    // RELASI
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
}
