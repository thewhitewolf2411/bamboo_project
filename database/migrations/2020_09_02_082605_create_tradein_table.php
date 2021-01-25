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
            $table->integer('barcode_original');
            $table->integer('product_id');
            $table->string('customer_grade');
            $table->string('bamboo_grade')->nullable();
            $table->string('job_state');
            $table->integer('order_price');
            $table->string('customer_memory');
            $table->string('customer_network');
            $table->string('correct_memory')->nullable();
            $table->string('correct_network')->nullable();
            $table->string('missing_image')->nullable();
            $table->string('imei_number', 15)->nullable()->default(null);
            $table->integer('quarantine_reason')->nullable()->default(null);
            $table->date('quarantine_date')->nullable()->default(null);
            
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
