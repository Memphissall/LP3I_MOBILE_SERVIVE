<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    
    protected $fillable = [
        'id_mk',
        'id_pendidik',
        'id_kelas',
        'id_ruangan',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'semester',
    ];

    // Relationship to Materi Ajar
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    // Relationship to Pendidik (via Dosen model which points to pendidik table)
    public function pendidik()
    {
        return $this->belongsTo(Dosen::class, 'id_pendidik', 'id_pendidik');
    }

    // Alias for backward compatibility
    public function dosen()
    {
        return $this->pendidik();
    }

    // Relationship to Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relationship to Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }
}
