<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiLkm extends Model
{
    protected $table = 'absensi_lkm';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_pendidik',
        'id_mahasiswa',
        'id_kelas', 
        'nama_mhs',
        'sub_pembahasan',
        'id_mk',
        'tanggal',
        'pertemuan',
        'status',
        'materi',
        'catatan',
        'metode_mengajar'
    ];

 public function mahasiswa()
{
    return $this->belongsTo(
        \App\Models\Mahasiswa::class,
        'id_mahasiswa',
        'id_mahasiswa'
    );
}


}
