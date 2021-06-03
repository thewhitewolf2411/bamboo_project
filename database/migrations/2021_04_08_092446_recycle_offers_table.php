<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecycleOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycle_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id');
            $table->string('offer_banner');
            $table->string('offer_mobile_banner');
            $table->string('offer_selling_banner');
            // $table->string('offer_title');
            // $table->string('offer_description');
            // $table->string('offer_additional_info');
            // $table->dateTime('offer_start_date');
            // $table->dateTime('offer_end_date');
            // $table->string('offer_price');
            $table->boolean('status')->default(false);
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
        //
    }
}
