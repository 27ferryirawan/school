<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama_guru',
        'NIP',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'tempat_lahir',
    ];

    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }
}
