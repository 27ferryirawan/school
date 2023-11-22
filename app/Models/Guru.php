<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama_guru',
        'mapel',
        'jenis_kelamin',
    ];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }
}
