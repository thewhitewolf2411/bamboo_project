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
            $table->string('product_grade_1');
            $table->string('product_grade_2');
            $table->string('product_grade_3');
            $table->integer('product_selling_price_1');
            $table->integer('product_selling_price_2');
            $table->integer('product_selling_price_3');
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
