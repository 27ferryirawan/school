<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat_kelas'
    ];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }
}
