<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\SalesLotContent;
use App\Eloquent\Tray;
use App\Eloquent\Tradein;

class SalesLot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_lot';


    protected $fillable = [
        'sales_lot_status', 'sold_to', 'date_sold','sold_to', 'sold_value', 'payment_date', 'carrier', 'manifest_number'
    ];

    public function getSalesLotQuantity(){

        $qty = 0;

        /*if($this->sales_lot_status === 5){
            $soldDevices = SoldTradeIns::where('sales_lot_id', $this->id)->get();
            return count($soldDevices);
        }*/

        $salesLotContent = SalesLotContent::where('sales_lot_id', $this->id)->get();

        foreach($salesLotContent as $sLC){
            if($sLC->device_id !== null){
                $qty += 1;
            }
            else{
                if($sLC->box_id !== null){
                    $qty += (Tray::where('id', $sLC->box_id)->first())->number_of_devices;
                }
            }
        }

        return $qty;

    }

    public function getSalesLotPrice(){
        $price = 0;

        /*if($this->sales_lot_status === 5){
            $soldDevices = SoldTradeIns::where('sales_lot_id', $this->id)->get();

            foreach($soldDevices as $sD){
                $price += $sD->bamboo_price;
            }

            return $price;
        }*/

        $salesLotContent = SalesLotContent::where('sales_lot_id', $this->id)->get();

        foreach($salesLotContent as $sLC){
            if($sLC->device_id !== null){
                $tradein = Tradein::where('id', $sLC->device_id)->first();
                $price += $tradein->getDeviceCost();
            }
        }

        return $price;
    }

    public function getStatus($status){
        switch($status){
            case 1:
                return "Sales Lot Under Offer";
            case 2:
                return "Sales Lot Sold";
            case 3:
                return "Sales lot Picked";
            case 4:
                return "Sales Lot Sold - Payment Received";
            case 5:
                return "Sales Lot Despatched";
            case 6:
                return "Picking suspended";
        }
    }


    public function getCustomerName(){
        return Clients::where('id', $this->sold_to)->first()->account_name;
    }
    
}
