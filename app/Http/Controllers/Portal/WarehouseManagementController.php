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

use App\Services\Boxing;

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
            $boxnumber = '0000000' . $boxnumber;
        }elseif($boxnumber>=10 && $boxnumber<100){
            $boxnumber = '000000' . $boxnumber;
        }elseif($boxnumber>=100 && $boxnumber<1000){
            $boxnumber = '00000' . $boxnumber;
        }elseif($boxnumber>=1000 && $boxnumber<10000){
            $boxnumber = '0000' . $boxnumber;
        }elseif($boxnumber>=10000 && $boxnumber<100000){
            $boxnumber = '000' . $boxnumber;
        }elseif($boxnumber>=100000 && $boxnumber<1000000){
            $boxnumber = '00' . $boxnumber;
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
            'box_devices'=>$request->boxdevices,

        ]);

        return redirect()->back()->with('success', 'Box ' . $trayname . ' was successfully created' );

    }

    public function getBoxDevices(Request $request){

        $tray = Tray::where('tray_name', $request->boxname)->first();

        $boxContent = TrayContent::where('tray_id', $tray->id)->get();

        $tradeins = array();

        foreach($boxContent as $bC){
            $tradein = Tradein::where('id', $bC->trade_in_id)->first();
            $tradein->model = $tradein->getProductName($tradein->product_id);
            $tradein->product_id = $tradein->getBrandName($tradein->product_id);
            array_push($tradeins, $tradein);
        }

        return $tradeins;
    }

    public function addDeviceToBox(Request $request){

        $tradein = Tradein::where('barcode', $request->tradeinid)->first();

        $box = Tray::where('tray_name', $request->boxid)->first();

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
    
        $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
        $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
        $oldTray->save();

        $oldTrayContent->delete();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $box->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        return redirect()->back()->with('success', 'You have added device ' . $request->tradeinid . ' to this box.');
    }

    public function openBox(Request $request){

        $boxname = $request->boxname;
        $tray = Tray::where('tray_name', $boxname)->first();
        $tray->status = 1;
        $tray->save();

        return 200;
    }

    public function suspendBox(Request $request){
        
        $boxname = $request->boxname;
        $tray = Tray::where('tray_name', $boxname)->first();
        $tray->status = 2;
        $tray->save();

        return 200;
    }

    public function completeBox(Request $request){
        
        $boxname = $request->boxname;
        $tray = Tray::where('tray_name', $boxname)->first();
        $tray->status = 3;
        $tray->save();

        return 200;
    }

    public function checkBoxStatusForDevice(Request $request){
        #dd($request->all());

        $tradein = Tradein::where('barcode', $request->tradeinid)->first();
        $box = Tray::where('tray_name', $request->boxname)->first();

        if($tradein === null){
            return response('Tradein with barcode ' . $request->tradeinid .' found.', 404);
        }

        $boxing = New Boxing();

        if($boxing->checkBoxStatusForDevice($tradein, $box, $request)[1] === 404){
            return response($boxing->checkBoxStatusForDevice($tradein, $box, $request)[0], 404); 
        }
        else{
            return response($boxing->checkBoxStatusForDevice($tradein, $box, $request)[0], 200); 
        }

        return response('Something went wrong. Please try again.', 404); 


    }

    public function printBoxLabel(Request $request){
        dd($request);
    }

}
