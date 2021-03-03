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
            case 4:
                return 'Box in sale lot';
            case 5:
                return 'Box picked';
            default:
                return 'Unsigned';
        }
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
            $price += $tradein->bamboo_price;
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


}
