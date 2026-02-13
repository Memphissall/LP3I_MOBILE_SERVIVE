<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    
    protected $fillable = [
        'judul_pengumuman',
        'isi',
        'file_path',
    ];
}
