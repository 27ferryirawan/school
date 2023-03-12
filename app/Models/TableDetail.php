<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableDetail extends Model
{
    protected $table = 'table_detail';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'table_name',
        'price',
        'status'
    ];
}
