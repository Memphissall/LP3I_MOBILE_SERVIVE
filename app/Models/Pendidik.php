<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidik extends Model
{
    protected $table = 'pendidik';
    protected $primaryKey = 'id_pendidik';
    
    protected $fillable = [
        'id_user',
        'nama_pendidik',
        'pendidikan',
        'bidang',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'no_tlp',
        'rate_gaji',
        'status',
        'foto'
    ];

    // Relationships
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_pendidik', 'id_pendidik');
    }
}
