<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    protected $table = 'siswa_kelas';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'kelas_id',
        'tahun_ajaran_id',
    ];

    public function siswas(){
        return $this->belongsTo(Siswa::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function tahunAjaran(){
        return $this->belongsTo(TahunAjaran::class);
    }
}
