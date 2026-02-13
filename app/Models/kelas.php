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
        'id_program_studi',
        'semester',
        'tahun_ajaran',
        'id_pendidik'
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_studi', 'id_program_studi');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kelas', 'id_kelas');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id_kelas');
    }

    public function pendidik()
    {
        return $this->belongsTo(Pendidik::class, 'id_pendidik', 'id_pendidik');
    }
}
