<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_url');
            // $table->unsignedBigInteger('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('artnr')->references('artnr')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('manuals');
    }
}
