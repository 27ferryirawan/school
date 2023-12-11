<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianDetailPilgan extends Model
{
    use HasFactory;
    protected $table = 'ujian_detail';

    protected $fillable = [
        'ujian_id',
        'jawaban',
        'is_jawaban',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
