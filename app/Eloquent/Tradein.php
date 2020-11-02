<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;

class Tradein extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradein';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'barcode','barcode_original','product_id','product_state', 'job_state', 'sent_themselves', 'order_price', 'receoved', 'device_missing', 'device_correct', 'device_present_as_described', 'checkmend_passed', 'imei_number', 'change_device',
        'visible_imei', 'proccessed_before', 'bamboo_grade', 'grade_changed', 'older_than_14_days', 'quarantine_status'
    ];


    public function getProductName($id){
        return SellingProduct::where('id', $id)->first()->product_name;
    }

    public function getBrandName($productId){

        $sellingProduct = SellingProduct::where('id', $productId)->first();
        $brand = Brand::where('id', $sellingProduct->brand_id)->first();
        return $brand->brand_name;
    }

    public function getCategoryName($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        $category = Category::where('id', $sellingProduct->brand_id)->first();
        return $category->category_name;
    }

    public function getCategoryId($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        return $sellingProduct->category_id;
    }

    public function getBrandId($productId){
        $sellingProduct = SellingProduct::where('id', $productId)->first();
        return $sellingProduct->brand_id;
    }

    public function getProductPrice($id, $state){
        $product = SellingProduct::where('id', $id)->first();
        $price = "";
        if($state == "Excellent working"){
            $price = $product->customer_grade_price_1;
        }
        else if($state == "Good working"){
            $price = $product->customer_grade_price_2;
        }
        else if($state == "Poor working"){
            $price = $product->customer_grade_price_3;
        }
        else if($state == "Damaged working"){
            $price = $product->customer_grade_price_4;
        }
        else if($state == "Faulty"){
            $price = $product->customer_grade_price_5;
        }

        return $price;
    }

    public function getOrderType($id){

        $type = "";

        $tradeins = Tradein::where('barcode', $id)->get();
        foreach($tradeins as $tradein){
            if($this->getCategoryId($tradein->product_id) == 2){
                $type = "Type-3";
            }
        }

        if($type != "Type-3"){
            if(count($tradeins) <= 2){
                $type = "Type-1";
            }
            elseif(count($tradeins) > 2 && count($tradeins) <=5 ){
                $type = "Type-2";
            }
            else{
                $type = "Type-3";
            }
        }

        return $type;

    }

    public function getTrayName($id){
        #dd($id);
        $trayid = TrayContent::where('trade_in_id', $id)->first();
        $trayid = $trayid->tray_id;
        $trayname = Tray::where('id', $trayid)->first()->tray_name;

        return $trayname;
    }

    public function getTrayId($id){
        $trayid = TrayContent::where('trade_in_id', $id)->first()->id;

        return $trayid;
    }
}
