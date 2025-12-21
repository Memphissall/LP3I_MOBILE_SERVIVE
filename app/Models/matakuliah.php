<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'jenis',
        'jurusan',
        'deskripsi'
    ];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kode_mk', 'kode_mk');
    }
}
