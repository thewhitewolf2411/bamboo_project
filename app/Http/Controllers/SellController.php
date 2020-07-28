<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\Product;

class SellController extends Controller
{
    public function showSellView(){

        $products = Product::all();
        return view('sell.welcome')->with('products', $products);;
    }

    public function showSellWhy(){
        $products = Product::all();
        return view('sell.why')->with('products', $products);;
    }
}
