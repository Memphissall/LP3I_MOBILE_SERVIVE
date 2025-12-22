<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'tipe_matakuliah'
    ];

    public function kelas()
    {
        return $this->belongsToMany(
            Kelas::class,
            'kelas_matakuliah',
            'kode_mk',      // FK di pivot
            'id_kelas'      // FK di pivot
        );
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kode_mk', 'kode_mk');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kode_mk', 'kode_mk');
    }
}
