<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\QuoteProduct;
use Faker\Generator as Faker;

$factory->define(QuoteProduct::class, function (Faker $faker) {

    $randomArticleWord = strtoupper($faker->bothify('??# ###??'));
    $randomArtnr = $faker->numerify($s="########");
    $randomNmValue = $faker->numberBetween($min="20", $max="50");
    $randomWdValue = $faker->numberBetween($min = "20", $max="30");

    return [
        'origin_products_id' => factory(Product::class),
        'quote_id' => factory(Quote::class),
        'unit_price' => rand(100,1000),
        'artnr' => $randomArtnr ,
        'name' => 'EXALTO RW '. $randomArticleWord.' '.'12V '. $randomNmValue .'NM '.'WD '. $randomWdValue.'MM',
        'kind' => $randomArticleWord
    ];
});
