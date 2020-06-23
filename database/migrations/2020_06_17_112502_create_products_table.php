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
            $table->smallInteger('category_id');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('product_image');
            $table->string('product_code_sku')->nullable();
            $table->string('product_code_mpn')->nullable();
            $table->string('product_code_gtin')->nullable();
            $table->string('product_code_upc')->nullable();
            $table->string('product_code_ean')->nullable();
            $table->string('product_code_isbn')->nullable();
            $table->string('product_code_extension_1')->nullable();
            $table->string('product_code_extension_2')->nullable();
            $table->integer('price_new');
            $table->integer('price_working_a');
            $table->integer('price_working_b');
            $table->integer('price_working_c');
            $table->integer('price_faulty');
            $table->integer('price_damaged');
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
