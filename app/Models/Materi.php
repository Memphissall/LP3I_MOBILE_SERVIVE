<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    public $timestamps = true; 
    
    protected $fillable = [
    'judul_materi',
    'deskripsi',
    'file_materi',
    'link_materi',
    'tipe_materi',
    'pertemuan',
    'id_pendidik',
    'id_mk',
    'id_kelas'
];

    // RELASI
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_mk', 'id_mk');
    }

    public function pendidik()
    {
        return $this->belongsTo(Pendidik::class, 'id_pendidik', 'id_pendidik');
    }
}
