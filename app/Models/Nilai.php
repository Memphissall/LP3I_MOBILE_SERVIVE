<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'nidn',
        'nipd',
        'nama_mhs',
        'id_kelas',
        'kode_mk',
        'semester',
        'periode',
        'tahun_akademik',
        'nilai_kehadiran',
        'nilai_sikap',
        'nilai_formatif',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'mutu',
        'bobot_ip'
    ];

    // Relationships
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    // Helper: Calculate nilai akhir
    public static function hitungNilaiAkhir($nilai)
    {
        return round(
            ($nilai['nilai_kehadiran'] ?? 0) * 0.10 +
            ($nilai['nilai_sikap'] ?? 0) * 0.10 +
            ($nilai['nilai_formatif'] ?? 0) * 0.10 +
            ($nilai['nilai_tugas'] ?? 0) * 0.20 +
            ($nilai['nilai_uts'] ?? 0) * 0.25 +
            ($nilai['nilai_uas'] ?? 0) * 0.25,
            2
        );
    }

    // Helper: Get mutu (grade letter)
    public static function getMutu($nilaiAkhir)
    {
        if ($nilaiAkhir >= 85) return 'A';
        if ($nilaiAkhir >= 80) return 'A-';
        if ($nilaiAkhir >= 75) return 'B+';
        if ($nilaiAkhir >= 70) return 'B';
        if ($nilaiAkhir >= 65) return 'B-';
        if ($nilaiAkhir >= 60) return 'C+';
        if ($nilaiAkhir >= 55) return 'C';
        if ($nilaiAkhir >= 50) return 'C-';
        if ($nilaiAkhir >= 45) return 'D';
        return 'E';
    }

    // Helper: Get bobot IP
    public static function getBobotIP($mutu)
    {
        $bobot = [
            'A' => 4.00,
            'A-' => 3.75,
            'B+' => 3.50,
            'B' => 3.00,
            'B-' => 2.75,
            'C+' => 2.50,
            'C' => 2.00,
            'C-' => 1.75,
            'D' => 1.00,
            'E' => 0.00
        ];
        
        return $bobot[$mutu] ?? 0.00;
    }
}
