<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        factory(App\Product::class,7)->create()->each(function($product){
            factory(App\ProductDetails::class)->create([
                'product_id' => $product->id,
                'artnr' => $product->artnr,
                'kind' => $product->kind
            ]);
        });
    }
}