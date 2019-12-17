<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $productList = Product::select('id')->get();
    $productCount = $productList->count();

    $productQuantity = $faker->numberBetween(1, $productCount);
    return [
        'purchase_date' => $faker->dateTime($max = 'now'),
        'product_quantity' => 2,
        'total_quantity' => 4,
        'is_done' => true
    ];
});
