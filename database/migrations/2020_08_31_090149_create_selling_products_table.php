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
            $table->boolean('checkmend_check')->default(true);
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
