<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use Illuminate\Support\Facades\Auth;

class SalesLotController extends Controller
{
    public function showSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.sales-lot.sales-lot', ['portalUser'=>$portalUser]);
    }

    public function showBuildingSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $tradeins = Tradein::get();

        foreach($tradeins as $key=>$tradein){
            if(!$tradein->isBoxed()){
                $tradeins->forget($key);
            }
        }

        $boxes = Tray::where('tray_type', 'Bo')->where('status', 3)->get();


        return view('portal.sales-lot.building-sales-lot', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins, 'boxes'=>$boxes]);
    }

    public function showCompletedSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.sales-lot.completed-sales-lot', ['portalUser'=>$portalUser]);
    }
}
