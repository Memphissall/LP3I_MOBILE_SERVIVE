<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;

    protected $fillable = [
    'id_pendidik',
    'id_mahasiswa',
    'id_kelas',
    'id_mk',
    'semester',
    'periode',
    'tahun_akademik',
    'nilai_kehadiran',
    'nilai_sikap',
    'nilai_formative',
    'nilai_tugas',
    'nilai_uts',
    'nilai_uas',
    'nilai_akhir',
    'grade',
    'bobot_ip'
];


  
public function mahasiswa()
{
    return $this->belongsTo(
        \App\Models\Mahasiswa::class,
        'id_mahasiswa',
        'id_mahasiswa'
    );
}

}

