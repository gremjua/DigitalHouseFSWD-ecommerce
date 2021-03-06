<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PurchaseOrder;
use Faker\Generator as Faker;

$factory->define(PurchaseOrder::class, function (Faker $faker) {
    return [
        'purchase_date' => $faker->dateTime($max = 'now'),
        // 'product_quantity' => 2, TODO: remove these columns probably
        // 'total_quantity' => 4,
        'is_done' => true
    ];
});
