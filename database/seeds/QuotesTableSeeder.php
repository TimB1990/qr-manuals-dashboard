<?php

use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{

    public function run()
    {
      factory(App\Quote::class,7)->create()->each(function($quote){
          factory(App\QuoteProduct::class)->create([
            'quote_id' => $quote->id
          ]);
      });
    }
}