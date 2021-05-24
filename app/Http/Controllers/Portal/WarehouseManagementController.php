<?php

namespace App\Http\Controllers\Portal;

use App\Audits\TradeinAudit;
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
use Session;
use App\Services\GetLabel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

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
        $boxes = Tray::where('tray_type', 'Bo')->where('status', '!=', 1)->get();
        $brands = Brand::whereIn('id', [1,2,3])->get();

        $boxedTradeIns = array();

        foreach($boxes as $box){
            $boxContent = TrayContent::where('tray_id', $box->id)->orWhere('pseudo_tray_id', $box->id)->get();
            foreach($boxContent as $bC){
                $tradein = Tradein::where('id', $bC->trade_in_id)->first();
                $tradein->model = $tradein->getProductName();
                //$tradein->product_id = $tradein->getBrandName($tradein->product_id);
                array_push($boxedTradeIns, $tradein);
            }
        }

        return view('portal.warehouse.box-management', ['portalUser'=>$portalUser, 'boxes'=>$boxes, 'brands'=>$brands, 'boxedTradeIns'=>$boxedTradeIns]);
    }

    public function createBox(Request $request){

        #dd($request->all());
        $manifacturer = "";
        $brand = "";

        if($request->manifacturer === "M"){
            $manifacturer = "Miscellaneous";
        }
        else{
            $brand = Brand::where('id', $request->manifacturer)->first();
            $manifacturer = $brand->getBrandFirstName();
        }

        $boxnumber = count(Tray::where('tray_type', 'Bo')->where('tray_brand', $manifacturer)->where('tray_grade', strtoupper($request->reference))->get()) + 1;

        if($boxnumber<10){
            $boxnumber = '0' . $boxnumber;
        }elseif($boxnumber>=10 && $boxnumber<100){
            $boxnumber = $boxnumber;
        }

        $locked = null;
        if($request->network === 'l'){
            $locked = 'Locked';
        }
        elseif($request->network === 'u'){
            $locked = 'Unlocked';
        }

        //$trayname = strtoupper(substr($manifacturer,0,1) . $request->reference . $request->network . $boxnumber);

        $trayname = strtoupper("(" . $request->reference . ")" . substr($manifacturer, 0, 2) . $boxnumber);

        $newBox = Tray::create([

            'tray_name'=>$trayname,
            'tray_type'=>'Bo',
            'tray_brand'=>$manifacturer,
            'tray_grade'=>strtoupper($request->reference),
            'tray_network'=>$locked,
            'max_number_of_devices'=>$request->capacity,
            'box_devices'=>$request->boxdevices,
            'status'=>1

        ]);

        $pdf = new GetLabel();
        $pdf->getBoxLabel($newBox);

        $brand = $manifacturer;

        return redirect('/portal/warehouse-management/box-management/' . $newBox->id)->with(['filename'=>"/pdf/boxlabel-" . $trayname . ".pdf"]);

    }

    public function showBoxingPage($id){

        $currentBox = Tray::where('id', $id)->first();
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $boxes = Tray::where('tray_type', 'Bo')->where('status', '!=', 1)->get();
        $brands = Brand::whereIn('id', [1,2,3])->get();

        $id = $currentBox->tray_name;

        $boxedTradeIns = array();

        foreach($boxes as $box){
            $boxContent = TrayContent::where('tray_id', $currentBox->id)->get();
            foreach($boxContent as $bC){
                $tradein = Tradein::where('id', $bC->trade_in_id)->first();
                $tradein->model = $tradein->getProductName();
                //$tradein->product_id = $tradein->getBrandName($tradein->product_id);
                array_push($boxedTradeIns, $tradein);
            }
        }

        $path = public_path().'/pdf/boxlabels/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        $boxContent = TrayContent::where('pseudo_tray_id', $currentBox->id)->get();
        $tradeins = array();

        $showLabel = true;

        foreach($boxContent as $bC){
            $tradein = Tradein::where('id', $bC->trade_in_id)->first();
            $tradein->model = $tradein->getProductName();
            //$tradein->product_id = $tradein->getBrandName($tradein->product_id);
            array_push($tradeins, $tradein);
        }

        array_reverse($tradeins);
        
        return view('portal.warehouse.box-management', ['portalUser'=>$portalUser, 'boxes'=>$boxes, 'brands'=>$brands, 'box'=>$currentBox, 'tradeins'=>$tradeins, 'boxedTradeIns'=>$boxedTradeIns, 'showLabel'=>$showLabel]);
    }

    public function getBoxDevices(Request $request){

        $tray = Tray::where('id', $request->boxname)->first();

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
        #dd($request->all());

        $tradein = Tradein::where('barcode', $request->tradein_barcode)->first();
        $box = Tray::where('id', $request->boxid)->first();

        if($tradein === null){
            return redirect()->back()->with('error','No such device');
        }

        $result = new Boxing();
        $result = $result->checkBoxStatusForDevice($tradein, $box, $request);
        if($result[1] === 404){
            return redirect()->back()->with('error', $result[0]);
        }

        $box = Tray::where('id', $request->boxid)->first();

        $box->number_of_devices = $box->number_of_devices + 1;
        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent === null){
            $oldTrayContent = new TrayContent();
            $oldTrayContent->tray_id = 0;
            $oldTrayContent->trade_in_id = $tradein->id;
            $oldTrayContent->pseudo_tray_id = $box->id;
        }

        $oldTrayContent->pseudo_tray_id = $box->id;
        $oldTrayContent->save();

        $response = "";
        if($box->number_of_devices === $box->max_number_of_devices){
            $box->status = 3;
            
            $boxContent = TrayContent::where('pseudo_tray_id', $box->id)->get();

            foreach($boxContent as $bC){
                $oldTray = Tray::where('id', $bC->tray_id)->orWhere('id', $bC->pseudo_tray_id)->first();
                if($oldTray->tray_id !== $oldTray->pseudo_tray_id){
                    $oldTray->number_of_devices = $bC->number_of_devices - 1;
                    $box->number_of_devices = $box->number_of_devices + 1;
                }
                $oldTray->save();
    
                $bC->tray_id = $request->boxid;
                $bC->save();
            }
            $tradeins = $boxContent->pluck('trade_in_id')->toArray();
            $tradeins = Tradein::whereIn('id', $tradeins)->get();
            foreach($tradeins as $tradein){
                $tradein->location_changed_at = now();
                $tradein->save();
            }

            $request->boxname = $box->tray_name;

            $response = $this->printBoxManifest($request);
        }

        $box->save();
        $tradein->location_changed_at = now();
        $tradein->save();

        return redirect()->back()->with(['success', 'You have added device ' . $request->tradeinid . ' to this box.', 'addedtobox'=>$request->boxid, 'boxstatus'=>$box->status, 'response'=>$response]);
    }

    public function openBox(Request $request){

        $boxname = $request->boxname;
        $tray = Tray::where('id', $boxname)->first();
        $tray->status = 1;
        $tray->save();

        return 200;
    }

    public function suspendBox(Request $request){
        
        $boxname = $request->boxid;
        $tray = Tray::where('id', $boxname)->first();
        $tray->status = 2;
        $tray->save();

        return 200;
    }

    public function completeBox(Request $request){
        #dd($request->all());
        
        $boxname = $request->boxid;
        $tray = Tray::where('id', $boxname)->first();
        

        $boxContent = TrayContent::where('pseudo_tray_id', $request->boxid)->get();
        if(count($boxContent) === 0){
            return response("Can't close the empty box!", 400);
        }

        $tray->status = 3;
        $tradeins = $boxContent->pluck('trade_in_id')->toArray();

        foreach($boxContent as $bC){
            $oldTray = Tray::where('id', $bC->tray_id)->orWhere('id', $bC->pseudo_tray_id)->first();
            if($oldTray->tray_id !== $oldTray->pseudo_tray_id){
                $oldTray->number_of_devices = $bC->number_of_devices - 1;
                $tray->number_of_devices = $tray->number_of_devices + 1;
            }
            $oldTray->save();

            $bC->tray_id = $request->boxid;
            $bC->save();
        }

        $tray->save();

        $tradeins = Tradein::whereIn('id', $tradeins)->get();
        foreach($tradeins as $tradein){
            $tradein->location_changed_at = now();
            $tradein->save();
        }

        $request->boxname = $tray->tray_name;

        $response = $this->printBoxManifest($request);

        #return \redirect('/portal/warehouse-management/box-management/');
        return $response;
    }

    public function cancelBox(Request $request){
        #dd($request->all());

        $tray = Tray::where('id', $request->boxid)->first();

        $trayContentPseud = TrayContent::where('pseudo_tray_id', $request->boxid)->get();
        $trayContent = TrayContent::where('tray_id', $request->boxid)->get();

        foreach($trayContentPseud as $tCP){
            $tCP->pseudo_tray_id = null;
            $tCP->save();
        }

        if(count($trayContent)>0){
            $tray->status = 3;
            $tray->save();
        }
        else{
            $tray->delete();
        }

        return 200;
    }

    public function removeDevicesFromBox(Request $request){

        foreach($request->selected as $selectedDevice){
            $trayContent = TrayContent::where('trade_in_id', $selectedDevice)->first();
            $tray = Tray::where('id', $trayContent->pseudo_tray_id)->first();

            $tray->number_of_devices = $tray->number_of_devices-1;
            $tray->save();

            $tradein = Tradein::find($selectedDevice);
            $tradein->location_changed_at = now();
            $tradein->save();

            if($tray->status !== 3){
                $trayContent->pseudo_tray_id = null;
                $trayContent->save();
            }
            else{
                $trayContent->delete();
            }

        }

        return 200;
    }

    public function checkBoxStatusForDevice(Request $request){
        #dd($request->all());

        $tradein = Tradein::where('barcode', $request->tradeinid)->first();
        $box = Tray::where('id', $request->boxname)->first();

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
       
        $boxname = $request->boxname;

        $box = Tray::where('tray_name', $boxname)->first();
        $pdf = new GetLabel();
        $pdf->getBoxLabel($box);

        return response(['filename'=>"/pdf/boxlabel-" . $boxname . ".pdf"], 200);

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
            $brand = "Huawei";
        }
        if($brandLet === "M"){
            $brand = "Miscellaneous";
        }
        if($brandLet === "Q"){
            $brand = "Quarantine";
        }

        #dd($brandLet);

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
            $brand = "Huawei";
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

        #dd($request->all());

        $box = Tray::where('tray_name', $request->bay_id_scan)->first();
        if($box == null){
            $bay = Trolley::where('trolley_name', $request->bay_id_scan)->first();
            if($bay === null){
                return redirect()->back()->with(['searcherror'=>'No such bay or box.']);
            }
        }

        $binid = $request->bay_id_scan;

        if($box !== null){
            $binid = $box->trolley_id;
            if($binid === null){
                return redirect()->back()->with(['searcherror'=>'Box has not been allocated to bin yet.']);
            }    
        }

        $bay = Trolley::where('id', $binid)->orWhere('trolley_name', $binid)->first();
        if($bay->trolley_type !== "Bay"){
            return redirect()->back()->with(['searcherror'=>'Something went wrong, please try again.']);
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

        $bayid = $request->bayid;

        $bin = Trolley::where('id', $bayid)->first();

        $getlabel = new GetLabel();
        $pdf = $getlabel->getBayLabel($bin);

        return response('pdf/baylabel-'.$bin->trolley_name, 200);

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

            $boxContent = TrayContent::where('tray_id', $box->id)->get();
            foreach($boxContent as $bC){
                $tradein = Tradein::where('id', $bC->trade_in_id)->first();
                $tradein->location_changed_at = now();
                $tradein->save();
                #$last_audit = TradeinAudit::where('tradein_id', $tradein->id)->latest()->first();
                //dd($tradein->getTrayName($tradein->id), $tradein->id, $last_audit);
            }
        }


        return redirect()->back()->with(['success'=>'You have succesfully added boxes to this bay.']);
    }

    //Despatch functions

    public function showPickingDespatchPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $salesLots = SalesLot::where('sales_lot_status', '>', 1)->get();
        return view('portal.warehouse.picking-despatch', ['portalUser'=>$portalUser, 'salesLots'=>$salesLots]);
    }

    public function showPickLotPage($id){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $saleLot = SalesLot::where('id', $id)->first();

        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $id)->get();
        $boxes = array();
        $devices = array();
        /*
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
        */

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();
            $device->product_name = $device->getProductName($device->product_id);
            $device->box_location = $device->getTrayName($device->id);
            $device->bay_location = $device->getBayName();
            array_push($devices, $device);
        }

        $picked = SalesLotContent::where('sales_lot_id', $id)->where('picked', true)->get();
        #dd($boxes, $devices);

        return view('portal.warehouse.picking-sales-lot', ['portalUser'=>$portalUser, 'saleLot'=>$saleLot, 'boxes'=>$boxes, 'devices'=>$devices, 'picked'=>$picked]);
    }

    public function printPickNote(Request $request){
        // $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('device_id', null)->get();
        // $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('box_id', null)->get();

        // $boxes = array();
        // $devices = array();

        // foreach($salesLotContentBoxes as $sLCB){
        //     $box = Tray::where('id', $sLCB->box_id)->first();

        //     if($box->trolley_id == null){
        //         $box->trolley_id = 'Box not placed in a bay.';
        //     }
        //     else{
        //         $box->trolley_id = $box->getTrolleyName($box->trolley_id);
        //     }
        //     array_push($boxes, $box);
        // }

        // foreach($salesLotContentDevices as $sLCD){
        //     $device = Tradein::where('id', $sLCD->device_id)->first();
        //     $device->product_name = $device->getProductName($device->product_id);
        //     $device->box_location = $device->getTrayName($device->id);
        //     $device->bay_location = $device->getBayName();
        //     array_push($devices, $device);
        // }

        $salesLotDevices = SalesLotContent::where('sales_lot_id', $request->saleslotid)->get();
        $device_ids = $salesLotDevices->pluck('device_id')->toArray();
        $tradeins = Tradein::whereIn('id', $device_ids)->get();

        foreach($tradeins as $device){
            $device->product_name = $device->getProductName($device->product_id);
            $device->box_location = $device->getTrayName($device->id);
            $device->bay_location = $device->getBayName();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in barcode');
        $sheet->setCellValue('B1', 'Model');
        $sheet->setCellValue('C1', 'IMEI');
        $sheet->setCellValue('D1', 'Bay Location');
        $sheet->setCellValue('E1', 'Box Name');

        $pos = 2;
        foreach($tradeins as $key=>$tradein){
            $sheet->setCellValue('A'.$pos, $tradein->barcode);
            $sheet->setCellValue('B'.$pos, $tradein->product_name);
            $sheet->setCellValueExplicit('C'.$pos, (string)$tradein->imei_number, DataType::TYPE_STRING);
            $sheet->setCellValue('D'.$pos, $tradein->bay_location);
            $sheet->setCellValue('E'.$pos, $tradein->box_location);
            $pos++;
        }

        
        $filename = 'pick_note_'.$request->saleslotid.'_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
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

        #dd($request->all());

        $tradein = Tradein::where('barcode', $request->buildssaleslot_scandeviceinput)->first();

        if($tradein){
            $salesLotContent = SalesLotContent::where('device_id', $tradein->id)->first();
            if($salesLotContent){
                $salesLotContent->picked = true;
                $salesLotContent->save();
            }
            else{
                return redirect()->back()->with('pickerror', 'This barcode is not recognized for this lot!');
            }

        }

        return redirect()->back();
    }

    public function cancelPickingLot(Request $request){

        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->buildsaleslot_salelot)->where('picked', true)->get();

        foreach($salesLotContentDevices as $sLCD){
            $sLCD->picked = false;
            $sLCD->save();
        }

        return redirect('/portal/warehouse-management/picking-despatch')->with(['success'=>'Picking succesfully canceled']);
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
            return redirect('/portal/warehouse-management/picking-despatch')->with(['success'=>'Picking succesfully suspended']);
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

        #dd($request->all());

        foreach($request->salesLotIds as $salelotid){
            $salesLot = SalesLot::where('id', $salelotid)->first();

            $salesLot->sales_lot_status = 5;
            $salesLot->save();
    
            $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $salelotid)->where('device_id', null)->get();
            $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $salelotid)->where('box_id', null)->get();
    
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
    
                    //$tradein->delete();
                }
                //$box->delete();
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
    
                //$device->delete();
            }
    
        }


        return response('', 200);
    }

    public function getBoxNumber(Request $request){
        #dd($request->all());

        $brandLet = strtoupper($request->manufacturer);
        $brand = "";


        if($brandLet === "1"){
            $brand = "Apple";
        }
        if($brandLet === "2"){
            $brand = "Samsung";
        }
        if($brandLet === "3"){
            $brand = "Huawei";
        }
        if($brandLet === "4"){
            $brand = "Miscellaneous";
        }

        $boxes = Tray::where('tray_type', 'Bo')->where('tray_brand', $brand)->where('tray_grade', strtoupper($request->reference))->get();

        return response(count($boxes), 200);
    }

}
