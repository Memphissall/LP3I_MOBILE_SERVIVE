<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidik extends Model
{
    use HasFactory;

    protected $table = 'pendidik';

    protected $primaryKey = 'id_pendidik';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'id_pendidik',
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

    // =====================
    // RELASI
    // =====================

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_pendidik', 'id_pendidik');
    }
}
