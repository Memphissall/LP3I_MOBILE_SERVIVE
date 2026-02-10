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
        'id_kelas',
        'id_mk',
        'pertemuan',
        'tanggal',
        'sks',
        'honor_per_sesi',
        'honor_mengajar',

        'jenis_honor',
        'bulan',
        'biaya_pembuatan_soal',
        'biaya_koreksi_jawaban',

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

public function matkul()
{
    return $this->belongsTo(Matakuliah::class, 'id_mk', 'id_mk');
}

   public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    

}



