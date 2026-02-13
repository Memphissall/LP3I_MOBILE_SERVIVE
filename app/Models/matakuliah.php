<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_mk';
    
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'deskripsi',
        'tipe_matakuliah',
        'id_program_studi',
        'semester',
        'sks',
        'sap',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_studi', 'id_program_studi');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kode_mk', 'kode_mk');
    }
}
