<?php

namespace App\Services;

use App\Eloquent\AdditionalCosts;
use App\Eloquent\ImeiResult;
use App\Eloquent\Tradein;
use App\Eloquent\SellingProduct;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use Illuminate\Http\Request;

class ReceivingService{

    private static $url = "https://clientapiv2.phonecheck.com/cloud/cloudDB/CheckEsn/";
    private static $apiKey = "f06581b6-f4b3-4d40-a65e-6a39acf045fb";
    private static $username = "bamboo11";
    private static $devicetype = "Android";
    private static $carrier = "AT&T";

    public static function checkReceivingResaults(Request $request){

        $results = self::_checkReceivingResaults($request->all());

        if($results){  
            $tradein = self::allocateToTray(Tradein::find($request->tradeinid));
            $pdf = self::generateBarcode(Tradein::find($tradein->id));
            
            return [$tradein->getTrayName($tradein->id), $pdf];
        }

        return false;
    }

    private static function _checkReceivingResaults(array $receivingData){

        #dd($receivingData);

        self::orderExpired($receivingData['tradeinid']);

        self::deviceMissing($receivingData);

        if(array_key_exists('visible_imei', $receivingData)){
            self::hasImei($receivingData['visible_imei'], $receivingData['tradeinid']);
        }

        if(array_key_exists('serial_number', $receivingData)){
            self::saveSerial($receivingData['serial_number'], $receivingData['tradeinid']);
        }

        if(array_key_exists('visible_imei', $receivingData) && $receivingData['visible_imei'] !== 'no'){
            $tradein = Tradein::find($receivingData['tradeinid']);
            $tradein->imei_number = $receivingData['imei_number'];
            $tradein->save();
        }
        
        //if(array_key_exists('visible_imei', $receivingData) && $receivingData['visible_imei'] !== 'no'){
        //    self::checkImei($receivingData['imei_number'], $receivingData['tradeinid']);
        //}

        return true;
    }

    public static function checkBlacklistedReceivingResaults(Request $request){
        $results = self::_checkBlacklistedReceivingResaults($request->all());

        if($results){  
            $tradein = self::allocateToTray(Tradein::find($request->tradeinid));
            $pdf = self::generateBarcode(Tradein::find($tradein->id));
            
            return [$tradein->getTrayName($tradein->id), $pdf];
        }

        return false;
    }

    private static function _checkBlacklistedReceivingResaults(array $receivingData){
        #dd($receivingData);

        self::orderExpired($receivingData['tradeinid']);

        self::deviceMissing($receivingData);

        if(array_key_exists('visible_imei', $receivingData)){
            self::hasImei($receivingData['visible_imei'], $receivingData['tradeinid']);
        }

        if(array_key_exists('serial_number', $receivingData)){
            self::saveSerial($receivingData['serial_number'], $receivingData['tradeinid']);
        }

        //if(array_key_exists('visible_imei', $receivingData) && $receivingData['visible_imei'] !== 'no'){
        //    $tradein = Tradein::find($receivingData['tradeinid']);
        //    $tradein->imei_number = $receivingData['imei_number'];
        //    $tradein->save();
        //}
        
        if(array_key_exists('visible_imei', $receivingData) && $receivingData['visible_imei'] !== 'no'){
            self::checkImei($receivingData['imei_number'], $receivingData['tradeinid']);
        }

        return true;
    }

    private static function orderExpired($tradein_id){
        $tradein = Tradein::find($tradein_id);

        $expiryDate = \Carbon\Carbon::parse($tradein->expiry_date);
        $daysToExpire = \Carbon\Carbon::now()->diffInDays($expiryDate, false);

        if($daysToExpire<0){

            $bamboogradeval = 0;

            switch($tradein->customer_grade){
                case 'Excellent Working':
                    $bamboogradeval = 5;
                    break;
                case 'Good Working':
                    $bamboogradeval = 4;
                    break;
                case 'Poor Working':
                    $bamboogradeval = 3;
                    break;
                case 'Damaged Working':
                    $bamboogradeval = 2;
                    break;
                case 'Faulty':
                    $bamboogradeval = 1;
                    break;
                default:
                $bamboogradeval = 5;
                    break;
            }

            $checkPrice = new Testing();
            $deviceCurrentPrice = $checkPrice->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, $bamboogradeval);
        
            if($deviceCurrentPrice < $tradein->order_price){
                $tradein->job_state = '11j';
                $tradein->save();

                return false;
            }

            return true;
        }

        return true;
    }

    private static function deviceMissing($missingData){
        if($missingData['missing'] === 'missing'){

            $filenameWithExt = $missingData['missing_image']->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $missingData['missing_image']->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //$path = $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore); AAAAAAAAAAAAA
            $missingData['missing_image']->storeAs('public/missing_images',$fileNameToStore);
            $path = $fileNameToStore;

            $tradein = Tradein::find($missingData['tradeinid']);

            $tradein->missing_image = $path;
            $tradein->job_state = 4;

            $tradein->save();

            return false;
        }
        return true;
    }

    private static function hasImei($visibleImei, $tradeinid){
        if($visibleImei != 'yes'){
            $tradein = Tradein::find($tradeinid);
            if($tradein->customer_grade !== 'Faulty'){
                $tradein->job_state = '6';
                $testing = new Testing();
                $newPrice = $testing->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, 1);
                $tradein->bamboo_price = $newPrice;
            }
            else{
                $tradein->job_state = '9';
            }

            $tradein->save();

            return false;
        }

        return true;
    }

    private static function checkImei($imei_number, $tradeinid){

        $post = [
            'ApiKey' => self::$apiKey,
            'Username' => self::$username,
            'IMEI' => $imei_number,
            'Devicetype' => self::$devicetype,
            'carrier' => self::$carrier,
        ];

        $ch = curl_init(self::$url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        $result = json_decode($response);

        $imeiResult = ImeiResult::where('tradein_id', $tradeinid)->first();

        if($imeiResult == null){
            $imeiResult = new ImeiResult();
        }

        $imeiResult->tradein_id = $tradeinid;
        $imeiResult->API =  $result->API;
        $imeiResult->remarks =  $result->Remarks;
        $imeiResult->model_name =  $result->RawResponse->modelname;
        $imeiResult->blackliststatus =  $result->RawResponse->blackliststatus;
        $imeiResult->greyliststatus =  $result->RawResponse->greyliststatus;

        $imeiResult->save();

        $tradein = Tradein::find($tradeinid);

        $tradein->imei_number = $imei_number;
        
        #dd($imeiResult->blackliststatus === 'Yes');

        if($imeiResult->blackliststatus === 'Yes'){
            $tradein->job_state = 7;
            $tradein->save();
            return false;
        }

        $tradein->save();
        return true;

    }

    private static function generateBarcode(Tradein $tradein){

        $newBarcode = "";

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();

        if($tradein->isInQuarantine() === true){
            $newBarcode .= "90";
            $newBarcode .= mt_rand(100000, 999999);
            $tradein->quarantine_date = \Carbon\Carbon::now();
        }
        else{
            $tradein->job_state = 9;
            if($sellingProduct->brand_id < 10){
                $newBarcode .= $tradein->job_state . "0" . $sellingProduct->brand_id;
                $newBarcode .= mt_rand(10000, 99999);
            }
            else{
                $newBarcode .= $tradein->job_state . $sellingProduct->brand_id;
                $newBarcode .= mt_rand(1000, 9999);
            }
        }

        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }

        $additionalCost = AdditionalCosts::find(1);

        $tradein->carriage_cost = $additionalCost->carriage_costs;
        $tradein->admin_cost = $additionalCost->administration_costs;

        $tradein->save();

        $getLabel = new GetLabel();
        $pdf = $getLabel->getTradeinLabel($tradein);

        return $pdf;

    }

    private static function allocateToTray(Tradein $tradein){

        if($tradein->isInQuarantine()){
            $quarantineTrays = Tray::where('tray_type', 'R')->where('tray_brand', 'Q')->where('number_of_devices', "<" ,100)->get()->sortBy('tray_name');
            $quarantineTrays = $quarantineTrays->first();
            $quarantineName = $quarantineTrays->tray_name;
        }
        else{
            $quarantineTrays = Tray::where('tray_type', 'R')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<" ,100)->get()->sortBy('tray_name');
            $quarantineTrays = $quarantineTrays->first();
            $quarantineName = $quarantineTrays->tray_name;
        }

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }


        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        return $tradein;

        #$tradein->save();

        #return $quarantineTrays->tray_name;
    }

    private static function saveSerial($serialNumber, $tradeinid){
        $tradein = Tradein::find($tradeinid);

        $tradein->serial_number = $serialNumber;
        $tradein->save();

    }

}
