<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EcommerenceController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showEcommerenceOrderManagement(Request $request){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeouts = null;
        $search = null;

        if($request->all() == null || $request->search == 0){
            $tradeouts = Tradeout::all();

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 1)->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.ecommerence.order-management')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser)->with('search',$search);
    }

    public function setTradeoutAsSent(Request $request){
        $tradeout = Tradeout::where('id', $request->mark_as_complete_trade_out_id)->first();
        $tradeout->order_state = 1;
        $tradeout->save();

        return \redirect()->back()->with('success', 'Order '. $request->mark_as_complete_trade_out_id . ' was successfully sent.');
    }

    public function showEcommerenceCustomerAccounts(){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $users = User::where('type_of_user', 0)->get();

        return view('portal.customer-care.seller')->with(['portalUser'=>$portalUser, 'users'=>$users]);
    }

    public function showEcommerenceOrderStatus(Request $request){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeouts = null;
        $search = null;

        if($request->all() == null || $request->search == 0){
            $tradeouts = Tradeout::all();

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 1)->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.ecommerence.order-status')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser)->with('search',$search);
    }

    public function showEcommerenceCreateOrder(){

    }
}
