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
            $table->integer('correct_product_id')->nullable();
            $table->string('customer_grade');
            $table->string('bamboo_grade')->nullable();
            $table->string('job_state');
            $table->float('order_price');
            $table->float('bamboo_price')->nullable();
            $table->string('customer_memory');
            $table->string('customer_network')->nullable(true)->default(null);
            $table->string('correct_memory')->nullable();
            $table->string('correct_network')->nullable();
            $table->string('product_colour')->nullable();
            $table->string('missing_image')->nullable();
            $table->string('imei_number', 15)->nullable()->default(null);
            $table->string('serial_number')->nullable()->default(null);
            $table->string('quarantine_reason')->nullable()->default(null);
            $table->date('quarantine_date')->nullable()->default(null);
            $table->boolean('offer_accepted')->nullable();
            $table->string('cosmetic_condition')->nullable();
            $table->bigInteger('cheque_number')->nullable(true)->default(null);
            $table->string('tracking_reference')->nullable(true)->default(null);
            $table->date('expiry_date');
            $table->datetime('location_changed_at')->default(now());
            $table->float('carriage_cost');
            $table->float('admin_cost');
            $table->string('pin_pattern_number')->nullable()->default(null);
            $table->boolean('trade_pack_send_by_customer')->nullable();
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
