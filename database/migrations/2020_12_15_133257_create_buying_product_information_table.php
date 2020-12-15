<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingProductInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_product_information', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('memory');
            $table->string('customer_grade_price_1');
            $table->string('customer_grade_price_2')->nullable();
            $table->string('customer_grade_price_3')->nullable();
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
        Schema::dropIfExists('buying_product_information');
    }
}
