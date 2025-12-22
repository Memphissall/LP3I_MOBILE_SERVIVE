<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotNilai extends Model
{
    protected $table = 'bobot_nilai';

    protected $fillable = [
        'kode_mk',
        'kehadiran',
        'sikap',
        'formatif',
        'tugas',
        'uts',
        'uas',
        'total'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }
}
