<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nipd',
        'nama',
        'id_bidang_keahlian',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'kelas',
        'email',
        'alamat',
        'agama',
        'no_tlp',
        'foto',
        'status',
        'id_kelas',
        'angkatan',
        'periode'
    ];

    // Relationship to Bidang Keahlian
    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_bidang_keahlian', 'id_bidang_keahlian');
    }

    // Relationship to Kelas
    public function data_kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}