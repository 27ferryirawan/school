<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';

    protected $fillable = [
        'id',
        'NISN',
        'nama_siswa',
        'jenis_kelamin'
    ];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }
}
