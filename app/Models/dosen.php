<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Point ke tabel pendidik
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
        'foto',
        'total_gaji_diterima',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'rate_gaji' => 'decimal:2',
        'total_gaji_diterima' => 'decimal:2',
    ];

    /**
     * Relationship to User model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
