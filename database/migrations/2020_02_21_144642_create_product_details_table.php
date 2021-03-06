<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->String('artnr');
            $table->String('recommended_fuse');
            $table->integer('driven_shafts');
            $table->integer('centre_distance_mm');
            $table->string('arm_type');
            $table->integer('torque');
            $table->string('brand');
            $table->string('model_type'); // model_type
            $table->integer('diameter_driveshaft_mm');
            $table->integer('diameter_idler_spindle');
            $table->string('range');
            $table->integer('voltage_dc');
            $table->integer('bulkhead_thickness');
            $table->string('kind')->references('kind')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_details');
    }
}
