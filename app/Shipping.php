<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['address', 'order_id'];

	public function order() {
	  	return $this->belongsTo(Order::class);
	}
}
