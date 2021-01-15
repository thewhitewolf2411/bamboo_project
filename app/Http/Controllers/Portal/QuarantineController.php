<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use Auth;

class QuarantineController extends Controller
{
    public function showQuarantinePage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.quarantine')->with('portalUser', $portalUser);
    }

    public function showQuarantineOverviewPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::where('marked_for_quarantine', true)->get();
        
        return view('portal.quarantine.quarantine-overview')->with(['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }

    public function showQuarantineBinsPage(){
        
        dd("Quarantine Bins");

    }

}
