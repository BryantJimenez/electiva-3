<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageProduct;
use Faker\Generator as Faker;

$factory->define(ImageProduct::class, function (Faker $faker) {
    static $num=1;
    return [
        'product_id' => $num++,
        'image' => 'imagen.jpg'
    ];
});
