<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $fillable = [
        'payment_name',
        'payment_type_id',
        'payment_id',
        'is_available',
        'is_connected',
        'balance',
        'logo_path',
    ];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
