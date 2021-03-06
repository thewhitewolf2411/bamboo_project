<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBatchDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_batch_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_batch_id');
            $table->integer('tradein_id');
            $table->integer('payment_state')->nullable(true)->default(null);
            $table->dateTime('failed_at')->nullable(true)->default(null);
            $table->boolean('bank_details_updated')->nullable(true)->default(null);
            $table->integer('bank_details_update_order')->nullable(true)->default(null);
            $table->dateTime('bank_details_updated_at')->nullable(true)->default(null);

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
        Schema::dropIfExists('payment_batch_devices');
    }
}
