<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
	protected $table = 'image_product';

    protected $fillable = ['image', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
