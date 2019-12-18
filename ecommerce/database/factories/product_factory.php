<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $images = ['remera-mujer.jpg','zapas-hombre.jpg'];
    return [
        'image' => $images[rand(0,1)],
        'name' => $faker->sentence(rand(1,4)),
        'description' => $faker->text(500),
        'price' => $faker->randomFloat(2,0.1,1000),
        'discount' => 0,
        'ranking' => $faker->randomFloat(1,1,5),
        'stock' => $faker->numberBetween(1,1000)
    ];
});
