<?php

namespace App\Helpers;

use App\Eloquent\AbandonedCart;
use App\Eloquent\Cart;
use App\Eloquent\PromotionalCode;
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
            if(request()->session()->has('abandoned_email')){
                $email = request()->session()->get('abandoned_email', null);
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

    public static function promocodesExist(){
        $promocodes = PromotionalCode::all();
        if($promocodes->count() > 0){
            return true;
        }
        return false;
    }

}