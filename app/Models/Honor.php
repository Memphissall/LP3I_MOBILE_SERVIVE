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
        'id_pendidik',
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
    
    public function pendidik()
{
    return $this->belongsTo(Pendidik::class, 'id_pendidik', 'id_pendidik');
}

}

