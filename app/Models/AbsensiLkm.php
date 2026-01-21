<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiLkm extends Model
{
    protected $table = 'absensi_lkm';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_pendidik',
        'nipd',
        'id_kelas', 
        'nama_mhs',
        'kode_mk',
        'tanggal',
        'id_pertemuan',
        'status',
        'materi',
        'catatan',
        'metode_mengajar'
    ];

    public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'nipd', 'nipd');
}

}
