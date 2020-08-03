<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->string('product_description',1000);
            $table->smallInteger('category_id');
            $table->smallInteger('brand_id');
            $table->string('product_network');
            $table->string('product_memory');
            $table->string('product_colour');
            $table->string('product_grade');
            $table->string('product_dimensions');
            $table->string('product_processor');
            $table->string('product_weight');
            $table->string('product_screen');
            $table->string('product_system');
            $table->string('product_connectivity');
            $table->string('product_battery');
            $table->string('product_signal');
            $table->string('product_camera');
            $table->string('product_camera_2')->nullable();
            $table->string('product_sim');
            $table->string('product_memory_slots');
            $table->smallInteger('product_quantity');
            $table->integer('base_price');
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
        Schema::dropIfExists('products');
    }
}
