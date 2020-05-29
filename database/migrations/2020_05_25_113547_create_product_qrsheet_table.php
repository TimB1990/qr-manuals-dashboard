<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQrsheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_qr_sheet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('qr_sheet_id');
            $table->unsignedBigInteger('product_id');

            // foreign keys
            $table->foreign('qr_sheet_id')->references('id')->on('qr_sheets');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_qr_sheet');
    }
}
