<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $primaryKey = 'id_program_studi';

    protected $fillable = [
        'nama_program_studi',
        'kode_program_studi',
    ];

    /**
     * Relationship to Kelas
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_program_studi', 'id_program_studi');
    }

    /**
     * Relationship to Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_program_studi', 'id_program_studi');
    }

    /**
     * Relationship to Matakuliah
     */
    public function matakuliah()
    {
        return $this->hasMany(MataKuliah::class, 'id_program_studi', 'id_program_studi');
    }
}
