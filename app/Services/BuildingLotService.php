<?php

namespace App\Services;

use App\Eloquent\SalesLot;
use App\Eloquent\SalesLotContent;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;

class BuildingLotService{


    public static function addToLot(array $data){

        $result = null;

        if(array_key_exists("addedTradeins", $data)){
            $result = self::addTradeins($data["addedTradeins"]);
        }
        elseif(array_key_exists("addedBoxes", $data)){
            $result = self::addBoxes($data["addedBoxes"]);
        }

        return $result;
    }

    public static function removeFromLot(array $data){

        $result = null;

        if(array_key_exists('removedTradeins', $data)){
            $result = self::removeTradeins($data['removedTradeins']);
        }

        return $result;
    }

    public static function createLot(array $data){

        $result = null;

        if(array_key_exists("addedTradeins", $data)){
            $result = self::createNewLot($data["addedTradeins"]);
        }

        return $result;
    }

    private static function createNewLot($tradein_ids){
        $tradeins = Tradein::find($tradein_ids);

        $salelot = SalesLot::create([
            'sales_lot_status'=>1,
        ]);

        foreach($tradeins as $tradein){
            SalesLotContent::create([
                'sales_lot_id'=>$salelot->id,
                'box_id'=>$tradein->getTrayId(),
                'device_id'=>$tradein->id
            ]);
        }

        return true;
    }

    private static function addTradeins($tradein_ids){
        #dd($tradein_ids);

        $tradeins = Tradein::find($tradein_ids);


        $selectedBoxes = [];
        $selectedTradeins = $tradein_ids;
        
        foreach($tradeins as $tradein){
            if(array_key_exists($tradein->getTrayid(), $selectedBoxes)){
                $selectedBoxes[$tradein->getTrayId()] = $selectedBoxes[$tradein->getTrayId()] + 1;
            }
            else{
                $selectedBoxes[$tradein->getTrayId()] = 1;
            }
        }

        return [$selectedBoxes, $selectedTradeins];
    }

    private static function addBoxes($box_ids){

        $selectedBoxes = [];
        $selectedTradeins = [];

        $boxes = Tray::find($box_ids);

        foreach($boxes as $box){
            $boxContent = TrayContent::where('tray_id', $box->id)->get();

            foreach($boxContent as $tradeinid){
                $tradein = Tradein::find($tradeinid->trade_in_id);

                if($tradein->isBoxed() && !$tradein->isPartOfSalesLot()){
                    if(array_key_exists($tradein->getTrayid(), $selectedBoxes)){
                        $selectedBoxes[$tradein->getTrayId()] = $selectedBoxes[$tradein->getTrayId()] + 1;
                    }
                    else{
                        $selectedBoxes[$tradein->getTrayId()] = 1;
                    }

                    array_push($selectedTradeins, $tradein->id);
                }
            }
        }

        return [$selectedBoxes, $selectedTradeins];
    }

    private static function removeTradeins($tradein_ids){
        $tradeins = Tradein::find($tradein_ids);

        $selectedBoxesids = [];
        $selectedTradeins = [];
        $selectedBoxes = [];
        
        foreach($tradeins as $tradein){
            if(array_key_exists($tradein->getTrayid(), $selectedBoxesids)){
                $selectedBoxesids[$tradein->getTrayId()] = $selectedBoxesids[$tradein->getTrayId()] + 1;
            }
            else{
                $selectedBoxesids[$tradein->getTrayId()] = 1;
            }
        }

        foreach($tradeins as $tradein){
            $tradein->tray_name = $tradein->getTrayName($tradein->id);
            $tradein->bamboo_grade = $tradein->getDeviceBambooGrade();
            $tradein->product_name = $tradein->getProductName();
            $tradein->device_memory = $tradein->getDeviceMemory();
            $tradein->device_network = $tradein->getDeviceNetwork();
            $tradein->device_colour = $tradein->getDeviceColour();
            $tradein->device_cost = $tradein->getDeviceCost();
            #$returnTradeins->push($tradein);

            array_push($selectedTradeins, $tradein);
        }

        $boxes = Tray::find(array_keys($selectedBoxesids));

        foreach($boxes as $box){
            if($box->isInBay() && $box->getNumberOfDevicesInSaleLot() < $box->max_number_of_devices){
                $box->number_of_devices = $box->getNumberOfDevices();
                $box->total_cost = $box->getBoxPrice();
                $box->added_qty = $box->getNumberOfDevices() - $box->getNumberOfDevicesInSaleLot();
                array_push($selectedBoxes, $box);
            }
        }
        

        return [$selectedBoxesids, $selectedTradeins, $selectedBoxes];
    }

    public static function generateXls(array $data){
        if(array_key_exists("addedTradeins", $data)){
            $rows = [
                ['Trade-in Barcode Number', 'Box Number', 'Customer Grade', 'Bamboo Grade', 'Manufacturer/Model', 'GB Size', 'Network', 'Colour', 'Cost']
            ];

            $tradeins = Tradein::find($data['addedTradeins']);

            foreach($tradeins as $tradein){
                array_push($rows, [
                    $tradein->barcode,
                    $tradein->getTrayName($tradein->id),
                    $tradein->customer_grade,
                    $tradein->getDeviceBambooGrade(),
                    $tradein->getProductName(),
                    $tradein->getDeviceMemory(),
                    $tradein->getDeviceNetwork(),
                    $tradein->getDeviceColour(),
                    '£'.$tradein->getDeviceCost()
                    ]);
            }

            $filename = 'build_lot_xls_' . \Carbon\Carbon::now()->format('Y_m_d_h_i');
            $csv = fopen("php://output", 'w');
    
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($rows, null, 'A1');

            #return '/reports/overview/' . $filename;
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');

            
            if(!is_dir(public_path() . '/tmp/')){
                mkdir(public_path() . '/tmp/', 0777, true);
            }

            $filePath = public_path() . '/tmp/' . $filename . '.xlsx';

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);

            return '/tmp/' . $filename . '.xlsx';
            
            exit;

        }

    }

    public static function getSaleLotData($salelot_id){
        $salelot = SalesLot::find($salelot_id);
        $saleLotContent = SalesLotContent::where('sales_lot_id', $salelot_id)->get()->groupBy('box_id');

        #dd($saleLotContent);

        $returnData = [];
        
        foreach($saleLotContent as $boxid => $saleLotDevice){


            $box = Tray::find($boxid);
            $bayname = $box->getTrolleyName();

            array_push($returnData, [$salelot_id, $box->tray_name, $bayname, count($saleLotDevice)]);
        }


        return $returnData;
        
        

    }


    //Editing Sales Lot

    public static function getSaleLotTradeins($sale_lot_id){
        $salelot = SalesLot::find($sale_lot_id);
        $saleLotContentIds = SalesLotContent::where('sales_lot_id', $sale_lot_id)->get();

        $tradeinsids = $saleLotContentIds->pluck('device_id');

        $tradeins = Tradein::find($tradeinsids);

        $returnTradeins = collect();

        foreach($tradeins as $tradein){

            $tradein->tray_name = $tradein->getTrayName($tradein->id);
            $tradein->bamboo_grade = $tradein->getDeviceBambooGrade();
            $tradein->product_name = $tradein->getProductName();
            $tradein->device_memory = $tradein->getDeviceMemory();
            $tradein->device_network = $tradein->getDeviceNetwork();
            $tradein->device_colour = $tradein->getDeviceColour();
            $tradein->device_cost = $tradein->getDeviceCost();
            $returnTradeins->push($tradein);

            $tradein->save();
        }

        return $returnTradeins;


    }

    public static function editLot(array $data){

        $salelot_id = null;
        $tradein_ids = null;

        if(array_key_exists('edit_lot_id', $data)){
            $salelot_id = $data['edit_lot_id'];
        }

        if(array_key_exists('addedTradeins', $data)){
            $tradein_ids = $data['addedTradeins'];
        }

        $result = null;

        if($salelot_id !== null && $tradein_ids !== null){
            $result = self::_editLot($salelot_id, $tradein_ids);
        }
        
        return $result;
    }

    private static function _editLot($salelot_id, $tradein_ids){
        $salelot = SalesLot::find($salelot_id);
        $salelotCurrentContent = SalesLotContent::where('sales_lot_id', $salelot_id)->get();

        foreach($salelotCurrentContent as $currentContent){
            $currentContent->delete();
        }

        $tradeins = Tradein::find($tradein_ids);

        foreach($tradeins as $tradein){
            SalesLotContent::create([
                'sales_lot_id'=>$salelot->id,
                'box_id'=>$tradein->getTrayId(),
                'device_id'=>$tradein->id
            ]);

            $tradein->save();
        }

        return true;
    }
}