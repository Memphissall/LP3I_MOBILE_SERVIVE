<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;


class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';
    protected $guarded = [];

    protected $fillable = [
        'kode_mk',
        'id_kelas',
        'judul',
        'deskripsi',
        'tanggal_upload',
        'deadline',
        'file_tugas',
        'status'
    ];

    protected $casts = [
        'deadline'       => 'datetime',
        'tanggal_upload' => 'datetime',
    ];

    // ⬇️ TAMBAHKAN INI
    public function isAktif()
    {
        return Carbon::now('Asia/Jakarta')->lessThanOrEqualTo($this->deadline);
    }

    // (opsional tapi rapi)
    public function getStatusOtomatisAttribute()
    {
        return $this->isAktif() ? 'aktif' : 'nonaktif';
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }
}

