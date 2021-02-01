<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Eloquent\PortalUsers;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\Box;
use App\Eloquent\BoxContent;
use App\Eloquent\Brand;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Tradein;

class WarehouseManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showWarehouseManagementPage(){

        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.warehouse-management', ['portalUser'=>$portalUser]);
    }

    public function showBoxManagementPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $boxes = Tray::where('tray_type', 'Bo')->get();
        $brands = Brand::all();

        return view('portal.warehouse.box-management', ['portalUser'=>$portalUser, 'boxes'=>$boxes, 'brands'=>$brands]);
    }

    public function showBayOverviewPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.bay-overview', ['portalUser'=>$portalUser]);
    }

    public function showPickingDespatchPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.picking-despatch', ['portalUser'=>$portalUser]);
    }


    public function createBox(Request $request){

        #dd($request->all());

        $brand = Brand::where('id', $request->manifacturer)->first();
        $manifacturer = $brand->getBrandFirstName();

        $boxnumber = count(Tray::where('tray_type', 'Bo')->get());

        if($boxnumber<10){
            $boxnumber = '2000000' . $boxnumber;
        }elseif($boxnumber>=10 && $boxnumber<100){
            $boxnumber = '200000' . $boxnumber;
        }elseif($boxnumber>=100 && $boxnumber<1000){
            $boxnumber = '20000' . $boxnumber;
        }elseif($boxnumber>=1000 && $boxnumber<10000){
            $boxnumber = '2000' . $boxnumber;
        }elseif($boxnumber>=10000 && $boxnumber<100000){
            $boxnumber = '200' . $boxnumber;
        }elseif($boxnumber>=100000 && $boxnumber<1000000){
            $boxnumber = '20' . $boxnumber;
        }

        $locked = 'Unlocked';
        if($request->network === 'l'){
            $locked = 'Locked';
        }

        $trayname = strtoupper($manifacturer . $request->reference . $request->network . $boxnumber);

        $newBox = Tray::create([

            'tray_name'=>$trayname,
            'tray_type'=>'Bo',
            'tray_brand'=>strtoupper($manifacturer),
            'tray_grade'=>strtoupper($request->reference),
            'tray_network'=>$locked,
            'max_number_of_devices'=>$request->capacity,

        ]);

        return redirect()->back()->with('success', 'Box ' . $trayname . ' was successfully created' );

    }

    public function getBoxDevices(Request $request){

        $boxContent = TrayContent::where('tray_id', $request->boxid)->get();

        $tradeins = array();

        foreach($boxContent as $bC){
            $tradein = Tradein::where('id', $bC->trade_in_id)->first();

            array_push($tradeins, $tradein);
        }

        return $tradeins;
    }

}
