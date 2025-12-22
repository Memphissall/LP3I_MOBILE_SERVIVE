<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    public $incrementing = false;     // WAJIB!!
    protected $keyType = 'string';    // WAJIB!!

    protected $fillable = [
        'id_ruangan',
        'nama_ruangan',
        'kapasitas',
        'status'
    ];
}
