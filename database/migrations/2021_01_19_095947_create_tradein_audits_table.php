<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeinAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradein_audits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tradein_id');
            $table->bigInteger('tradein_barcode');
            $table->bigInteger('tradein_barcode_original');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->string('customer_status', 255);
            $table->string('bamboo_status', 255);
            $table->string('customer_grade', 255)->nullable();
            $table->string('bamboo_grade', 255)->nullable();
            $table->string('value', 255);
            $table->string('stock_location', 255)->nullable();
            $table->string('cheque_number', 255)->nullable();
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
        Schema::dropIfExists('tradein_audits');
    }
}
