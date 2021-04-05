<?php

namespace App\Helpers;

use App\Eloquent\AbandonedCart;
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
        } else {
            if(request()->session()->has('session_email')){
                $email = request()->session()->get('session_email', null);
                if($email){
                    $abandoned_cart = AbandonedCart::where('user_email', $email)->get();
                    if($abandoned_cart){
                        return $abandoned_cart->count();
                    } else {
                        return null;
                    }
                }
            }
        }
        return null;
    }

}