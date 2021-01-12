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
            $table->string('product_state');
            $table->smallInteger('job_state')->nullable()->default(null);
            $table->integer('order_price')->nullable()->default(null);
            //0 received tradein without label
            //1 sent label / job complete
            $table->string('memory');
            $table->string('network');
            $table->string('color')->nullable();
            $table->string('correct_memory')->nullable();
            $table->string('correct_network')->nullable();
            $table->boolean('sent_themselves')->default(false);
            $table->boolean('received')->default(false);
            $table->boolean('device_missing')->nullable()->default(null);
            $table->string('missing_image')->nullable();
            $table->integer('device_correct')->nullable()->default(null);
            $table->boolean('fimp')->nullable();
            $table->boolean('pinlocked')->nullable();
            $table->boolean('device_present_as_described')->nullable()->default(null);
            $table->boolean('chekmend_passed')->nullable()->default(null);
            $table->string('imei_number', 15)->nullable()->default(null);
            $table->boolean('marked_as_risk')->nullable()->default(null);
            $table->boolean('marked_for_quarantine')->nullable()->default(null);
            $table->string('change_device')->nullable()->default(null);
            $table->boolean('visible_imei')->nullable()->default(null);
            $table->boolean('proccessed_before')->nullable()->default(null);
            $table->string('bamboo_grade')->nullable()->default(null);
            $table->boolean('older_than_14_days')->nullable()->default(null);
            $table->integer('quarantine_status')->nullable()->default(null);
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
