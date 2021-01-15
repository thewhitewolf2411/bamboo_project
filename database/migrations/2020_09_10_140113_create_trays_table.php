<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trays', function (Blueprint $table) {
            $table->id();
            $table->string('tray_name')->unique();
            $table->string('tray_type');
            $table->string('tray_brand');
            $table->string('tray_grade');
            $table->integer('trolley_id')->nullable();
            $table->integer('number_of_devices')->default(0);
            $table->integer('max_number_of_devices')->default(100);
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
        Schema::dropIfExists('trays');
    }
}
