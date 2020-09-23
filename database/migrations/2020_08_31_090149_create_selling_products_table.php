<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->smallInteger('category_id');
            $table->smallInteger('brand_id');
            $table->string('product_memory');
            $table->string('product_colour');
            $table->string('product_network');
            $table->integer('customer_grade_price_1');
            $table->integer('customer_grade_price_2');
            $table->integer('customer_grade_price_3');
            $table->integer('customer_grade_price_4');
            $table->integer('customer_grade_price_5');
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
        Schema::dropIfExists('selling_products');
    }
}
