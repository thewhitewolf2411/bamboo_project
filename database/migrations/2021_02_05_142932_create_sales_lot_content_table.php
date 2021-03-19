<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesLotContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_lot_content', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_lot_id');
            $table->integer('box_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->boolean('picked')->default(false);
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
        Schema::dropIfExists('sales_lot_content');
    }
}
