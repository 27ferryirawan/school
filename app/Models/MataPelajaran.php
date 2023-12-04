<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'mata_pelajaran',
        'deskripsi'
    ];

    public function guruKelas()
    {
        return $this->hasMany(GuruKelas::class);
    }

    public function mataPelajaran()
    {
        return $this->hasMany(Guru::class);
    }
}
