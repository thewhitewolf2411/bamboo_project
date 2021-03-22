<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\AdditionalCosts;
use App\Eloquent\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Eloquent\PortalUsers;
use App\Eloquent\SalesLot;
use App\Eloquent\SalesLotContent;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Clients;
use App\Eloquent\ProductInformation;
use App\Eloquent\SellingProduct;
use Illuminate\Support\Facades\Auth;
use Session;

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

        $boxes = Tray::where('tray_type', 'Bo')->where('status', 3)->get();
        $tradeins = array();

        #$sli = SalesLotContent::all();
        foreach($boxes as $key=>$box){
            $salesLotBoxes = SalesLotContent::where('box_id', $box->id)->get();
            if(count($salesLotBoxes) === $box->number_of_devices){
                unset($boxes[$key]);
            }
            else{
                $boxcontent = TrayContent::where('tray_id', $box->id)->get();
                #dd($boxcontent);
                foreach($boxcontent as $bc){
                    if(SalesLotContent::where('device_id', $bc->trade_in_id)->first() === null){
                        $tradein = Tradein::where('id', $bc->trade_in_id)->first();
                        array_push($tradeins, $tradein);
                    }
                }
            }
        }

        if(Session::has('allTradeins')){
            Session::forget('allTradeins');
        }

        return view('portal.sales-lot.building-sales-lot', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins, 'boxes'=>$boxes]);
    }

    public function buildSalesLot(Request $request){

        $selectedBoxes = $request->selectedBoxes;
        $selectedTradeins = $request->selectedTradeIns;

        $boxcontent = "";
        if(!empty($selectedTradeins)){
            $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get()->groupBy('tray_id');
            foreach($boxcontent as $key=>$bc){
                if(is_array($selectedBoxes) && in_array($key, $selectedBoxes)){
                    $pos = array_search($key, $selectedBoxes);
                    unset($selectedBoxes[$pos]);
                }
            }
        }
        else{
            $boxcontent = array();
        }
        $boxcontent2 = "";
        if(!empty($selectedBoxes)){
            $boxcontent2 = TrayContent::whereIn('tray_id', $selectedBoxes)->get();
        }
        else{
            $boxcontent2 = array();
        }
        $boxcontent = "";
        if(!empty($selectedTradeins)){
            $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get();
        }
        else{
            $boxcontent = array();
        }

        if(empty($boxcontent) || empty($boxcontent2)){
            if(empty($boxcontent)){
                $allItems = $boxcontent2;
                $allItems = $allItems->groupBy('tray_id');
            }
            if(empty($boxcontent2)){
                $allItems = $boxcontent;
                $allItems = $allItems->groupBy('tray_id');
            }
        }
        else{
            $allItems = $boxcontent->merge($boxcontent2);
            $allItems = $allItems->groupBy('tray_id');
        }

        

        $boxes = array();

        foreach($allItems as $key=>$item){
            $box = Tray::where('id', $key)->first();
            $box->total_cost = 0;
            $box->total_qty = count($allItems[$key]);
            array_push($boxes, $box);
        }

        $boxcontent2 = "";
        if(!empty($selectedBoxes)){
            $boxcontent2 = TrayContent::whereIn('tray_id', $selectedBoxes)->get();
            $boxcontent2 = $boxcontent2->toArray();
        }
        else{
            $boxcontent2 = array();
        }
        $boxcontent = "";
        if(!empty($selectedTradeins)){
            $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get();
            $boxcontent = $boxcontent->toArray();
        }
        else{
            $boxcontent = array();
        }

        $allTradeins = array_merge($boxcontent, $boxcontent2);
        $allCurrentTradeins = $allTradeins;
        #dd($allCurrentTradeins);

        if(Session::has('allTradeins')){
            $allTradeins = array_unique(array_merge($allTradeins, Session::get('allTradeins')), SORT_REGULAR);
        }

        Session::put(['allTradeins'=>$allTradeins]);

        return response([$allCurrentTradeins, $allItems, $boxes], 200);
        
    }

    public function getBoxName($id){
        return Tray::where('id', $id)->first()->tray_name;
    }

    public function getBoxData(Request $request){
        #dd(Session::get('allItems'), $request->all());

        #dd(Session::get('allTradeins'), $request->all());

        $tradeins = array();
        foreach(Session::get('allTradeins') as $item){
            //dd($item['tray_id']);
            if($item['tray_id'] === intval($request->boxid)){
                $tradein = Tradein::where('id', $item['trade_in_id'])->first();
                $tradein->box_location = $tradein->getTrayName($tradein->id);
                $tradein->product_name = $tradein->getProductName($tradein->product_id);
                array_push($tradeins, $tradein);
            }
        }

        return response($tradeins, 200);
    }

    public function removeFromBox(Request $request){
        #dd($request->all());

        $selectedTradeins = $request->selectedTradeIns;
        $sessionItems = Session::get('allTradeins');

        $tradeins = array();

        foreach($selectedTradeins as $selectedTradein){
            foreach($sessionItems as $key=>$sessionItem){
                if($sessionItem['trade_in_id'] === intval($selectedTradein)){
                    $tradein = Tradein::where('id', $sessionItem['trade_in_id'])->first();
                    $tradein->box_location = $tradein->getTrayName($tradein->id);
                    $tradein->product_name = $tradein->getProductName($tradein->product_id);
                    array_push($tradeins, $tradein);
                    unset($sessionItems[$key]);
                }
            }
        }
        #dd($sessionItems);

        Session::put(['allTradeins'=>$sessionItems]);

        return response($tradeins, 200);
    }

    public function createNewLot(Request $request){

        $salesLotItems = Session::get('allTradeins');
        #dd($salesLotItems);

        $saleLot = SalesLot::create([
            'sales_lot_status'=>1,
        ]);

        foreach($salesLotItems as $salesLotItem){

            $tradein = Tradein::where('id', $salesLotItem['trade_in_id'])->first();

            $sli = new SalesLotContent();
            $sli->sales_lot_id = $saleLot->id;
            $sli->box_id = $tradein->getTrayId();
            $sli->device_id = $tradein->id;
            $sli->save();
        }

        #Sesson::forget();

        return response(200);
    }

    public function showCompletedSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $clients = Clients::all();

        $salesLots = SalesLot::all();

        return view('portal.sales-lot.completed-sales-lot', ['portalUser'=>$portalUser, 'salesLots'=>$salesLots, 'clients'=>$clients]);
    }

    public function getSalesLotContent(Request $request){
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

        return response(['boxes'=>$boxes, 'devices'=>$devices], 200);
    }

    public function sellLot(Request $request){

        #dd($request->all());

        $saleLot = SalesLot::where('id', $request->salelot_number)->first();

        if(intval($saleLot->sales_lot_status) === 1){
            $saleLot->sales_lot_status = 2;
            $saleLot->sold_to = $request->clients;
            $saleLot->sold_value = $request->sold_for_input;
            $saleLot->date_sold = \Carbon\Carbon::now();
    
            $saleLot->save();

            $salesLotContent = SalesLotContent::where('sales_lot_id', $request->salelot_number)->get();

            foreach($salesLotContent as $sLC){
                $trayContent = TrayContent::where('trade_in_id', $sLC->device_id)->first();
                $trayContent->delete();
            }
    
            return redirect()->back()->with(['success'=>'You succesfully sold the lot.']);
        }

        return redirect()->back()->with(['error'=>'fail']);

    }

    public function showSingleLotPage($id){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $salesLots = SalesLot::where('id', $id)->first();
        $salesLotContent = SalesLotContent::where('sales_lot_id', $id)->get();

        $tradeins = array();

        foreach($salesLotContent as $sLC){
            $tradein = Tradein::where('id', $sLC->device_id)->first();
            array_push($tradeins, $tradein);
        }

        return view('portal.sales-lot.view-sales-lot', ['portalUser'=>$portalUser, 'salesLots'=>$salesLots, 'tradeins'=>$tradeins]);

    }

    public function markLotPaymentRecieved(Request $request){
        if(isset($request->lot_id)){
            $salesLot = SalesLot::find($request->lot_id);
            if($salesLot && intval($salesLot->sales_lot_status) === 3){
                $salesLot->sales_lot_status = 4;
                $salesLot->save();
                return response('', 200);
            }
            else{
                if(intval($salesLot->sales_lot_status) !== 3){
                    return response('Lot not picked.', 404);
                }
            }
        }
        return response('Something went wrong, please try again.', 404);
    }

    public function clientSalesExport($lot_id){
        $salesLot = SalesLot::findOrFail($lot_id);
        $deviceIds = SalesLotContent::where('sales_lot_id', $lot_id)->get()->pluck('device_id')->toArray();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Manufacturer');
        $sheet->setCellValue('B1', 'Model');
        $sheet->setCellValue('C1', 'GB');
        $sheet->setCellValue('D1', 'COLOUR');
        $sheet->setCellValue('E1', 'Mobile Phone Network Name');
        $sheet->setCellValue('F1', 'GRADE A');
        $sheet->setCellValue('G1', 'GRADE B+');
        $sheet->setCellValue('H1', 'GRADE B');
        $sheet->setCellValue('I1', 'GRADE C');
        $sheet->setCellValue('J1', 'WSI');
        $sheet->setCellValue('K1', 'WSD');
        $sheet->setCellValue('L1', 'NWSI');
        $sheet->setCellValue('M1', 'NWSD');
        $sheet->setCellValue('N1', 'Grand Total');

        $tradeins = Tradein::whereIn('id', $deviceIds)->get();
        $grouped = $tradeins->groupBy(['product_id', 'correct_memory', 'product_colour', 'correct_network']);

        foreach($grouped as $device_id => $devices){

            $brand = Brand::find($device_id)->brand_name;
            $product = SellingProduct::find($device_id);
            $model = $product->product_name;

            $gradeA = 0;
            $gradeBplus = 0;
            $gradeB = 0;
            $gradeC = 0;
            $wsi = 0;
            $wsd = 0;
            $nwsi = 0;
            $nwsd = 0;
            $grandTotal = 0;

            $key = 2;
            foreach($devices as $memory => $memory_group){

                $gb = $memory;

                foreach($memory_group as $color => $color_group){

                    $colour = $color;
                    
                    foreach($color_group as $network => $network_group){

                        $network_name = $network;

                        foreach($network_group as $single_device){

                            if($single_device->cosmetic_condition === "A"){
                                $gradeA++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "B+"){
                                $gradeBplus++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "B"){
                                $gradeB++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "C"){
                                $gradeC++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "WSI"){
                                $wsi++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "WSD"){
                                $wsd++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "NWSI"){
                                $nwsi++;
                                $grandTotal++;
                            }
                            if($single_device->cosmetic_condition === "NWSI"){
                                $nwsd++;
                                $grandTotal++;
                            }
                        }
                    }
                }

            }

            $sheet->setCellValue('A'.$key, $brand);
            $sheet->setCellValue('B'.$key, $model);
            $sheet->setCellValue('C'.$key, $gb);
            $sheet->setCellValue('D'.$key, $colour);
            $sheet->setCellValue('E'.$key, $network_name);
            $sheet->setCellValue('F'.$key, $gradeA);
            $sheet->setCellValue('G'.$key, $gradeBplus);
            $sheet->setCellValue('H'.$key, $gradeB);
            $sheet->setCellValue('I'.$key, $gradeC);
            $sheet->setCellValue('J'.$key, $wsi);
            $sheet->setCellValue('K'.$key, $wsd);
            $sheet->setCellValue('L'.$key, $nwsi);
            $sheet->setCellValue('M'.$key, $nwsd);
            $sheet->setCellValue('N'.$key, $grandTotal);
            $key++;
            
        }

        $filename = 'client_sales_export' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }


    public function ISMPreAlert($lot_id){
        $salesLot = SalesLot::findOrFail($lot_id);
        $deviceIds = SalesLotContent::where('sales_lot_id', $lot_id)->get()->pluck('device_id')->toArray();
        $tradeins = Tradein::whereIn('id', $deviceIds)->get();
        
        // header just in case
        //$data = array(["Ext Job Ref ID", "Manufacturer", "Model Number", "GB", "COLOUR", "IMEI", "Grade", "Network", "FMIP", "Cost"]);
        $data = array();

        foreach($tradeins as $tradein){
            if($tradein->correct_product_id !== null){
                $product = SellingProduct::find($tradein->correct_product_id);
            } else {
                $product = SellingProduct::find($tradein->product_id);
            }
            $brand = Brand::find($product->brand_id)->brand_name;
            $productInfo = ProductInformation::where('product_id', $product->id)->first();
            $additionalCost = AdditionalCosts::first();

            $cost = $tradein->bamboo_price + $additionalCost->administration_costs + (2 * $additionalCost->carriage_costs);
            // price = bamboo_price + administration costs + 2 * carriage cost per device
            $isFimpLocked = $tradein->isFimpLocked() ? 'Yes' : 'No';

            $tradein_info = [
                $tradein->barcode, 
                $brand,
                $product->product_name,
                $tradein->correct_memory,
                $tradein->product_colour,
                $tradein->imei_number,
                $tradein->cosmetic_condition,
                $tradein->correct_network,
                $isFimpLocked,
                $cost
            ];
            array_push($data, $tradein_info);
        }
        
        $csv = fopen("php://output", 'w');        
        foreach ($data as $fields) {
            fputcsv($csv, $fields);
        }
        fclose($csv);

        $filename = 'PreAlert_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}
