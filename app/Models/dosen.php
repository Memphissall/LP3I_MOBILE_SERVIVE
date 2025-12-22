<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'nidn',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
