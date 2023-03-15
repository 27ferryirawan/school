<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model{

    use HasFactory;
    protected $table = 'reservation';

    protected $fillable = [
        'payment_type_id',
        'payment_id',
        'total_fee',
        'created_by',
        'updated_by'
    ];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
