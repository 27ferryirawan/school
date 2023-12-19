<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;
    protected $table = 'diskusi';

    protected $fillable = [
        'guru_pembelajaran_id',
        'guru_siswa_id',
        'description',
        'role',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
