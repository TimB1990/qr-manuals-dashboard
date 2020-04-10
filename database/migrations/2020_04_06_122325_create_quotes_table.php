
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
            $table->unsignedBigInteger('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('product_artnr')->references('artnr')->on('products')->onDelete('cascade');
            $table->string('company');
            $table->string('contact');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('amount');
            $table->enum('status',['pending','processed','approved','released']);
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
