<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Eloquent\PortalUsers;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\Box;
use App\Eloquent\BoxContent;
use App\Eloquent\Brand;
use App\Eloquent\SalesLot;
use App\Eloquent\Tray;
use App\Eloquent\Trolley;
use App\Eloquent\TrayContent;
use App\Eloquent\Tradein;
use App\Eloquent\SalesLotContent;
use App\Eloquent\SoldTradeIns;
use App\Services\Boxing;
use PDF;
use DNS1D;
use DNS2D;

class WarehouseManagementController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
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
        $manifacturer = "";

        if($request->manifacturer === "M"){
            $manifacturer = "Miscellaneous";
        }
        else{
            $brand = Brand::where('id', $request->manifacturer)->first();
            $manifacturer = $brand->getBrandFirstName();
        }

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

        $trayname = strtoupper(substr($manifacturer,0,1) . $request->reference . $request->network . $boxnumber);

        $newBox = Tray::create([

            'tray_name'=>$trayname,
            'tray_type'=>'Bo',
            'tray_brand'=>$manifacturer,
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

        if($box->number_of_devices === $max_number_of_devices){
            $box->status = 3;
        }

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

        $path = public_path().'/pdf/boxlabels/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
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

        $brandLet = substr($boxname, 0, 1);
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

        $path = public_path().'/pdf/boxsummary/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
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

        $brandLet = substr($boxname, 0, 1);
        #dd($brandLet);
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

        $path = public_path().'/pdf/boxmanifest/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
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
        if($bay === null){
            return redirect()->back()->with(['searcherror'=>'No such bay']);
        }
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
        $bays = Trolley::where('trolley_name', $request->bay_name)->get();

        if(count($bays)<1){
            $bay = Trolley::create([
                'trolley_name'=>$request->bay_name,
                'trolley_type'=>'Bay',
                'trolley_brand'=>'B',
                'number_of_trays'=>0
            ]);

            return redirect('/portal/warehouse-management/bay-overview')->with(['success'=>'You have succesfully created new Bay']);
        }

        return redirect('/portal/warehouse-management/bay-overview')->with(['error'=>'Bay with name ' . $request->bay_name . ' already exists.']);
    }

    public function deleteBay(Request $request){
        $bay = Trolley::where('trolley_name', $request->bayname)->first();
        $bay->delete();

        return redirect('/portal/warehouse-management/bay-overview')->with(['success'=>'Bay ' . $request->bayname . ' succesfully deleted.']);
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

        $salesLots = SalesLot::get();

        return view('portal.warehouse.picking-despatch', ['portalUser'=>$portalUser, 'salesLots'=>$salesLots]);
    }

    public function showPickLotPage($id){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $saleLot = SalesLot::where('id', $id)->first();

        $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $id)->where('device_id', null)->get();
        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $id)->where('box_id', null)->get();

        $boxes = array();
        $devices = array();

        foreach($salesLotContentBoxes as $sLCB){
            $box = Tray::where('id', $sLCB->box_id)->first();

            if($box->trolley_id == null){
                $box->trolley_id = 'Box not placed in a bay.';
            }
            else{
                $box->trolley_id = $box->getTrolleyName($box->trolley_id);
            }
            array_push($boxes, $box);
        }

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();
            $device->product_name = $device->getProductName($device->product_id);
            $device->box_location = $device->getTrayName($device->id);
            $device->bay_location = $device->getBayName();
            array_push($devices, $device);
        }

        return view('portal.warehouse.picking-sales-lot', ['portalUser'=>$portalUser, 'saleLot'=>$saleLot, 'boxes'=>$boxes, 'devices'=>$devices]);
    }

    public function printPickNote(Request $request){
        $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('device_id', null)->get();
        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('box_id', null)->get();

        $boxes = array();
        $devices = array();

        foreach($salesLotContentBoxes as $sLCB){
            $box = Tray::where('id', $sLCB->box_id)->first();

            if($box->trolley_id == null){
                $box->trolley_id = 'Box not placed in a bay.';
            }
            else{
                $box->trolley_id = $box->getTrolleyName($box->trolley_id);
            }
            array_push($boxes, $box);
        }

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();
            $device->product_name = $device->getProductName($device->product_id);
            $device->box_location = $device->getTrayName($device->id);
            $device->bay_location = $device->getBayName();
            array_push($devices, $device);
        }

        $path = public_path()."/pdf/picklot";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        $filename = public_path() . "/pdf/picklot/lot_no-" . $request->saleslotid . ".pdf";
        PDF::loadView('portal.labels.picknote', array('boxes'=>$boxes, 'devices'=>$devices))->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);
    
        return response("/pdf/picklot/lot_no-" . $request->saleslotid . ".pdf", 200);
    }

    public function checkBoxStatusOfLot(Request $request){
        #dd($request->all());

        $box = Tray::where('tray_name', $request->boxname)->where('tray_type', 'Bo')->first();
        if($box === null){
            return response('This box doesn\'t exist', 404);
        }
        if($box->status === 5){
            return response('This box is already picked.', 404);
        }

        $boxid = $box->id;

        if(SalesLotContent::where('box_id', $boxid)->where('sales_lot_id', $request->saleslotid)->first() === null){
            return response('This box is not part of this sales lot.', 404);
        }

        return response('This box can be picked.', 200);
    }

    public function checkDeviceStatusOfLot(Request $request){
        $tradein = Tradein::where('barcode', $request->devicebarcode)->first();
        if($tradein === null){
            return response('This order doesn\'t exist', 404);
        }
        if($tradein->job_state === '29'){
            return response('Device already picked.', 404);
        }

        $tradeinid = $tradein->id;

        if(SalesLotContent::where('device_id', $tradeinid)->where('sales_lot_id', $request->saleslotid)->first() === null){
            return response('This device is not part of this sales lot.', 404);
        }

        return response('This device can be picked.', 200);
    }

    public function pickBox(Request $request){
        $box = Tray::where('tray_name', $request->buildssaleslot_scanboxinput)->first();
        $box->status = 5;
        $box->save();

        return redirect()->back();
    }

    public function pickDevice(Request $request){
        $tradein = Tradein::where('barcode', $request->buildssaleslot_scandeviceinput)->first();
        $tradein->job_state = '29';
        $tradein->save();

        return redirect()->back();
    }

    public function cancelPickingLot(Request $request){

        $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $request->buildsaleslot_salelot)->where('device_id', null)->get();
        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->buildsaleslot_salelot)->where('box_id', null)->get();

        foreach($salesLotContentBoxes as $sLCB){
            $box = Tray::where('id', $sLCB->box_id)->first();
            if($box->status === 5){
                $box->status = 2;
            }
            $box->save();
        }

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();
            if($device->job_state === '29'){
                $device->job_state = '28';
            }

            $device->save();
        }

        return redirect()->back()->with(['success'=>'Picking succesfully canceled']);
    }

    public function suspendPickingLot(Request $request){
        $salesLot = SalesLot::where('id', $request->buildsaleslot_salelot)->first();
        if($salesLot->sales_lot_status === 6){
            $salesLot->sales_lot_status = 2;
            $salesLot->save();
            return redirect()->back()->with(['success'=>'Picking succesfully unsuspended']);
        }
        else{
            $salesLot->sales_lot_status = 6;
            $salesLot->save();
            return redirect()->back()->with(['success'=>'Picking succesfully suspended']);
        }
    
        
    }

    public function completePickingLot(Request $request){

        $salesLot = SalesLot::where('id', $request->buildsaleslot_salelot)->first();

        if($salesLot->sales_lot_status === 4){
            return redirect()->back()->with(['error'=>'This sales lot was already completed.']);
        }

        $salesLot->sales_lot_status = 3;
        $salesLot->save();

        return redirect('/portal/warehouse-management/picking-despatch')->with(['success'=>'Picking succesfully completed']);
    }

    public function despatchPickingLot(Request $request){
        $salesLot = SalesLot::where('id', $request->buildsaleslot_salelot)->first();

        $salesLot->sales_lot_status = 5;
        $salesLot->save();

        $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $request->buildsaleslot_salelot)->where('device_id', null)->get();
        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->buildsaleslot_salelot)->where('box_id', null)->get();

        foreach($salesLotContentBoxes as $sLCB){
            $box = Tray::where('id', $sLCB->box_id)->first();
            $boxContent = TrayContent::where('tray_id', $box->id)->get();

            foreach($boxContent as $bC){
                $tradein = Tradein::where('id', $bC->trade_in_id)->first();
                
                SoldTradeIns::create([
                    'device_barcode'=>$tradein->barcode,
                    'user_id'=>$tradein->user_id,
                    'product_id'=>$tradein->product_id,
                    'sales_lot_id'=>$salesLot->id,
                    'bamboo_price'=>$tradein->bamboo_price,
                    'bamboo_grade'=>$tradein->bamboo_grade,
                    'cosmetic_condition'=>$tradein->cosmetic_condition,
                    'sold_to'=>$salesLot->sold_to
                ]);

                $tradein->delete();
            }
            $box->delete();
        }

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();

            SoldTradeIns::create([
                'device_barcode'=>$tradein->barcode,
                'user_id'=>$tradein->user_id,
                'product_id'=>$tradein->product_id,
                'sales_lot_id'=>$salesLot->id,
                'bamboo_price'=>$tradein->bamboo_price,
                'bamboo_grade'=>$tradein->bamboo_grade,
                'cosmetic_condition'=>$tradein->cosmetic_condition,
                'sold_to'=>$salesLot->sold_to
            ]);

            $device->delete();
        }

        return redirect('/portal/warehouse-management/picking-despatch')->with(['success'=>'Sales lot despatched']);
    }

}
