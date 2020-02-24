<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigit(6).".".$faker->randomDigit(2),
        'name' => $faker->lorem()->words($nb = 4),
        'kind' => $faker,
        'category_id' => $faker
    ];
});
