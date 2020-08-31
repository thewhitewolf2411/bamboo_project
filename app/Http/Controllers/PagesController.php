<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
            $role = Auth::user()->type_of_user; 

            // Check user role
            switch ($role) {
                case 0:
                    $buyingProducts = BuyingProduct::all();
                    $sellingProducts = SellingProduct::all();
            
                    $products = $buyingProducts->merge($sellingProducts);
                    return view('welcome')->with('products', $products);
                    break;
                case 1:
                    return \redirect('/portal');
                    break; 
                case 2:
                    return \redirect('/portal');
                    break; 
                case 3:
                    return \redirect('/portal');
                    break; 
                }
        }

        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('welcome')->with('products', $products);
    }

    public function showProfile(){
        
    }

    public function admin(){
        if(Auth::User() || Auth::User()->type_of_user == 2 || Auth::User()->type_of_user == 3){

            $orders = Order::orderBy('id','desc')->take(10)->get();

            return view('admin')->with('last_orders', $orders);
        }
        else{
            return redirect('/');
        }
        
    }

    public function showEnvironmentPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.environment')->with('products', $products);
    }

    public function showCharityPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.charity')->with('products', $products);
    }

    public function showPrivacyPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.privacy')->with('products', $products);
    }

    public function showTermsPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.terms')->with('products', $products);
    }

    public function showMapPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.map')->with('products', $products);
    }

    public function showCookiesPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.cookies')->with('products', $products);
    }

    public function showSlaveryPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.slavery')->with('products', $products);
    }

    public function showCorporatePage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.corporate')->with('products', $products);
    }

}
