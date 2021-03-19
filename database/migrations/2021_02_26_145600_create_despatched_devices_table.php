<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespatchedDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despatched_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('tradein_id');
            $table->string('order_identifier');
            $table->string('order_reference');
            $table->string('order_date');
            $table->dateTime('despatched_at')->nullable(true)->default(null);
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
        Schema::dropIfExists('despatched_devices');
    }
}
