<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_information', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('memory');
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
        Schema::dropIfExists('product_information');
    }
}
