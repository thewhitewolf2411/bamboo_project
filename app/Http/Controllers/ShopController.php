<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function showShopView(){
        return view ('shop.welcome');
    }
}
