<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $table = 'payment_type';

    protected $fillable = [
        'payment_type_name'
    ];
    
    public function payments(){
        return $this->hasMany(Payment::class, 'payment_type_id');
    }
    
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
