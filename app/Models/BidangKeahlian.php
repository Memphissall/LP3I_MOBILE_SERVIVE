<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = 'bidang_keahlian';
    protected $primaryKey = 'id_bidang_keahlian';
    
    protected $fillable = [
        'kode',
        'nama',
        'deskripsi'
    ];

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'id_bidang_keahlian', 'id_bidang_keahlian');
    }
}
