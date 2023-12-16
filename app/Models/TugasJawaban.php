<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasJawaban extends Model
{
    use HasFactory;
    protected $table = 'tugas_jawaban';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'description',
        'file_path',
        'file_name',
        'nilai'
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
