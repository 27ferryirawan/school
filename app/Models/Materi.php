<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';

    protected $fillable = [
        'guru_pembelajaran_id',
        'title',
        'description',
        'file_path',
        'file_name',
    ];

    public function materiKomentar()
    {
        return $this->hasMany(MateriKomentar::class);
    }

    public function guruPembelajaran()
    {
        return $this->belongsTo(GuruPembelajaran::class);
    }
}
