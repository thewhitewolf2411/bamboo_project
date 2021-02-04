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
use App\Eloquent\Trolley;
use App\Eloquent\TrayContent;
use App\Eloquent\Tradein;

use App\Services\Boxing;
use PDF;
use DNS1D;
use DNS2D;

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

    //Box management functions


    public function showBoxManagementPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $boxes = Tray::where('tray_type', 'Bo')->where('trolley_id', null)->get();
        $brands = Brand::all();

        return view('portal.warehouse.box-management', ['portalUser'=>$portalUser, 'boxes'=>$boxes, 'brands'=>$brands]);
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
        $box->number_of_devices = $box->number_of_devices + 1;

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
    
        $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
        $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
        $oldTray->save();

        $oldTrayContent->delete();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $box->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();
        $box->save();

        return redirect()->back()->with(['success', 'You have added device ' . $request->tradeinid . ' to this box.', 'addedtobox'=>$request->boxid]);
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

        if($request->tradeinid === null){
            return response('Device barcode cannot be empty.', 404);
        }

        if($tradein === null){
            return response('Tradein with barcode ' . $request->tradeinid .' not found.', 404);
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
        #dd($request->all());
        $id = $request->boxname;

        $brandLet = substr($id, 1, 1);
        $brand = "";

        $barcode = DNS1D::getBarcodeHTML($id, 'C128');

        if($brandLet === "A"){
            $brand = "Apple";
        }
        if($brandLet === "S"){
            $brand = "Samsung";
        }
        if($brandLet === "H"){
            $brand = "Huaweii";
        }
        if($brandLet === "M"){
            $brand = "Miscellaneous";
        }
        if($brandLet === "Q"){
            $brand = "Quarantine";
        }

        $filename = public_path() . "/pdf/boxlabels/box-" . $id . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.boxlabel', array('barcode'=>$barcode, 'id'=>$id, 'brand'=>$brand))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);
    
        return response("/pdf/boxlabels/box-" . $id . ".pdf", 200);
    
    }

    public function printBoxSummary(Request $request){
        $boxname = $request->boxname;

        $box = Tray::where('tray_name', $boxname)->first();
        $boxContent = TrayContent::where('tray_id', $box->id)->get();
        $tradeins = array();

        $brandLet = substr($boxname, 1, 1);
        $brand = "";

        if($brandLet === "A"){
            $brand = "Apple";
        }
        if($brandLet === "S"){
            $brand = "Samsung";
        }
        if($brandLet === "H"){
            $brand = "Huaweii";
        }
        if($brandLet === "M"){
            $brand = "Miscellaneous";
        }
        if($brandLet === "Q"){
            $brand = "Quarantine";
        }

        foreach($boxContent as $bC){

            $tradein = Tradein::where('id', $bC->trade_in_id)->first();

            $hasDevice = false;
            $pl = null;

            foreach($tradeins as $key=>$ati){

                if($ati[1] === $tradein->getProductName($tradein->product_id)){
                    $hasDevice = true;
                    $pl = $key;
                }
                else{
                    $hasDevice = false;
                }
            }

            if($hasDevice){
                $tradeins[$pl][2]++;
            }
            else{
                array_push($tradeins, [$brand, $tradein->getProductName($tradein->product_id), 1]);
            }
        }


        $filename = public_path() . "/pdf/boxsummary/boxsummary-" . $boxname . ".pdf";
        PDF::loadView('portal.labels.boxsummary', array('boxname'=>$boxname, 'brand'=>$brand, 'tradeins'=>$tradeins, 'box'=>$box))->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);
    
        return response("/pdf/boxsummary/boxsummary-" . $boxname . ".pdf", 200);
    }

    public function printBoxManifest(Request $request){
        $boxname = $request->boxname;

        $box = Tray::where('tray_name', $boxname)->first();
        $boxContent = TrayContent::where('tray_id', $box->id)->get();
        $tradeins = array();

        foreach($boxContent as $bC){
            $tradein = Tradein::where('id', $bC->trade_in_id)->first();
            array_push($tradeins, $tradein);
        }

        $brandLet = substr($boxname, 1, 1);
        $brand = "";

        if($brandLet === "A"){
            $brand = "Apple";
        }
        if($brandLet === "S"){
            $brand = "Samsung";
        }
        if($brandLet === "H"){
            $brand = "Huaweii";
        }
        if($brandLet === "M"){
            $brand = "Miscellaneous";
        }
        if($brandLet === "Q"){
            $brand = "Quarantine";
        }

        $filename = public_path() . "/pdf/boxmanifest/boxmanifest-" . $boxname . ".pdf";
        PDF::loadView('portal.labels.boxmanifest', array('boxname'=>$boxname, 'brand'=>$brand, 'tradeins'=>$tradeins))->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);
    
        return response("/pdf/boxmanifest/boxmanifest-" . $boxname . ".pdf", 200);
    }


    //Bay functions

    public function showBayOverviewPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $bays = Trolley::where('trolley_type', 'Bay')->get();

        return view('portal.warehouse.bay-overview', ['portalUser'=>$portalUser, 'bays'=>$bays]);
    }

    public function showBayPage(Request $request){

        $bay = Trolley::where('trolley_name', $request->bay_id_scan)->first();
        $bayBoxes = Tray::where('trolley_id', $bay->id)->get();
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.bayview', ['portalUser'=>$portalUser, 'bay'=>$bay, 'bayboxes'=>$bayBoxes]);
        
    }

    public function showCreateBayPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.createbay', ['portalUser'=>$portalUser]);
    }

    public function createBay(Request $request){
        #dd($request);
        $bay = Trolley::create([
            'trolley_name'=>$request->bay_name,
            'trolley_type'=>'Bay',
            'trolley_brand'=>'B',
            'number_of_trays'=>0
        ]);

        return redirect('/portal/warehouse-management/bay-overview')->with(['success'=>'You have succesfully created new Bay']);
    }

    public function deleteBay(Request $request){
        $bay = Trolley::where('trolley_name', $request->bayname);
        $bay->delete();

        return response('', 200);
    }

    public function printBay(Request $request){

        $bay = Trolley::where('trolley_name', $request->bayname)->first();

        $filename = public_path() . "/pdf/baylabels/bay-" . $bay->trolley_name . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.baylabel', array('bay'=>$bay))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);
    
        return response("/pdf/baylabels/bay-" . $bay->trolley_name . ".pdf", 200);
    }

    public function checkAllocateBox(Request $request){

        $box = Tray::where('tray_name', $request->boxname)->first();
        $bay = Trolley::where('trolley_name', $request->bayname)->first();

        if($box === null){
            return response('There is no box with this id.', 404);
        }

        if($box->tray_type !== 'Bo'){
            return response('This is a tray, and cannot be added.', 404);
        }

        if($box->status !== 3){
            return response('This box is not marked as complete.', 404);
        }

        if($box->trolley_id !== null){
            if($box->trolley_id === $bay->id){
                return response('This box is already in this bay.', 404);
            }
        }

        return response([$box->tray_name, $box->number_of_devices], 200);
    }

    public function allocateBox(Request $request){

        $boxesids = $request->all();
        array_shift($boxesids);

        $boxesids = array_values($boxesids);

        $bayid = array_pop($boxesids);

        $bay = Trolley::where('trolley_name', $bayid)->first();

        foreach($boxesids as $boxid){
            $box = Tray::where('tray_name', $boxid)->first();

            if($box->trolley_id !== null){
                $oldBay = Trolley::where('id', $box->trolley_id)->first();
                $oldBay->number_of_trays = $oldBay->number_of_trays - 1;
                $oldBay->save();
            }

            $box->trolley_id = $bay->id;
            $box->save();
    
            $bay->number_of_trays = $bay->number_of_trays + 1;
            $bay->save();
        }


        return redirect()->back()->with(['success'=>'You have succesfully added boxes to this bay.']);
    }

    //Despatch functions

    public function showPickingDespatchPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.picking-despatch', ['portalUser'=>$portalUser]);
    }


}
