<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $primaryKey = 'id_program_studi';

    protected $fillable = [
        'nama_program_studi',
        'kode_program_studi',
    ];

    /**
     * Relasi ke Kelas
     * 1 Program Studi punya banyak Kelas
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_program_studi', 'id_program_studi');
    }
}
