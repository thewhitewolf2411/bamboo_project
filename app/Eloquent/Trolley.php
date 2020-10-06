<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Tray;

class Trolley extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trolleys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trolley_name','number_of_trays','trolley_type'
    ];

    public function getNumberOfDevices($trolley_id){
        $numberOfDevices = 0;

        $trays = Tray::where('trolley_id', $trolley_id)->get();

        foreach($trays as $tray){
            $numberOfDevices += $tray->number_of_devices;
        }

        return $numberOfDevices;
    }
}

