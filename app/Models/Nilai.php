<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'id_pendidik',
        'nipd',
        'nama_mhs',
        'id_kelas',
        'kode_mk',
        'semester',
        'periode',
        'tahun_akademik',
        'nilai_kehadiran',
        'nilai_sikap',
        'nilai_formatif',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'mutu',
        'bobot_ip'
    ];
}

