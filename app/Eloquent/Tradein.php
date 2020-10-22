<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;

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
        'user_id', 'barcode','barcode_original','product_id','network','color','memory','product_state', 'job_state', 'order_price', 'receoved', 'device_missing', 'device_correct', 'device_present_as_described', 'checkmend_passed', 'imei_number', 'change_device',
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

}
