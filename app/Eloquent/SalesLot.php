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
        'sales_lot_status','date_sold','payment_date'
    ];

    public function getSalesLotQuantity(){

        $qty = 0;

        $salesLotContent = SalesLotContent::where('sales_lot_id', $this->id)->get();

        foreach($salesLotContent as $sLC){
            if($sLC->device_id !== null){
                $qty += 1;
            }
            if($sLC->box_id !== null){
                $qty += (Tray::where('id', $sLC->box_id)->first())->number_of_devices;
            }
        }

        return $qty;

    }

    public function getSalesLotPrice(){
        $price = 0;

        $salesLotContent = SalesLotContent::where('sales_lot_id', $this->id)->get();

        foreach($salesLotContent as $sLC){
            if($sLC->device_id !== null){
                $tradein = Tradein::where('id', $sLC->device_id)->first();
                $price += $tradein->bamboo_price;
            }
            if($sLC->box_id !== null){
                $box = Tray::where('id', $sLC->box_id)->first();
                $price += $box->getBoxPrice();
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
        }
    }

    
}
