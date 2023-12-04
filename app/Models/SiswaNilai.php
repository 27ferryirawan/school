<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaNilai extends Model
{
    use HasFactory;
    protected $table = 'siswa_nilai';

    protected $fillable = [
        'nilai',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function tahunAjaran()
    {
        return $this->hasMany(TahunAjaran::class);
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }
}
