<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TestingFaults extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testing_faults';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id','audio_test','front_microphone','headset_test',
        'loud_speaker_test','microphone_playback_test','buttons_test',
        'camera_test','glass_condition','vibration','original_colour',
        'battery_health','nfc','no_power','fake_missing_parts','knox_removed'
    ];
}
