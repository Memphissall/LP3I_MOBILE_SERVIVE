<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs';

    protected $fillable = [
        'id_mahasiswa',
        'id_pendidik',
        'id_kelas',
        'id_mk',
        'semester',
        'tahun_akademik'
    ];

    // Relationships
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul', 'id_mk');
    }

    // Helper: Calculate Total BK for a student in a semester
    public static function getTotalSKS($nipd, $semester, $tahun_akademik)
    {
        return self::where('nipd', $nipd)
            ->where('semester', $semester)
            ->where('tahun_akademik', $tahun_akademik)
            ->where('status', '!=', 'Rejected')
            ->with('mataKuliah')
            ->get()
            ->sum(function($krs) {
                return $krs->mataKuliah->sks ?? 0;
            });
    }
}
