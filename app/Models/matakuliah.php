<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_mk';
    public $incrementing = true;

    protected $fillable = [
        'id_mk',
        'nama_mk',
        'deskripsi',
        'semester',
        'sks',
        'sap',
        'id_program_studi',
        'tipe_matakuliah'
    ];

    public function programStudi()
    {
        return $this->belongsTo(
            ProgramStudi::class,
            'id_program_studi',
            'id_program_studi'
        );
    }

    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
}

}

