<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianJawaban extends Model
{
    use HasFactory;
    protected $table = 'ujian_jawaban';

    protected $fillable = [
        'ujian_id',
        'siswa_id',
        'finish_date',
        'nilai',
    ];

    public function ujianJawabanDetail()
    {
        return $this->hasMany(UjianJawabanDetail::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
