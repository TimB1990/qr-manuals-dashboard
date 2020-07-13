<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductDetails;
use Faker\Generator as Faker;

$factory->define(ProductDetails::class, function (Faker $faker) {
    return [
        'product_id' => 0,
        'artnr' => '',
        'recommended_fuse' => 15,
        'driven_shafts' => 2,
        'centre_distance_mm' => 60,
        'arm_type' => 'PF MD2 PF HD1 P10',
        'torque' => 30,
        'brand' => 'Exalto',
        'model_type' => 'WiperMotor',
        'diameter_driveshaft_mm' => 20,
        'diameter_idler_spindle' => 20,
        'range' => 'MD2',
        'voltage_dc' => 12,
        'bulkhead_thickness' => 25,
        'kind' => ''
    ];
});
