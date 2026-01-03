<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_matkul';
    
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'bobot_kompetensi',
        'semester',
        'id_bidang_keahlian',
        'deskripsi',
        'sap'
    ];

    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_bidang_keahlian', 'id_bidang_keahlian');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kode_mk', 'kode_mk');
    }
}
