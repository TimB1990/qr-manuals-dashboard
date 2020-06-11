<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quote;
use App\QuoteProduct;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'customer_id' => factory(App\Customer::class),
        'amount' => $faker->numberBetween($min="8", $max="20"),
        'status' => 'pending' 
    ];
});
