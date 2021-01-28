<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function showPaymentPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.payments')->with('portalUser', $portalUser);
    }


    /**
     * Show awaiting payments.
     */
    public function showAwaitingPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        
        $trolleys = null;
        $trays = null;
        
        // search by id / barcode
        if(isset(request()->search)){

            // get tradein by barcode / tradein id
            $tradeins_ids_collection = Tradein::where('barcode', request()->search)->where('job_state','=','10')->orWhere('job_state', '=', '16')->get();
            $tradein_ids = $tradeins_ids_collection->pluck('id')->toArray();

            $tradeins = Tradein::where('barcode', request()->search)->orWhere('barcode_original', request()->search)
                ->where(function($query){
                    $query->where('job_state','=','10')->orWhere('job_state', '=', '16');
                })->get();

            
            // get tray content containing tradein
            $trays_content = TrayContent::whereIn('trade_in_id', $tradein_ids)->get();
            $tray_ids = $trays_content->pluck('tray_id')->toArray();

            // get trays by tray id
            $trays = Tray::whereIn('id', $tray_ids)
            ->where(function($query){
                $query->where('tray_name', 'like', 'TA%')
                ->orWhere('tray_name', 'like', 'TS%')
                ->orWhere('tray_name', 'like', 'TH%')
                ->orWhere('tray_name', 'like', 'TM%');
            })->get();

            // get trolleys that hold trays
            $trolley_ids = $trays->pluck('trolley_id')->toArray();

            $trolleys = Trolley::whereIn('id', $trolley_ids)
            ->where(function($query){
                $query->where('trolley_name', 'like', 'TA%')
                ->orWhere('trolley_name', 'like', 'TS%')
                ->orWhere('trolley_name', 'like', 'TH%')
                ->orWhere('trolley_name', 'like', 'TM%');
            })->get();

        } else {

            // get trolleys
            $trolleys = Trolley::where('trolley_name', 'like', 'TA%')
                ->orWhere('trolley_name', 'like', 'TS%')
                ->orWhere('trolley_name', 'like', 'TH%')
                ->orWhere('trolley_name', 'like', 'TM%')
            ->get();

            // get trays
            $trays = Tray::where('number_of_devices', '>', "0")->where(function($query){
                    $query->where('tray_name', 'like', 'TA%')
                    ->orWhere('tray_name', 'like', 'TS%')
                    ->orWhere('tray_name', 'like', 'TH%')
                    ->orWhere('tray_name', 'like', 'TM%');
            })->get();

            // get devices
            $tradeins = Tradein::where('job_state','=','10')->orWhere('job_state', '=', '16')->get();
        }

        return view('portal.payments.awaiting', [
            'portalUser' => $portalUser,
            'trolleys' => $trolleys,
            'trays' => $trays,
            'tradeins' => $tradeins
        ]);
    }

    /**
     * Search for tradeins by barcode (for batch).
     * 
     * @param string $barcode
     */
    public function searchForTradeins(string $barcode){
        if($barcode){
            $tradeins = Tradein::where('barcode', $barcode)->orWhere('barcode_original', $barcode)
                ->where(function($query){
                    $query->where('job_state','=','10')->orWhere('job_state', '=', '16');
                })->get();
                
            foreach($tradeins as $tradein){
                $tradein->model = $tradein->getProductName($tradein->id);
            }
            return $tradeins;
        }
    }

    /**
     * Show submit for payments page.
     */
    public function showSubmitPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.submit')->with('portalUser', $portalUser);
    }


    /**
     * Show payments confirmation page.
     */
    public function showConfirmPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.confirm')->with('portalUser', $portalUser);
    }


    /**
     * Show failed payments page.
     */
    public function showFailedPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.failed')->with('portalUser', $portalUser);
    }
}
