<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;

class SellController extends Controller
{
    public function showSellView(){

        $products = BuyingProduct::all();
        return view('sell.welcome')->with('products', $products);;
    }

    public function showSellWhy(){
        $products = BuyingProduct::all();
        return view('sell.why')->with('products', $products);
    }


    public function showSellShop($parameter){
        
        $products = SellingProduct::all();
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
    
    public function searchAvalibleProducts(Request $request){
        dd($request);
    }
}
