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
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'id_pendidik',
        'nama_pendidik',
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

    // =====================
    // RELASI
    // =====================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_pendidik', 'id_pendidik');
    }
}
