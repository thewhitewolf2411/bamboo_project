<?php

namespace App\Eloquent\Despatch;

use App\Eloquent\Tradein;
use Illuminate\Database\Eloquent\Model;

class DespatchedDevice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'despatched_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id','order_identifier','order_reference', 'order_date', 'despatched_at'
    ];

    public function getTradeinId(){
        $tradein = Tradein::find($this->tradein_id);
        if($tradein){
            return $tradein->barcode;
        }
    }

    public function getTradeinBarcode(){
        $tradein = Tradein::find($this->tradein_id);
        if($tradein){
            return $tradein->barcode_original;
        }
    }

    public function getModel(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->getProductName($tradein->id);
    }

    public function getCustomer(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->customerName();
    }

    public function getPostCode(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->postCode();
    }

    public function getAddressLine(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->addressLine();
    }

    public function getBambooStatus(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->getBambooStatus();
    }

    public function getCarrier(){
        return "Royal Mail";
    }

    public function getTrackingReference(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->tracking_reference;
    }
}
