<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;
use App\Eloquent\Cart;
use App\Eloquent\Tradein;
use Session;

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
        #dd($products);

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
        
        $product = SellingProduct::where('id', $id)->first();
        return view('sell.item')->with('product', $product);

    }
    
    public function searchAvalibleProducts(Request $request){
        dd($request);
    }

    public function addSellItemToCart(Request $request){

        $grade = SellingProduct::where('id', $request->phoneid)->first();

        if($grade->product_selling_price_1 == $request->grade){
            $grade = $grade->product_grade_1;
        }
        else if($grade->product_selling_price_2 == $request->grade){
            $grade = $grade->product_grade_2;
        }
        else if($grade->product_selling_price_3 == $request->grade){
            $grade = $grade->product_grade_3;
        }

        $product = SellingProduct::where('id',$request->phoneid)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        
        $cart->add($product->id, $grade);

        $request->session()->put('cart', $cart);
        $request->session()->put('type', $request->type);

        #dd($cart);

        return redirect('/sell/shop/mobile');

    }

    public function sellItems(Request $request){

        if(Auth::user()){
            $data = $request->all();
        
            $data = array_values($data);
            $data = array_slice($data, 1, -1);
    
            $items = array();
            $barcode = $request->order_code;
    
            for($i = 0; $i<count($data); $i+=2){
                $item = array();
                array_push($item, $data[$i], $data[$i+1]);
                array_push($items, $item);
            }
    
            foreach($items as $item){     
    
                $tradein = new Tradein();
                $tradein->barcode = $barcode;
                $tradein->user_id = Auth::user()->id;
                $tradein->product_id = $item[0];
                $tradein->product_state = $item[1];
                $tradein->save();
    
            }
    
            Session::forget('cart');
            Session::forget('type');
    
            return redirect('/');
        }
        else{
            $showLogin = true;
            return redirect('/cart')->with('showLogin', $showLogin);
        }

        #dd($request->all());


        
    }
}
