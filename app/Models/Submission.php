<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions'; 
    protected $primaryKey = 'id_submission'; 
    public $timestamps = false; 

    protected $fillable = [
        'tugas_id',
        'nim',
        'file',
        'nilai',
        'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}
