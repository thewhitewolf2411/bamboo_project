<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuarantineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarantine', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->boolean('awaiting_seller_response')->default(false);
            $table->boolean('return_to_seller')->default(false);
            $table->boolean('products_to_retest')->default(false);
            $table->boolean('add_to_stock')->default(false);
            $table->boolean('manually_managed')->default(false);
            $table->integer('days_in_quarantine');
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
        Schema::dropIfExists('quarantine');
    }
}
