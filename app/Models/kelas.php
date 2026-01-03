<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kelas',
        'id_bidang_keahlian',
        'semester',
        'tahun_ajaran',
        'nama_pa'
    ];

    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_bidang_keahlian', 'id_bidang_keahlian');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kelas', 'id_kelas');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id_kelas');
    }
}
