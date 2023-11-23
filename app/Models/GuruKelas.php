<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruKelas extends Model
{
    protected $table = 'guru_kelas';

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'tahun_ajaran_id',
        'mata_pelajaran_id'
    ];
    
    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function tahunAjaran(){
        return $this->belongsTo(TahunAjaran::class);
    }

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }    
}
