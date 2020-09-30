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
use App\Eloquent\Tradeout;
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


    public function showSellShop(Request $request, $parameter){
        
        #dd($request->all(), $parameter);

        $number = null;
        $page = 1;
        $start = null;

        if(isset($request->number)){
            $number = $request->number;
        }
        else{
            $number = 24;
        }
        if(isset($request->page)){
            $page = $request->page;
        }
        else{
            $page = 1;
        }

        if($page == 1){
            $start = 1;
        }
        else{
            $start = $page * $number;
        }


        $products = "";
        #dd($products);

        switch($parameter){
            case "mobile":
                $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->take($number)->get();
                $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
            break;
            case "tablets":
                $products = SellingProduct::where('category_id', 2)->where('id', '>=', $start)->take($number)->get();
                $numberofproducts = count(SellingProduct::where('category_id', 2)->get());
            break;
            case "watches":
                $products = SellingProduct::where('category_id', 3)->where('id', '>=', $start)->take($number)->get();
                $numberofproducts = count(SellingProduct::where('category_id', 3)->get());
            break;
            default:
            break;
        }

        $numberofpages = $numberofproducts/$number;
        $numberofpages = ceil($numberofpages);
        $pages = array();

        for($i = 1; $i<=$numberofpages; $i++){
            array_push($pages, $i);
        }

        return view('sell.shop')->with(['products' => $products, 'pages'=>$pages, 'currentpage'=>$page, 'category'=>$parameter]);
    }

    public function showSellItem($id){
        
        $product = SellingProduct::where('id', $id)->first();

        $products = SellingProduct::all();
        return view('sell.item')->with(['product'=>$product, 'products'=>$products]);

    }
    
    public function searchAvalibleProducts(Request $request){
        dd($request);
    }

    public function addSellItemToCart(Request $request){

        #dd($request->all());

        $grade = SellingProduct::where('id', $request->productid)->first();

        #dd($grade);

        if($grade->customer_grade_price_1 == $request->grade){
            $grade = $grade->customer_grade_price_1;
        }
        else if($grade->customer_grade_price_2 == $request->grade){
            $grade = $grade->customer_grade_price_2;
        }
        else if($grade->customer_grade_price_3 == $request->grade){
            $grade = $grade->customer_grade_price_3;
        }
        else if($grade->customer_grade_price_4 == $request->grade){
            $grade = $grade->customer_grade_price_4;
        }
        else if($grade->customer_grade_price_5 == $request->grade){
            $grade = $grade->customer_grade_price_5;
        }

        $product = SellingProduct::where('id',$request->productid)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        
        $cart->add($grade, $product, $request->type);

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('productaddedtocart', true);

    }

    public function sellItems(Request $request){

        #dd($request);

        if(Auth::user()){
            $data = $request->all();
            #dd($data);
            $data = array_values($data);
            $data = array_slice($data, 1);
            #dd($data);
            $items = array();

            //8
            $tradeinbarcode = 10000000 + rand(100000, 9000000);

            #dd($tradeinbarcode);

            foreach($data as $dataitem){
                $item = array();
                array_push($item, $dataitem);
                array_push($items, $item);
            }
            #dd($data);
            #dd($data[0],$data[1], $data[2]);
           
            $items = array_chunk($data, 3);

            foreach($items as $item){     
                if($item[0] == 'tradein'){
                    $tradein = new Tradein();
                    $tradein->barcode = $tradeinbarcode;
                    $tradein->user_id = Auth::user()->id;
                    $tradein->product_id = json_decode($item[1])->id;
                    $tradein->order_price = $item[2];


                    if(json_decode($item[1])->customer_grade_price_1 == $item[2]){
                        $tradein->product_state = "Excellent working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_2 == $item[2]){
                        $tradein->product_state = "Good working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_3 == $item[2]){
                        $tradein->product_state = "Poor working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_4 == $item[2]){
                        $tradein->product_state = "Damaged working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_5 == $item[2]){
                        $tradein->product_state = "Faulty";
                    }

                    $tradein->save();
                }
                else if($item[0] == 'tradeout'){
                    $tradeout = new Tradeout();
                    $tradeout->user_id = Auth::user()->id;
                    $tradeout->product_id = json_decode($item[1])->id;
                    $tradeout->order_state = 0;
                    $tradeout->save();
                }

                

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
