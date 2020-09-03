<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradein', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('barcode');
            $table->integer('product_id');
            $table->string('product_state');
            $table->boolean('proccessed_before')->nullable();
            $table->boolean('device_status_missing')->nullable();
            $table->boolean('has_device_been_21_days')->defanullable();
            $table->boolean('status')->nullable();
            $table->boolean('different_device_model')->nullable();
            $table->boolean('device_missing')->nullable();
            $table->boolean('device_present_as_described')->nullable();
            $table->boolean('');

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
        Schema::dropIfExists('tradein');
    }
}
