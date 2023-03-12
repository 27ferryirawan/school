<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'table_id',
        'reservation_date',
        'fee',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function tableDetail()
    {
        return $this->belongsTo(TableDetail::class, 'table_id');
    }
}
