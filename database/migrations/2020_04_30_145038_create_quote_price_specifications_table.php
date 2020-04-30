<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotePriceSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_price_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quotes_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->decimal('new_unit_price',6,2);
            $table->decimal('total',6,2);
            $table->decimal('discount',6,2);
            $table->decimal('tax',6,2);
            $table->decimal('shipping_per_unit',6,2);
            $table->decimal('shipping_tax',6,2);
            $table->decimal('final_total',6,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_price_specifications');
    }
}
