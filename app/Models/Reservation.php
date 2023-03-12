<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';

    protected $fillable = [
        'payment_status',
        'payment_type',
        'total_fee',
        'created_by',
    ];
}
