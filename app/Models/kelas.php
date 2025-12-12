<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';   // ← WAJIB
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kelas'
    ];
}

