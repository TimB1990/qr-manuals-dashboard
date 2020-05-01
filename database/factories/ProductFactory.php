<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

// factory(App\Product::class,7)->create();

$factory->define(Product::class, function (Faker $faker) {


    $randomArticleWord = strtoupper($faker->bothify('??# ###??'));
    $randomArtnr = $faker->numerify($s="######.##");
    $randomNmValue = $faker->numberBetween($min="20", $max="50");
    $randomWdValue = $faker->numberBetween($min = "20", $max="30");

    return [
        'name' => 'EXALTO RW '. $randomArticleWord.' '.'12V '. $randomNmValue .'NM '.'WD '. $randomWdValue.'MM',
        'artnr' => $randomArtnr,
        'kind' => $randomArticleWord,
        'stock' => $faker->numberBetween($min="100", $max = "1000"),
        'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 200, $max=600)
        // 'category_id' => Category::select('id')->orderByRaw("random()")->first()->id
    ];
});