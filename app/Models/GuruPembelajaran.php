<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPembelajaran extends Model
{
    use HasFactory;
    protected $table = 'guru_pembelajaran';

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'tahun_ajaran_id',
        'mata_pelajaran_id',
    ];

    public function guru()
    {
        return $this->hasMany(Guru::class);
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
