<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldTradeinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_tradeins', function (Blueprint $table) {
            $table->id();
            $table->integer('device_barcode');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('sales_lot_id');
            $table->integer('bamboo_price');
            $table->string('bamboo_grade');
            $table->string('cosmetic_condition');
            $table->string('sold_to');
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
        Schema::dropIfExists('sold_tradeins');
    }
}
