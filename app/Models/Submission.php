<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submission'; 
    protected $primaryKey = 'id_submission';

    protected $fillable = [
        'file_tugas',
        'id_tugas',
        'id_mahasiswa',
        'status',
        'submitted_at',
    ];

    public function tugas()
{
    return $this->belongsTo(Tugas::class, 'id_tugas', 'id_tugas');
}

public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
}

}
