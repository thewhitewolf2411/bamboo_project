<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Trolley;
use App\Eloquent\TrayContent;
use App\Eloquent\Tradein;

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
        'tray_name', 'tray_type','tray_brand', 'tray_grade', 'tray_network', 'box_devices', 'trolley_id','number_of_devices','max_number_of_devices','status'
    ];

    public function tray_content(){
        return $this->hasMany('App\Eloquent\TrayContent');
    }

    public function getTrolleyName($trolley_id = null){
        $trolley = Trolley::where('id', $this->trolley_id)->first();
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
                /*if($this->trolley_id !== null){
                    return 'In Bay ' . $this->getTrolleyName($this->trolley_id);
                }*/
                return 'Complete';
            case 4:
                return 'Box in sale lot';
            case 5:
                return 'Box picked';
            default:
                return 'Unsigned';
        }
    }

    public function getNumberOfDevices(){

        $numberOfDevices = 0;

        $trayContent = TrayContent::where('tray_id', $this->id)->get();
        foreach($trayContent as $trayItem){
            $tradein = Tradein::where('id', $trayItem->trade_in_id)->first();
            #dd($tradein->isPartOfSalesLot());
            if(!$tradein->isPicked()){
                $numberOfDevices++;
            }
        }

        return $numberOfDevices;
    }

    public function canBeDeleted(){
        if($this->number_of_devices > 0){
            return false;
        }
        return true;
    }
    
    public function getBoxPrice(){

        $price = 0;

        $traycontent = TrayContent::where('tray_id', $this->id)->get();
        foreach($traycontent as $tc){
            $tradein = Tradein::where('id', $tc->trade_in_id)->first();
            $price += $tradein->getDeviceCost();
        }

        return $price;
    }

    public function getBoxBrand(){
        switch($this->tray_brand){
            case "Apple":
                return 1;
            case "Samsung":
                return 2;
            case "Huaweii":
                return 3;
            default:
                return 4;
        }
    }

    public function getTrayDevices(){
        switch($this->tray_brand){
            case "Apple":
                return "Apple";
            case "Samsung":
                return "Samsung";
            case "Huawei":
                return "Huawei";
            default:
                return "Miscellaneous";
        }
    }

    public function isBoxInSaleLot(){
        $saleLotContent = SalesLotContent::where('box_id', $this->id)->get();
        if(count($saleLotContent) === $this->number_of_devices){
            return true;
        }

        return false;
    }

    public function getBinReason(){
        switch($this->tray_grade){
            case 'FIMP':
                return "FMIP Lock";
                break;
            case 'GOCK':
                return "Google Lock";
                break;
            case 'WRPH':
                return "Wrong Device";
                break;
            case 'DEMI':
                return "Device Missing";
                break;
            case 'BLCK':
                return "Blacklisted";
                break;
            case 'PIN':
                return "Pin locked";
                break;
            case 'DOWN':
                return "Downgraded";
                break;
        }
    }

    public function isInBay(){
        if($this->trolley_id !== null){
            $trolley = Trolley::where('id', $this->trolley_id)->first();

            if($trolley !== null && $trolley->trolley_type === 'Bay'){
                return true;
            }
        }

        return false;
    }

    public function isSold(){
        if($this->status === 10){
            return true;
        }

        return false;
    }

    public function getNumberOfDevicesInSaleLot(){
        $traycontent = TrayContent::where('tray_id', $this->id)->get();
        $number = 0;
        foreach($traycontent as $tc){
            if(SalesLotContent::where('box_id', $this->id)->where('device_id', $tc->trade_in_id)->first()){
                $number++;
            }
            
        }

        return $number;
    }

}
