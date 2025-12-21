<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_ruangan',
        'nama_ruangan',
        'kapasitas',
        'status'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_ruangan', 'id_ruangan');
    }
}
