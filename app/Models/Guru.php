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

    public function tahunAjaran()
    {
        return $this->hasMany(TahunAjaran::class);
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }
}
