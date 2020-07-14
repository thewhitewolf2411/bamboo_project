<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PortalUsers;
use App\Order;
use App\Product;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
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

    public function portal(){
        if(Auth::User()->type_of_user == 1 || Auth::User()->type_of_user == 3){

            $portal_user = PortalUsers::where('user_id', Auth::User()->id)->first();

            return view('portal')->with('user_data', $portal_user);
        }
        else{
            return redirect('/');
        }
    }
}
