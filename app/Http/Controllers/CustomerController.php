<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Category;
use App\Product;
use App\User;
use App\Cart;
use App\Order;
use Auth;

class CustomerController extends Controller
{
    public function setPage($parameter){
        $page = "home";
        $categories = null;

        switch($parameter){
            case "home":
                $page="home";
            break;
            case "about":
                $page="about";
            break;
            case "how":
                $page="how";
            break;
            case "sell":
                $categories = $this->getAllCategories();
                $page="sell";
            break;
            case "faqs":
                $page="faqs";
            break;
            case "support":
                $page="support";
            break;
            case "contact":
                $page="contact";
            break;
            case "account":
                if(Auth::user()){

                }
                else{
                    return redirect('/login');
                }
            break;
            case "wishlist":
                if(Auth::user()){

                }
                else{
                    return redirect('/login');
                }
            break;
            default:
                $page="home";
            break;
        }

        if($categories == null){
            return redirect('/')->with('page', $page);
        }
        else{
            return redirect('/')
                    ->with('page', $page)
                    ->with('categories', $categories);
        }
        
    }

    public function getAllCategories(){
        return Category::all();
    }

    public function customerCategoryView($category){
        $category_id = Category::where('category_name', $category)->pluck('id');
        $products = "";

        $category_id = $category_id[0];
        $products = Product::where('category_id', $category_id)->get();

        return view('customer.products')
                ->with('products', $products)
                ->with('category', $category);

    }

    public function showProduct($product_id){
        
        $product = Product::where('id', $product_id)->get();
        $product = $product[0];

        return view('customer.product')->with('product', $product);
    }

    public function addProductToCart(Request $request){

        if(Auth::User()){
            $product = Product::find($request->id);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
    
            $cart = new Cart($oldCart);
    
            $date = date("Y/m/d") . " " . date("h:i:sa");
    
            $order = new Order;
    
            $order->order_placed = $date;
            $order->product_id = $request->id;
            $order->user_id = Auth::user()->id;
            $order->user_email = Auth::user()->email;
            $order->product_total = $request->quantity * $request->price;
            $order->order_total = $request->quantity * $request->price;
            $order->order_status = 0;
            $order->payment_status = 0;
            $order->shipping_status = 0;
            $order->quantity = $request->quantity;
            $order->status = $request->state;
    
            $cart->add($order);
    
            $request->session()->put('cart', $cart);
    
            return redirect('/cart');
        }
        else{
            return redirect('/register');
        }
        

    }

    public function removeFromCart(Request $request){

        $deleteid = $request->deleteid;
        $sessiondata = Session::get('cart')->items;
        Session::forget('cart');


        foreach($sessiondata as $key=>$item){
            if($key != $deleteid){
                $order = new Order;
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);

                $order->order_placed = $item->order_placed;
                $order->product_id = $item->product_id;
                $order->user_id = $item->user_id;
                $order->user_email = $item->user_email;
                $order->product_total = $item->product_total;
                $order->order_total = $item->order_total;
                $order->order_status = $item->order_status;
                $order->payment_status = $item->payment_status;
                $order->shipping_status = $item->shipping_status;
                $order->quantity = $item->quantity;
                $order->status = $item->status;

                $cart->add($order);
                $request->session()->put('cart', $cart);
            }
        }

        return redirect('/cart');

    }

    public function showCart(){

        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $products = [];
        $cartItems= [];

        foreach($cart as $item){

            foreach($item as $cartItem){

                array_push($cartItems, $cartItem);
            }
        }

        foreach($cartItems as $cartItem){
            array_push($products, Product::where('id', $cartItem->product_id)->get());
        }

        return view('customer.cart')->with('cart', $cartItems)->with('products', $products);

    }

    public function sheckoutcart(){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        if(($oldCart)){
            foreach($oldCart as $cartItem){
                foreach($cartItem as $item){
                    $item->save();
                }
            }
        }

        Session::forget('cart');

        return redirect('/');

    }
}
