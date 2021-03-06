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
            $table->string('excellent_working');
            $table->string('good_working')->nullable();
            $table->string('poor_working')->nullable();
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
