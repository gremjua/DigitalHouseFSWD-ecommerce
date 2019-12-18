<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(250),
        'user_id' => 0,
        'product_id' => 0
    ];
});
