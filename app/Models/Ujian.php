<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujian';

    protected $fillable = [
        'guru_pembelajaran_id',
        'jenis_ujian_id',
        'deskripsi',
        'kode_ruangan',
        'waktu_pengerjaan',
        'tanggal_ujian'
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

    public function jenisUjian()
    {
        return $this->hasMany(JenisUjian::class);
    }
}
