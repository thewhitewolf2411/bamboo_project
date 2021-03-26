<?php

namespace App\Helpers;

use App\Eloquent\Cart;
use Illuminate\Support\Facades\Auth;

class CartHelper{

    public static function cartItems(){
        if(Auth::user()){
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            if($cart){
                return $cart->count();
            } else {
                return null;
            }
        }
        return null;
    }

}