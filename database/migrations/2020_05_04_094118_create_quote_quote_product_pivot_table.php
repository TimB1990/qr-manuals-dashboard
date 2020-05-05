<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuoteQuoteProductPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_quote_product', function (Blueprint $table) {
            $table->unsignedBigInteger('quote_id')->index();
            $table->foreign('quote_id')->references('id')->on('quote_products')->onDelete('cascade');
            $table->unsignedBigInteger('quote_product_id')->index();
            $table->foreign('quote_product_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->primary(['quote_id', 'quote_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_quote_product');
    }
}
