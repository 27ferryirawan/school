<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'tahun_ajaran'
    ];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }
}
