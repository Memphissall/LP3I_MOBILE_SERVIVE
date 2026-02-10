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
        'judul_tugas',
        'file_tugas',
        'deskripsi',
        'deadline',
        'tanggal_upload',
        'status',
        'id_kelas',
        'id_mk'
    ];

    protected $casts = [
        'deadline'       => 'datetime',
        'tanggal_upload' => 'datetime',
    ];

   
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
        return $this->belongsTo(Matakuliah::class, 'id_mk', 'id_mk');
    }

    public function submissions()
{
    return $this->hasMany(Submission::class, 'id_tugas', 'id_tugas');
}

}

