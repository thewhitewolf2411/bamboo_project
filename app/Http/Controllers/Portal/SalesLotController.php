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
use App\Services\BuildingLotService;
use Illuminate\Support\Facades\Auth;
use Session;

class SalesLotController extends Controller
{
    public function showSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.sales-lot.sales-lot', ['portalUser'=>$portalUser]);
    }

    public function showBuildingSalesLotPage($id = null){

        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $boxes = Tray::where('tray_type', 'Bo')->where('status', 3)->get();
        $tradeins = Tradein::all();

        $completedTradeins = array();

        $totalSalesLots = null;
        $salelot = null;
        $edit = false;

        if($id !== null){
            $totalSalesLots = SalesLot::find($id)->id;
            $edit = true;
            $salelot = SalesLot::find($id);
        }
        else{
            $totalSalesLots = count(SalesLot::all());
        }

        

        return view('portal.sales-lot.building-sales-lot', 
                ['portalUser'=>$portalUser, 'tradeins'=>$tradeins, 'boxes'=>$boxes, 
                'completedTradeins'=>$completedTradeins, 'totalSalesLots'=>$totalSalesLots, 'edit'=>$edit, 'salelot'=>$salelot]);
    }


    public function showCompletedSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $clients = Clients::all();

        $salesLots = SalesLot::all();

        $sorted = $salesLots->sortDesc();
        $sorted->values()->all();
        #dd($sorted);

        return view('portal.sales-lot.completed-sales-lot', ['portalUser'=>$portalUser, 'salesLots'=>$sorted, 'clients'=>$clients]);
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
            if($salesLot && intval($salesLot->sales_lot_status) === 2 || intval($salesLot->sales_lot_status) === 3){
                $salesLot->sales_lot_status = 4;
                $salesLot->payment_date = \Carbon\Carbon::now();
                $salesLot->save();
                return response('', 200);
            }
            else{
                if($salesLot && intval($salesLot->sales_lot_status) === 1){
                    return response('Sales lot not sold yet.', 500);
                }
                /*if($salesLot && intval($salesLot->sales_lot_status) === 2){
                    return response('Sales Lot not picked yet.', 500);
                }*/
                if($salesLot && intval($salesLot->sales_lot_status) === 5){
                    return response('Dispatched.', 500);
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

        $tradeins = Tradein::find($deviceIds);
        $grouped = $tradeins->groupBy(['product_id', 'correct_memory', 'correct_network', 'product_colour']);
        #dd($grouped);

        $key = 2;
        foreach($grouped as $device_id => $devices){
            #dd($device_id);

            #$dev = Tradein::find($device_id);
            $product = SellingProduct::find($device_id);

            $brand = Brand::find($product->brand_id)->brand_name;
            $product = SellingProduct::find($device_id);
            $model = $product->product_name;

            
            foreach($devices as $memory => $memory_group){
                
                $gb = $memory;

                foreach($memory_group as $color => $color_group){

                    $colour = $color;
                    
                    foreach($color_group as $network => $network_group){

                        $network_name = $network;

                        foreach($network_group as $single_device){

                            $gradeA = 0;
                            $gradeBplus = 0;
                            $gradeB = 0;
                            $gradeC = 0;
                            $wsi = 0;
                            $wsd = 0;
                            $nwsi = 0;
                            $nwsd = 0;
                            $grandTotal = 0;

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
                    }
                }
            }
            
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
        $data = array(["Ext Job Ref ID", "Individual Device job ref", "Manufacturer", "Model Number", "GB", "COLOUR", "IMEI", "Grade", "Network", "FMIP", "Cost"]);
        #$data = array();

        foreach($tradeins as $tradein){
            if($tradein->correct_product_id !== null){
                $product = SellingProduct::find($tradein->correct_product_id);
            } else {
                $product = SellingProduct::find($tradein->product_id);
            }
            $brand = Brand::find($product->brand_id)->brand_name;
            $productInfo = ProductInformation::where('product_id', $product->id)->first();
            $additionalCost = AdditionalCosts::first();

            $cost = $tradein->getPaidPrice();
            // price = bamboo_price + administration costs + 2 * carriage cost per device
            $isFimpLocked = $tradein->isFimpLocked() ? 'Yes' : 'No';

            $tradein_info = [
                $lot_id, 
                $tradein->barcode, 
                $brand,
                $product->product_name,
                $tradein->correct_memory,
                $tradein->product_colour,
                $tradein->imei_number,
                $tradein->cosmetic_condition,
                $tradein->correct_network,
                $isFimpLocked,
                utf8_decode('£' . $cost)
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

    public function exportxls($lot_id){
        $salesLot = SalesLot::findOrFail($lot_id);
        $deviceIds = SalesLotContent::where('sales_lot_id', $lot_id)->get()->pluck('device_id')->toArray();
        $tradeins = Tradein::whereIn('id', $deviceIds)->get();
        
        // header just in case
        $data = array(["Trade-in Barcode Number", "Box number", "Bamboo Grade", "Customer Grade", "Manufacturer/Model", "Category", "GB Size", "Network", "Colour", "IMEI/SN", "Cost"]);
        #$data = array();

        foreach($tradeins as $tradein){
            if($tradein->correct_product_id !== null){
                $product = SellingProduct::find($tradein->correct_product_id);
            } else {
                $product = SellingProduct::find($tradein->product_id);
            }
            $brand = Brand::find($product->brand_id)->brand_name;
            $productInfo = ProductInformation::where('product_id', $product->id)->first();
            $additionalCost = AdditionalCosts::first();

            $cost = $tradein->getDeviceCost();
            // price = bamboo_price + administration costs + 2 * carriage cost per device
            $isFimpLocked = $tradein->isFimpLocked() ? 'Yes' : 'No';

            $tradein_info = [
                $tradein->barcode, 
                $tradein->getTrayName($tradein->id),
                $tradein->getDeviceBambooGrade(),
                $tradein->customer_grade,
                $tradein->getProductName($tradein->product_id),
                $tradein->getCategoryName($tradein->correct_product_id),
                $tradein->correct_memory,
                $tradein->correct_network,
                $tradein->product_colour,
                $tradein->imei_number ?? null ?: $tradein->serial_number,
                utf8_decode('£' . $cost)
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


    //building sales lot
    public function buildSalesLot(Request $request){

        $result = BuildingLotService::addToLot($request->all());

        return response()->json($result);
    }

    public function removeFromLot(Request $request){
        $result = BuildingLotService::removeFromLot($request->all());

        return response()->json($result);
    }

    public function buildingSalesLotGenerateXls(Request $request){
        $xls = BuildingLotService::generateXls($request->all());

        $response = ['url'=>$xls];

        return $response;
    }

    public function getBoxes(){

        $returnBoxes = collect();

        $boxes = Tray::where('tray_type', 'Bo')->where('status', 3)->get();

        foreach($boxes as $box){
            if($box->isInBay() && $box->getNumberOfDevicesInSaleLot() < $box->max_number_of_devices){
                $box->number_of_devices = $box->getNumberOfDevices();
                $box->total_cost = $box->getBoxPrice();
                $box->added_qty = $box->getNumberOfDevices() - $box->getNumberOfDevicesInSaleLot();
                $returnBoxes->push($box);
            }
        }

        return $returnBoxes;

    }

    public function getTradeins(){

        $returnTradeins = collect();

        $tradeins = Tradein::all();

        foreach($tradeins as $tradein){
            if($tradein->isBoxed() && $tradein->isBoxedInBay() && !$tradein->isPartOfSalesLot()){

                $tradein->tray_name = $tradein->getTrayName($tradein->id);
                $tradein->bamboo_grade = $tradein->getDeviceBambooGrade();
                $tradein->product_name = $tradein->getProductName();
                $tradein->device_memory = $tradein->getDeviceMemory();
                $tradein->device_network = $tradein->getDeviceNetwork();
                $tradein->device_colour = $tradein->getDeviceColour();
                $tradein->device_cost = $tradein->getPaidPrice();
                $returnTradeins->push($tradein);
            }
        }

        return $returnTradeins;
    }

    public function getSaleLotTradeins(Request $request){
        $result = BuildingLotService::getSaleLotTradeins($request->sale_lot_id);

        return $result;
    }

    public function createLot(Request $request){
        $result = BuildingLotService::createLot($request->all());

        return $result;
    }

    public function editSaleLot(Request $request){
        $result = BuildingLotService::editLot($request->all());

        return $result;
    }
}
