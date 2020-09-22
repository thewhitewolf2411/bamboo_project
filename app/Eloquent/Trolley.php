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


    public function getTrolleyTypeName($trolleyType){
        switch($trolleyType){
            case 1:
                return "Testing";
            break;
            case 2:
                return "New";
            break;
            case 3:
                return "Working A";
            break;
            case 4:
                return "Working B";
            break;
            case 5:
                return "Working C";
            break;
            case 6:
                return "Faulty";
            break;
            case 7:
                return "Damaged";
            break;
            case 8:
                return "Quarantine";
            break;
            case 9:
                return "Risk";
            break;
        }
    }

    public function getNumberOfDevices($trolley_id){
        $numberOfDevices = 0;

        $trays = Tray::where('trolley_id', $trolley_id);

        foreach($trays as $tray){
            $numberOfDevices += $tray->number_of_devices;
        }

        return $numberOfDevices;
    }
}

