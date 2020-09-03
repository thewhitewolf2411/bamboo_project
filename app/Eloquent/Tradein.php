<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;

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
        'barcode','product_id','product_state',
    ];


    public function getProductName($id){
        return SellingProduct::where('id', $id)->first()->product_name;
    }

    public function getProductPrice($id, $state){
        $product = SellingProduct::where('id', $id)->first();
        $price = "";
        if($state == "New"){
            $price = $product->product_selling_price_1;
        }
        else if($state == "Good"){
            $price = $product->product_selling_price_2;
        }
        else if($state == "Faulty"){
            $price = $product->product_selling_price_3;
        }

        return $price;
    }

}
