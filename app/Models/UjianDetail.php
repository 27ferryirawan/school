<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianDetail extends Model
{
    use HasFactory;
    protected $table = 'ujian_detail';

    protected $fillable = [
        'ujian_id',
        'jenis_soal_id',
        'nomor',
        'soal',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class);
    }
}
