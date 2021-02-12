<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Tray;
use DNS1D;
use DNS2D;

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
        'trolley_name', 'trolley_type', 'trolley_brand', 'number_of_trays','trolley_type'
    ];

    public function getNumberOfDevices($trolley_id){
        $numberOfDevices = 0;

        $trays = Tray::where('trolley_id', $trolley_id)->get();

        foreach($trays as $tray){
            $numberOfDevices += $tray->number_of_devices;
        }

        return $numberOfDevices;
    }

    public function canBeDeleted(){
        if($this->getNumberOfDevices($this->id) === 0){
            return true;
        }
        return false;
    }

    public function getTrolleyBarcode(){
        return DNS1D::getBarcodeHTML($this->trolley_name, 'C128');
    }
}

