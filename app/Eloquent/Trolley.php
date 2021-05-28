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

    public function getNumberOfDevices(){
        $numberOfDevices = 0;

        $trays = Tray::where('trolley_id', $this->id)->get();

        foreach($trays as $tray){

            $trayContent = TrayContent::where('tray_id', $tray->id)->get();
            foreach($trayContent as $trayItem){
                $tradein = Tradein::where('id', $trayItem->trade_in_id)->first();
                #dd($tradein->isPartOfSalesLot());
                if(!$tradein->isPartOfSalesLot()){
                    $numberOfDevices++;
                }
            }
            #$numberOfDevices += $tray->number_of_devices;
        }

        return $numberOfDevices;
    }

    public function getNumberOfTrays(){
        $trays = Tray::where('trolley_id', $this->id)->get();

        return count($trays);
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

    public function getTrolleyType(){
        switch($this->trolley_type){
            case "R":
                return "Receiving Trolley";
            break;
            case "T":
                return "Testing Trolley";
            break;
        }
    }
}

