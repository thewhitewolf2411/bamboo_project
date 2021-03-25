<?php

namespace App\Helpers;

use App\Eloquent\Cart;
use Illuminate\Support\Facades\Auth;

class CartHelper{

    public static function cartItems(){
        return 0;
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        if($cart){
            return $cart->count();
        } else {
            return null;
        }
        
    }

}