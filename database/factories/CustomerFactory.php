<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    $email = $faker->email;
    return [
        'email' => $email,
        'company' => $faker->company,
        'contact' => $faker->name,
        'phone' => '',
        'address' => $faker->streetAddress,
        'post_code' => $faker->postcode,
        'residence' => $faker->cityName,
        'token' => bcrypt($email)
    ];
});
