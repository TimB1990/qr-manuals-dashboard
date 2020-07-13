<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alias');
            $table->integer('pages');
            $table->integer('page_width_mm');
            $table->integer('page_height_mm');
            $table->integer('rows_per_page');
            $table->integer('cols_per_page');
            $table->integer('product_amount');
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_sheets');
    }
}
