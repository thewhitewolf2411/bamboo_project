<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Eloquent\Category;
use App\Eloquent\User;
use App\Eloquent\Cart;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use Auth;
use Crypt;


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

        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

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
        $products = BuyingProduct::where('category_id', $category_id)->get();

        return view('customer.products')
                ->with('products', $products)
                ->with('category', $category);

    }

    public function showProduct($product_id){
        
        $product = BuyingProduct::where('id', $product_id)->get();
        $product = $product[0];

        return view('customer.product')->with('product', $product);
    }

    public function addProductToCart(Request $request){
        if(Auth::User()){
            $product = BuyingProduct::where('id',$request->productid)->first();

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
    
            $cart = new Cart($oldCart);
    
            $cart->add($product->product_buying_price, $product, "tradeout");
    
            $request->session()->put('cart', $cart);
    
            return redirect('/shop/item/'.$request->productid)->with('productaddedtocart', true);
        }
        else{
            return redirect('/');
        }
        
    }

    public function removeFromCart(Request $request){

        dd($request);

        return redirect('/cart');

    }

    public function showCart(){

        $cartItems = Session::has('cart') ? Session::get('cart') : null;

        $products = SellingProduct::all();

        return view('customer.cart')->with('cart', $cartItems)->with('products', $products);

    }

    public function addProductToWishList($id){
        $userid = Auth::user()->id;
        $productid = $id;
    }

    public function showProfile(){

        if(Auth::user()){
            //get current user data
            $userdata = Auth::user();
            #$userorders = Order::where('user_id', $userdata->id)->get();

            $tradeins = Tradein::where('user_id', $userdata->id)->get();
            $tradeouts = Tradeout::where('user_id', $userdata->id)->get();

            #dd($tradeins, $tradeouts);

            $userdata->password = Crypt::decrypt($userdata->password);

            return view('customer.profile')
                ->with(['userdata'=>$userdata, 'tradeins'=>$tradeins, 'tradeouts'=>$tradeouts]);
#                ->with('userorders', $userorders);

        }
        else{
            return redirect('/');
        }

    }

    public function showWishlist(){
        return view('customer.wishlist');
    }
}
