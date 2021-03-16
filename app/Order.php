<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
    
    protected $fillable = ['slug', 'subtotal', 'delivery', 'discount', 'total', 'fee', 'balance', 'type_delivery', 'phone', 'state', 'user_id', 'coupon_id', 'payment_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function shipping() {
        return $this->hasOne(Shipping::class);
    }
}
