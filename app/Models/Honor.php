<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'honor';

    protected $primaryKey = 'id_honor';

    protected $fillable = [
        'nidn',
        'kode_mk',
        'id_pertemuan',
        'tanggal',
        'sks',
        'honor_per_sks',
        'gaji_total',
        'semester',
        'tahun'
    ];
}
