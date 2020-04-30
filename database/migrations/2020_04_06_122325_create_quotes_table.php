
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('quote_products_id')->references('id')->on('quote_products')->onDelete('cascade');
            $table->integer('amount');
            $table->enum('status',['pending','accepted','processed','approved','review', 'denied']);
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
        Schema::dropIfExists('quotes');
    }
}
