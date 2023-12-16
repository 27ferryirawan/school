<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';

    protected $fillable = [
        'guru_pembelajaran_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'due_date'
    ];

    public function tugasJawaban()
    {
        return $this->hasMany(TugasJawaban::class);
    }

    public function guruPembelajaran()
    {
        return $this->belongsTo(GuruPembelajaran::class);
    }
}
