<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'honor';
    protected $primaryKey = 'id_honor';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nidn',
        'kode_mk',
        'id_pertemuan',
        'tanggal',
        'sks',
        'honor_per_sks',
        'honor_mengajar',

        'jenis_honor',
        'bulan',
        'uang_pembuatan_soal',
        'uang_koreksi_jawaban',

        'total_kotor',
        'ppn',
        'gaji_bersih',
        'semester',
        'tahun',
    ];
    
    public function dosen()
{
    return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
}

}

