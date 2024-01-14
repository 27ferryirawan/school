<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSoal extends Model
{
    use HasFactory;
    protected $table = 'jenis_soal';

    protected $fillable = [
        'jenis_soal',
        'deskripsi',
        'file_path',
        'file_name',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
