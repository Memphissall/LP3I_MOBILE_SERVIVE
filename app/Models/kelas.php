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
        'bidang_keahlian',
        'tahun_ajaran',
        'nama_pa'

    ];

    public function matakuliah()
    {
        return $this->belongsToMany(
            Matakuliah::class,
            'kelas_matakuliah',
            'id_kelas',
            'kode_mk'
        );
    }

    public function materi()
{
    return $this->hasMany(Materi::class, 'id_kelas', 'id_kelas');
}

}
