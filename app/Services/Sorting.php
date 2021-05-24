<?php 
namespace App\Services;

use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;
use App\Eloquent\SellingProduct;

class Sorting{


    /**
     * Lowest GB
     * Excellent working
     * unlocked
     */

    private $brand = null;
    private $category = null;

    public function __construct($brand = null, $category = null)
    {
        $this->brand = $brand;
        $this->category = $category;
    }


    public function sortDevices(){

        return $this->_sortDevices();

    }

    private function _sortDevices(){

        $sellingDevices = null;

        if($this->brand !== null && $this->category !== null){
            $sellingDevices = SellingProduct::where('category_id', $this->category)->where('brand_id', $this->brand)->get();
        }
        else if($this->brand === null && $this->category !== null){
            $sellingDevices = SellingProduct::where('category_id', $this->category)->get();
        }
        else if($this->brand !== null && $this->category === null){
            $sellingDevices = SellingProduct::where('brand_id', $this->brand)->get();
        }
        else{
            $sellingDevices = SellingProduct::all();
        }

        #dd($sellingDevices);

        $prices = array();

        foreach($sellingDevices as $device){
            $prices[$device->id] = $this->getDeviceHighestPrice($device);
        }

        arsort($prices);

        $sortedDevices = collect();

        foreach($prices as $key=>$price){
            $sortedDevice = SellingProduct::find($key);
            $sortedDevices->push($sortedDevice);
        }

        return $sortedDevices;
        #dd($sortedDevices);

    }

    private function getDeviceHighestPrice(SellingProduct $device){
        return $this->getExcellentWorkingPrice($device) - $this->getUnlockedKnockoffPrice($device);
    }

    private function getUnlockedKnockoffPrice(SellingProduct $device){
        if(ProductNetworks::where('product_id', $device->id)->where('network_id', 5)->first()){
            return ProductNetworks::where('product_id', $device->id)->where('network_id', 5)->first()->knockoff_price;
        }
        return 0;
    }

    private function getLowestMemoryId(SellingProduct $device){
        return ProductInformation::where('product_id', $device->id)->first();
    }

    private function getExcellentWorkingPrice(SellingProduct $device){
        return $this->getLowestMemoryId($device)->excellent_working;
    }

}
