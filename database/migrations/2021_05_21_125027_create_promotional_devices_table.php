<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionalDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotional_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('promo_type');
            $table->integer('device_1')->nullable();
            $table->integer('device_2')->nullable();
            $table->integer('device_3')->nullable();
            $table->integer('device_4')->nullable();
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
        Schema::dropIfExists('promotional_devices');
    }
}
