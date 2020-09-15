<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestingQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testing_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->boolean('fake_missing_parts')->nullable()->default(null);
            $table->string('fake_missing_parts_image')->nullable()->default(null);
            $table->boolean('device_fully_functional')->nullable()->default(null);
            $table->string('device_fully_functional_reasons')->nullable()->default(null);
            $table->boolean('signs_of_water_damage')->nullable()->default(null);
            $table->boolean('FIMP_Google_lock')->nullable()->default(null);
            $table->boolean('pin_lock')->nullable()->default(null);
            $table->string('cosmetic_condition')->nullable()->default(null);
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
        Schema::dropIfExists('testing_questions');
    }
}
