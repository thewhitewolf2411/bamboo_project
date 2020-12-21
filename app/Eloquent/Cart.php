<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\SellingProduct;
use App\Eloquent\BuyingProduct;
use App\User;

class Cart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    protected $fillable = [
        'user_id', 'price', 'product_id','type', 'network',
        'memory','grade', 'email_sent'
    ];


    public function getProductName($id){

        $cart = Cart::where('id', $id)->first();

        $productName = "";

        if($cart->type === "tradein"){
            $productName = SellingProduct::where('id', $cart->product_id)->first();
        }
        else if($cart->type === "tradeout"){
            $productName = BuyingProduct::where('id', $cart->product_id)->first();
        }

        return $productName->product_name;

    }

    public function getProductImage($id){
        $cart = Cart::where('id', $id)->first();

        $product = "";

        if($cart->type === "tradein"){
            $product = SellingProduct::where('id', $cart->product_id)->first();
        }
        else if($cart->type === "tradeout"){
            $product = BuyingProduct::where('id', $cart->product_id)->first();
        }

        return $product->product_image;
    }

    public function getUserEmail($id){
        $user = User::where('id', $id)->first();
        return $user->email;
    }

    public function getUserName($id){
        $user = User::where('id', $id)->first();
        return $user->first_name;
    }

    public function lastName($id){
        $user = User::where('id', $id)->first();
        return $user->last_name;
    }
}
