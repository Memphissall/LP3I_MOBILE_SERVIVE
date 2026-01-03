<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'id_matkul',
        'user_id',
        'nidn',
        'id_dosen_internal',
        'nama_dosen',
        'pendidikan',
        'bidang',
        'tempat',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'no_telp',
        'honor_per_sks',
        'status',
        'foto'
    ];
}
