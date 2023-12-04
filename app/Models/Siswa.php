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
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'tempat_lahir'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function tahunAjaran()
    {
        return $this->hasMany(TahunAjaran::class);
    }
}
