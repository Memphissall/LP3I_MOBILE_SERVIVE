<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
     protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_mk', 'id_mk');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }
    public function pendidik()
    {
    return $this->belongsTo(Pendidik::class, 'id_pendidik', 'id_pendidik');
    }

}
