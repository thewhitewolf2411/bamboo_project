<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->string('product_description',1000)->nullable();
            $table->smallInteger('category_id');
            $table->smallInteger('brand_id');
            $table->string('product_dimensions')->nullable();
            $table->string('product_processor')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_screen')->nullable();
            $table->string('product_system')->nullable();
            $table->string('product_connectivity')->nullable();
            $table->string('product_battery')->nullable();
            $table->string('product_signal')->nullable();
            $table->string('product_camera')->nullable();
            $table->string('product_camera_2')->nullable();
            $table->string('product_sim')->nullable();
            $table->string('product_memory_slots')->nullable();
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
        Schema::dropIfExists('buying_products');
    }
}
