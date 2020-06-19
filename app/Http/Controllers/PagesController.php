<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function admin(){
        if(Auth::User()->type_of_user == 2 || Auth::User()->type_of_user == 3){
            return view('admin');
        }
        else{
            return redirect('/');
        }
        
    }

    public function portal(){
        if(Auth::User()->type_of_user == 1 || Auth::User()->type_of_user == 3){
            return view('portal');
        }
        else{
            return redirect('/');
        }
    }
}
