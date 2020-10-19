<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SellingProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'selling_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','product_image','category_id','customer_grade_price_1','customer_grade_price_2', 'customer_grade_price_3','customer_grade_price_4','customer_grade_price_5'
    ];

    public function getBrand($brand_id){
        $brandName = Brand::where('id', $brand_id)->first();
        #dd($brandName[0]->brand_name);
        if($brandName == null){
            return "Unknown";
        }
        $brandName = $brandName->brand_name;
        return $brandName;
    }

    public function getCategory($category_id){
        $categoryName = Category::where('id', $category_id)->get('category_name');
        return $categoryName[0]->category_name;
    }
}
