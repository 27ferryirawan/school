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
        'guru_siswa_id',
        'description',
        'role',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
