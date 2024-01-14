<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianJawabanDetail extends Model
{
    use HasFactory;
    protected $table = 'ujian_jawaban_detail';

    protected $fillable = [
        'ujian_jawaban_id',
        'ujian_detail_id',
        'jenis_soal_id',
        'ujian_detail_pilgan_id',
        'jawaban_deskripsi',
    ];

    public function ujianJawaban()
    {
        return $this->belongsTo(UjianJawaban::class);
    }

    public function jenisSoal()
    {
        return $this->belongsTo(JenisSoal::class);
    }

    public function ujianDetailPilgan()
    {
        return $this->belongsTo(JenisSoal::class);
    }
}
