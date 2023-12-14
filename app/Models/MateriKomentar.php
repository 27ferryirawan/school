<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriKomentar extends Model
{
    use HasFactory;
    protected $table = 'materi_komentar';

    protected $fillable = [
        'materi_id',
        'siswa_id',
        'description',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
