<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\BuyingProductInformation;

class BuyingProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buying_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','product_image','category_id','brand_id','product_description',
        'product_weight','product_screen','product_system','product_connectivity','product_battery','product_signal','product_camera','product_camera_2','product_sim',
        'product_memory_slots','product_quantity'
    ];

    public function getBrand($brand_id){
        $brandName = Brand::where('id', $brand_id)->get('brand_name');
        return $brandName[0]->brand_name;
    }

    public function getCategory($category_id){
        $categoryName = Category::where('id', $category_id)->get('category_name');
        return $categoryName[0]->category_name;
    }

    public function getProductMinPrice($id){
        return BuyingProductInformation::where('product_id', $id)->first()->poor_working;
    }

    public function getProductMaxPrice($id){
        return BuyingProductInformation::where('product_id', $id)->first()->excellent_working;
    }
    
}
