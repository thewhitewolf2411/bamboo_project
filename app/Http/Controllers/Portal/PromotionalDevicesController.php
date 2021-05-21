<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\SellingProduct;

class PromotionalDevicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAuth');
    }

    public function index(){
        
        return view('portal.promodevices.index', ['portalUser' => PortalUsers::find(Auth::user()->id)]);

    }

    public function mainSite(){

        $devices = SellingProduct::all();

        return view('portal.promodevices.mainindex', ['portalUser' => PortalUsers::find(Auth::user()->id), 'devices'=>$devices]);
    }

    public function mapSite(){

        $devices = SellingProduct::all();

        return view('portal.promodevices.mapindex', ['portalUser' => PortalUsers::find(Auth::user()->id), 'devices'=>$devices]);
    }
}
