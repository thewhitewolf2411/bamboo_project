<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Trolley;
use App\Eloquent\TrayContent;

class Tray extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tray_name', 'tray_type','tray_brand', 'tray_grade', 'tray_network', 'box_devices', 'trolley_id','number_of_devices','max_number_of_devices'
    ];

    public function getTrolleyName($trolley_id){
        $trolley = Trolley::where('id', $trolley_id)->first();
        return $trolley->trolley_name;
    }

    public function getTrayNumberOfDevices($tray_id){
        return count(TrayContent::where('tray_id', $tray_id)->get());
    }

    public function getBoxStatus(){
        switch($this->status){
            case 1:
                return 'Open';
            case 2:
                return 'Suspended';
            case 3:
                return 'Complete';
            default:
                return 'Unsigned';
        }
    }


}
