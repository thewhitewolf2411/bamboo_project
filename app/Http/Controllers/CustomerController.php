<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Eloquent\Category;
use App\Eloquent\Product;
use App\Eloquent\User;
use App\Eloquent\Cart;
use App\Eloquent\Order;
use Auth;

class CustomerController extends Controller
{
    public function setPage($parameter){
        $page = "home";
        $categories = null;
        $showLogin = false;

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
            case "news":
                $page="news";
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
                    return redirect('/userprofile');
                }
                else{
                    $showLogin = true;
                }
            break;
            case "wishlist":
                if(Auth::user()){
                    return redirect('/userprofile/wishlist');
                }
                else{
                    $showLogin = true;
                }
            break;
            default:
                $page="home";
            break;
        }

        $products = Product::all();

        if($categories == null){
            return redirect('/')->with('page', $page)->with('products', $products)->with('showLogin', $showLogin);
        }
        else{
            return redirect('/')
                    ->with('page', $page)
                    ->with('categories', $categories)
                    ->with('products', $products)
                    ->with('showLogin', $showLogin);
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
            $product = Product::find($request->productid);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
    
            $cart = new Cart($oldCart);
    
            $cart->add($product);
    
            $request->session()->put('cart', $cart);
    
            return redirect('/shop/item/'.$request->productid)->with('productaddedtocart', true);
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

        dd($oldCart);

        #return view('customer.cart')->with('cart', $cartItems)->with('products', $products);

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

    public function addProductToWishList($id){
        $userid = Auth::user()->id;
        $productid = $id;
    }

    public function showProfile(){

        if(Auth::user()){
            //get current user data
            $userdata = Auth::user();
            $userorders = Order::where('user_id', $userdata->id)->get();

            return view('customer.profile')
                ->with('userdata', $userdata)
                ->with('userorders', $userorders);
        }
        else{
            return redirect('/');
        }

    }

    public function showWishlist(){
        return view('customer.wishlist');
    }
}
