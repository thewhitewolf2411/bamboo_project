<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbandonedCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abandoned_cart', function (Blueprint $table) {
            $table->id();
            $table->string('user_email');
            $table->float('price');
            $table->integer('product_id');
            $table->string('type');
            $table->string('network')->nullable(true)->default(null);
            $table->string('memory');
            $table->string('grade');
            //$table->boolean('email_sent')->default(false);
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
        Schema::dropIfExists('abandoned_cart');
    }
}
