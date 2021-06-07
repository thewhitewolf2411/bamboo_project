<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_lot', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_lot_status')->default(0);
            $table->string('sold_to')->nullable();
            $table->date('date_sold')->nullable();
            $table->string('sold_value')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('carrier')->nullable();
            $table->string('manifest_number')->nullable();
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
        Schema::dropIfExists('sales_lot');
    }
}
