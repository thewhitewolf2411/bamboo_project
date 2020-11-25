<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestingFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testing_faults', function (Blueprint $table) {
            $table->id();
            $table->integer('tradein_id');
            $table->boolean('audio_test')->nullable();
            $table->boolean('front_microphone')->nullable();
            $table->boolean('headset_test')->nullable();
            $table->boolean('loud_speaker_test')->nullable();
            $table->boolean('microphone_playback_test')->nullable();
            $table->boolean('buttons_test')->nullable();
            $table->boolean('camera_test')->nullable();
            $table->boolean('glass_condition')->nullable();
            $table->boolean('vibration')->nullable();
            $table->boolean('original_colour')->nullable();
            $table->boolean('battery_health')->nullable();
            $table->boolean('nfc')->nullable();
            $table->boolean('no_power')->nullable();
            $table->boolean('fake_missing_parts')->nullable();
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
        Schema::dropIfExists('testing_faults');
    }
}
