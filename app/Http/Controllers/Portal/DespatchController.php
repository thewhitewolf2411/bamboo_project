<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DespatchController extends Controller
{
    public $portalUser;

    public function __construct(){
        $this->middleware('checkAuth');
    }

    public function index(){
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
        return view('portal.despatch.index', ['portalUser' =>$portalUser]);
    }

    /**
     * Show devices for despatch.
     */
    public function showDespatchDevices(){
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
        $tradeins = Tradein::where('job_state', '20')->orWhere('job_state', '19')->get();
        return view('portal.despatch.despatch', ['portalUser' => $portalUser, 'tradeins' => $tradeins]);
    }

    /**
     * Show devices that were dispatched
     */
    public function showArchive(){
        return view('portal.despatch.archive');
    }
}
