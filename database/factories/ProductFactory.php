<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {


    $randomArticleWord = strtoupper($faker->bothify('??# ###??'));
    $randomArtnr = $faker->numerify($s="######.##");
    $randomNmValue = $faker->numberBetween($min="20", $max="50");
    $randomWdValue = $faker->numberBetween($min = "20", $max="30");

    return [
        'name' => 'EXALTO RW '. $randomArticleWord.' '.'12V '. $randomNmValue .'NM '.'WD '. $randomWdValue.'MM',
        'artnr' => $randomArtnr,
        'kind' => $randomArticleWord
        // 'category_id' => Category::select('id')->orderByRaw("random()")->first()->id
    ];
});