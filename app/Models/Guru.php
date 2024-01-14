<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'kelas_id',
        'tahun_ajaran_id',
        'mata_pelajaran_id',
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
