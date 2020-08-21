<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\Product;
use App\Eloquent\AvalibleProducts;

class SellController extends Controller
{
    public function showSellView(){

        $products = Product::all();
        return view('sell.welcome')->with('products', $products);;
    }

    public function showSellWhy(){
        $products = Product::all();
        return view('sell.why')->with('products', $products);
    }


    public function showSellShop($parameter){
        
        $products = AvalibleProducts::all();
        dd($products);

        switch($parameter){
            case "mobile":
            break;
            case "tablets":
            break;
            case "watches":
            break;
            default:
            break;
        }

        return view('sell.shop')->with('products', $products);
    }

    public function showSellItem($id){
        dd($id);
    }   
}
