<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianDetailPilgan extends Model
{
    use HasFactory;
    protected $table = 'ujian_detail_pilgan';

    protected $fillable = [
        'ujian_detail_id',
        'jawaban',
        'is_jawaban',
        'no_jawaban',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
