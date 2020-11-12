<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImeiResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imei_result', function (Blueprint $table) {
            $table->id();
            $table->integer('tradein_id');
            $table->string('API');
            $table->string('remarks');
            $table->string('model_name');
            $table->string('blackliststatus');
            $table->string('greyliststatus');
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
        Schema::dropIfExists('imei_result');
    }
}
