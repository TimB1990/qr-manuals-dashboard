<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orgin_products_id')->references('id')->on('products');
            $table->unsignedBigInteger('quotes_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->decimal('unit_price',6,2);
            $table->string('artnr');
            $table->string('name');
            $table->string('kind');
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
        Schema::dropIfExists('quote_products');
    }
}
