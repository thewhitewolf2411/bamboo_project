<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PromotionalDevices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotional_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promo_type','device_1','device_2','device_3', 'device_4'
    ];

    public function getFirstDevice($name = null){

        if($this->device_1 !== null){
            if($name === null){
                return SellingProduct::find($this->device_1);
            }
            return SellingProduct::find($this->device_1)->product_name;
        }
        
        return 'None';
    }

    public function getSecondDevice($name = null){
        if($this->device_2 !== null){
            if($name === null){
                return SellingProduct::find($this->device_2);
            }
            return SellingProduct::find($this->device_2)->product_name;
        }
        
        return 'None';
    }

    public function getThirdDevice($name = null){
        if($this->device_3 !== null){
            if($name === null){
                return SellingProduct::find($this->device_3);
            }
            return SellingProduct::find($this->device_3)->product_name;
        }
        
        return 'None';
    }

    public function getFourhtDevice($name = null){
        if($this->device_4 !== null){
            if($name === null){
                return SellingProduct::find($this->device_4);
            }
            return SellingProduct::find($this->device_4)->product_name;
        }
        
        return 'None';
    }

    public static function getDevice($i){
        if($i === 1){
            $mobileDevices = array();
            $devices = PromotionalDevices::where('promo_type', 2)->get();
            foreach($devices as $device){
                array_push($mobileDevices, SellingProduct::find($device->device_1));
            }

            return $mobileDevices;
        }

        if($i === 2){
            $tabletDevices = array();
            $devices = PromotionalDevices::where('promo_type', 2)->get();
            foreach($devices as $device){
                array_push($tabletDevices, SellingProduct::find($device->device_2));
            }

            return $tabletDevices;
        }

        if($i === 3){
            $smartWatchDevices = array();
            $devices = PromotionalDevices::where('promo_type', 2)->get();
            foreach($devices as $device){
                array_push($smartWatchDevices, SellingProduct::find($device->device_3));
            }

            return $smartWatchDevices;
        }

    }

    public static function getDeviceName($i, $j){
        if($j === 1){
            if(SellingProduct::find(PromotionalDevices::find($i+1)->device_1)){
                return SellingProduct::find(PromotionalDevices::find($i+1)->device_1)->product_name;
            }
        }
        if($j === 2){
            if(SellingProduct::find(PromotionalDevices::find($i+1)->device_2)){
                return SellingProduct::find(PromotionalDevices::find($i+1)->device_2)->product_name;
            }
        }
        if($j === 3){
            if(SellingProduct::find(PromotionalDevices::find($i+1)->device_3)){
                return SellingProduct::find(PromotionalDevices::find($i+1)->device_3)->product_name;
            }
        }

        return null;
    }

}
