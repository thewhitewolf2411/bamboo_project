<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\Product;

class ShopController extends Controller
{
    public function showShopView(){
        $products = Product::all();
        return view ('shop.welcome')->with('products', $products);;
    }
}
