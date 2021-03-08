<?php 
namespace App\Services;

use App\Audits\TradeinAudit;
use App\Eloquent\AdditionalCosts;
use App\Eloquent\TestingFaults;
use App\Eloquent\Tradein;
use Schema;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;
class Reports{

    public function overviewReport(){

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in ID');
        $sheet->setCellValue('B1', 'Trade in barcode');
        $sheet->setCellValue('C1', 'Manufacturer');
        $sheet->setCellValue('D1', 'Model');
        $sheet->setCellValue('E1', 'IMEI');
        $sheet->setCellValue('F1', 'Network');
        $sheet->setCellValue('G1', 'Colour');
        $sheet->setCellValue('H1', 'Offer Price');
        $sheet->setCellValue('I1', 'Paid Price');
        $sheet->setCellValue('J1', 'Admin');
        $sheet->setCellValue('K1', 'Logistics');
        $sheet->setCellValue('L1', 'Total');
        $sheet->setCellValue('M1', 'Customer Grade');
        $sheet->setCellValue('N1', 'Customer Grade after testing');
        $sheet->setCellValue('O1', 'Bamboo Grade');
        $sheet->setCellValue('P1', 'Customer Status');
        $sheet->setCellValue('Q1', 'Bamboo Status');
        $sheet->setCellValue('R1', 'Fully FUnctional');
        $sheet->setCellValue('S1', 'Date Order Placed');
        $sheet->setCellValue('T1', 'TP Despatch Date');
        $sheet->setCellValue('U1', 'Date Received');
        $sheet->setCellValue('V1', 'Expiry Date');
        $sheet->setCellValue('W1', 'Date Tested');
        $sheet->setCellValue('X1', 'Return Date');
        $sheet->setCellValue('Y1', 'Quarantine Date');
        $sheet->setCellValue('Z1', 'Quarantine Reason');
        $sheet->setCellValue('AA1', 'Box Date');
        $sheet->setCellValue('AB1', 'Processor Name');
        $sheet->setCellValue('AC1', 'Quarantine');
        $sheet->setCellValue('AD1', 'FMIP');
        $sheet->setCellValue('AE1', 'Stock Location');

        $tradeins = Tradein::all();
        $additionalCosts = AdditionalCosts::first();

        foreach($tradeins as $key=>$tradein){

            $correctMemory = '';
            if($tradein->correct_network === null){
                $correctMemory = $tradein->customer_network;
            }
            else{
                $correctMemory = $tradein->correct_network;
            }

            $fullyFunctional = '';
            if($tradein->isFullyFunctional()){
                $fullyFunctional = "Yes";
            }
            else{
                $fullyFunctional = "No";
            }

            $fimp = '';
            if($tradein->isFimpLocked()){
                $fimp = "Yes";
            }
            else{
                $fimp = "No";
            }
            $quarantine = '';
            if($tradein->isInQuarantine()){
                $quarantine = 'Yes';
            }
            else{
                $quarantine = 'No';
            }

            $tradeinauditTPDespatched = TradeinAudit::where('tradein_id', $tradein->id)->where('customer_status', 'Trade Pack Despatched')->first();
            $tradeinauditReceived = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', '!=' ,'Not received yet.')->first();
            $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device has passed testing')->first();
            $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
            $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
            if($tradeinauditTPDespatched === null){
                $tradeinauditTPDespatched = '';
            }
            else{
                $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
            }
            $tradeinauditUser = '';
            if($tradeinauditReceived === null){
                $tradeinauditReceived = '';
                $tradeinauditUser = '';
            }
            else{
                $tradeinauditUser = $tradeinauditReceived->getUser();
                $tradeinauditReceived = $tradeinauditReceived->created_at;
            }
            if($tradeinauditTested === null){
                $tradeinauditTested = '';
            }
            else{
                $tradeinauditTested = $tradeinauditTested->created_at;
            }
            if($tradeinauditBoxed === null){
                $tradeinauditBoxed = '';
            }
            else{
                $tradeinauditBoxed = $tradeinauditBoxed->created_at;
            }
            if($tradeinauditReturned === null){
                $tradeinauditReturned = '';
            }
            else{
                $tradeinauditReturned = $tradeinauditReturned->created_at;
            }

            $index = $key+2;

            $total = "";
            if($tradein->bamboo_price === null){
                $total = $tradein->order_price + $tradein->admin_cost +  $tradein->carriage_cost + $additionalCosts->miscellaneous_costs_individual;
            }
            else{
                $total = $tradein->bamboo_price + $tradein->admin_cost +  $tradein->carriage_cost + $additionalCosts->miscellaneous_costs_individual;
            }

            $sheet->setCellValue('A'.$index, $tradein->barcode_original);
            $sheet->setCellValue('B'.$index, $tradein->barcode);
            $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('E'.$index, $tradein->imei_number);
            $sheet->setCellValue('F'.$index, $correctMemory);
            $sheet->setCellValue('G'.$index, $tradein->product_colour);
            $sheet->setCellValue('H'.$index, $tradein->order_price);
            $sheet->setCellValue('I'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('J'.$index, $tradein->admin_cost);
            $sheet->setCellValue('K'.$index, $tradein->carriage_cost + $additionalCosts->miscellaneous_costs_individual);
            $sheet->setCellValue('L'.$index, '£' . $total);
            $sheet->setCellValue('M'.$index, $tradein->customer_grade);
            $sheet->setCellValue('N'.$index, $tradein->bamboo_grade);
            $sheet->setCellValue('O'.$index, $tradein->customer_grade);
            $sheet->setCellValue('P'.$index, $tradein->cosmetic_condition);
            $sheet->setCellValue('Q'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('R'.$index, $fullyFunctional);
            $sheet->setCellValue('S'.$index, $tradein->created_at);
            $sheet->setCellValue('T'.$index, $tradeinauditTPDespatched);
            $sheet->setCellValue('U'.$index, $tradeinauditReceived);
            $sheet->setCellValue('V'.$index, $tradein->expiry_date);
            $sheet->setCellValue('W'.$index, $tradeinauditTested);
            $sheet->setCellValue('X'.$index, $tradeinauditReturned);
            $sheet->setCellValue('Y'.$index, $tradein->quarantine_date);
            $sheet->setCellValue('Z'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('AA'.$index, $tradeinauditBoxed);
            $sheet->setCellValue('AB'.$index, $tradeinauditUser);
            $sheet->setCellValue('AC'.$index, $quarantine);
            $sheet->setCellValue('AD'.$index, $fimp);
            $sheet->setCellValue('AE'.$index, $tradein->getTrayName($tradein->id));
        }

        if(!is_dir(public_path() . '/reports/overview')){
           mkdir(public_path() . '/reports/overview', 0777, true);
        } 

        $filename = 'overview_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/overview/' . $filename);

        return '/reports/overview/' . $filename;
    }

    public function stockReport(){
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in ID');
        $sheet->setCellValue('B1', 'Trade in barcode');
        $sheet->setCellValue('C1', 'Manufacturer');
        $sheet->setCellValue('D1', 'Model');
        $sheet->setCellValue('E1', 'IMEI');
        $sheet->setCellValue('F1', 'Network');
        $sheet->setCellValue('G1', 'Colour');
        $sheet->setCellValue('H1', 'Customer Grade');
        $sheet->setCellValue('I1', 'Customer Grade after testing');
        $sheet->setCellValue('J1', 'Bamboo Grade');
        $sheet->setCellValue('K1', 'Customer Status');
        $sheet->setCellValue('L1', 'Bamboo Status');
        $sheet->setCellValue('M1', 'Fully Functional');
        $sheet->setCellValue('N1', 'Date Order Placed');
        $sheet->setCellValue('O1', 'TP Despatch Date');
        $sheet->setCellValue('P1', 'Date Received');
        $sheet->setCellValue('Q1', 'Date Tested');
        $sheet->setCellValue('R1', 'Quarantine Date');
        $sheet->setCellValue('S1', 'Box Date');
        $sheet->setCellValue('T1', 'Processor Name');
        $sheet->setCellValue('U1', 'Quarantine');
        $sheet->setCellValue('V1', 'FMIP');
        $sheet->setCellValue('W1', 'Stock Location');

        $tradeins = Tradein::all();
        $additionalCosts = AdditionalCosts::first();

        foreach($tradeins as $key=>$tradein){

            if(!$tradein->deviceInPaymentProcess()){

                $correctMemory = '';
                if($tradein->correct_network === null){
                    $correctMemory = $tradein->customer_network;
                }
                else{
                    $correctMemory = $tradein->correct_network;
                }

                $fullyFunctional = '';
                if($tradein->isFullyFunctional()){
                    $fullyFunctional = "Yes";
                }
                else{
                    $fullyFunctional = "No";
                }

                $fimp = '';
                if($tradein->isFimpLocked()){
                    $fimp = "Yes";
                }
                else{
                    $fimp = "No";
                }
                $quarantine = '';
                if($tradein->isInQuarantine()){
                    $quarantine = 'Yes';
                }
                else{
                    $quarantine = 'No';
                }

                $tradeinauditTPDespatched = TradeinAudit::where('tradein_id', $tradein->id)->where('customer_status', 'Trade Pack Despatched')->first();
                $tradeinauditReceived = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', '!=' ,'Not received yet.')->first();
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device has passed testing')->first();
                $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
                $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
                if($tradeinauditTPDespatched === null){
                    $tradeinauditTPDespatched = '';
                }
                else{
                    $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
                }
                $tradeinauditUser = '';
                if($tradeinauditReceived === null){
                    $tradeinauditReceived = '';
                    $tradeinauditUser = '';
                }
                else{
                    $tradeinauditUser = $tradeinauditReceived->getUser();
                    $tradeinauditReceived = $tradeinauditReceived->created_at;
                }
                if($tradeinauditTested === null){
                    $tradeinauditTested = '';
                }
                else{
                    $tradeinauditTested = $tradeinauditTested->created_at;
                }
                if($tradeinauditBoxed === null){
                    $tradeinauditBoxed = '';
                }
                else{
                    $tradeinauditBoxed = $tradeinauditBoxed->created_at;
                }
                if($tradeinauditReturned === null){
                    $tradeinauditReturned = '';
                }
                else{
                    $tradeinauditReturned = $tradeinauditReturned->created_at;
                }

                $index = $key+2;

                $sheet->setCellValue('A'.$index, $tradein->barcode_original);
                $sheet->setCellValue('B'.$index, $tradein->barcode);
                $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValue('E'.$index, $tradein->imei_number);
                $sheet->setCellValue('F'.$index, $correctMemory);
                $sheet->setCellValue('G'.$index, $tradein->product_colour);
                $sheet->setCellValue('H'.$index, $tradein->customer_grade);
                $sheet->setCellValue('I'.$index, $tradein->bamboo_grade);
                $sheet->setCellValue('J'.$index, $tradein->customer_grade);
                $sheet->setCellValue('K'.$index, $tradein->cosmetic_condition);
                $sheet->setCellValue('L'.$index, $tradein->getBambooStatus());
                $sheet->setCellValue('M'.$index, $fullyFunctional);
                $sheet->setCellValue('N'.$index, $tradein->created_at);
                $sheet->setCellValue('O'.$index, $tradeinauditTPDespatched);
                $sheet->setCellValue('P'.$index, $tradeinauditReceived);
                $sheet->setCellValue('Q'.$index, $tradeinauditTested);
                $sheet->setCellValue('R'.$index, $tradein->quarantine_date);
                $sheet->setCellValue('S'.$index, $tradeinauditBoxed);
                $sheet->setCellValue('T'.$index, $tradeinauditUser);
                $sheet->setCellValue('U'.$index, $quarantine);
                $sheet->setCellValue('V'.$index, $fimp);
                $sheet->setCellValue('W'.$index, $tradein->getTrayName($tradein->id));
            }
        }

        if(!is_dir(public_path() . '/reports/stock')){
            mkdir(public_path() . '/reports/stock', 0777, true);
        }

        $filename = 'stock_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/stock/' . $filename);

        return '/reports/stock/' . $filename;
    }

    public function receivingReport(){
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in ID');
        $sheet->setCellValue('B1', 'Trade in barcode');
        $sheet->setCellValue('C1', 'Manufacturer');
        $sheet->setCellValue('D1', 'Model');
        $sheet->setCellValue('E1', 'IMEI');
        $sheet->setCellValue('F1', 'Network');
        $sheet->setCellValue('G1', 'Customer Grade');
        $sheet->setCellValue('H1', 'Date Order Placed');
        $sheet->setCellValue('I1', 'Despatch Date');
        $sheet->setCellValue('J1', 'Date Received');
        $sheet->setCellValue('K1', 'Offer Price');
        $sheet->setCellValue('L1', 'Admin');
        $sheet->setCellValue('M1', 'Logistics');
        $sheet->setCellValue('N1', 'Quarantine Date');
        $sheet->setCellValue('O1', 'Stock Location');
        $sheet->setCellValue('P1', 'Processor Name');

        $tradeins = Tradein::all();
        $additionalCosts = AdditionalCosts::first();

        foreach($tradeins as $key=>$tradein){

            if(!$tradein->deviceInPaymentProcess()){

                $correctNetwork = '';
                if($tradein->correct_network === null){
                    $correctNetwork = $tradein->customer_network;
                }
                else{
                    $correctNetwork = $tradein->correct_network;
                }

                $fullyFunctional = '';
                if($tradein->isFullyFunctional()){
                    $fullyFunctional = "Yes";
                }
                else{
                    $fullyFunctional = "No";
                }

                $fimp = '';
                if($tradein->isFimpLocked()){
                    $fimp = "Yes";
                }
                else{
                    $fimp = "No";
                }
                $quarantine = '';
                if($tradein->isInQuarantine()){
                    $quarantine = 'Yes';
                }
                else{
                    $quarantine = 'No';
                }

                $tradeinauditTPDespatched = TradeinAudit::where('tradein_id', $tradein->id)->where('customer_status', 'Trade Pack Despatched')->first();
                $tradeinauditReceived = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', '!=' ,'Not received yet.')->first();
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device has passed testing')->first();
                $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
                $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
                if($tradeinauditTPDespatched === null){
                    $tradeinauditTPDespatched = '';
                }
                else{
                    $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
                }
                $tradeinauditUser = '';
                if($tradeinauditReceived === null){
                    $tradeinauditReceived = '';
                    $tradeinauditUser = '';
                }
                else{
                    $tradeinauditUser = $tradeinauditReceived->getUser();
                    $tradeinauditReceived = $tradeinauditReceived->created_at;
                }
                if($tradeinauditTested === null){
                    $tradeinauditTested = '';
                }
                else{
                    $tradeinauditTested = $tradeinauditTested->created_at;
                }
                if($tradeinauditBoxed === null){
                    $tradeinauditBoxed = '';
                }
                else{
                    $tradeinauditBoxed = $tradeinauditBoxed->created_at;
                }
                if($tradeinauditReturned === null){
                    $tradeinauditReturned = '';
                }
                else{
                    $tradeinauditReturned = $tradeinauditReturned->created_at;
                }

                $index = $key+2;

                $sheet->setCellValue('A'.$index, $tradein->barcode_original);
                $sheet->setCellValue('B'.$index, $tradein->barcode);
                $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValue('E'.$index, $tradein->imei_number);
                $sheet->setCellValue('F'.$index, $correctNetwork);
                $sheet->setCellValue('G'.$index, $tradein->customer_grade);
                $sheet->setCellValue('H'.$index, $tradein->created_at);
                $sheet->setCellValue('I'.$index, $tradeinauditTPDespatched);
                $sheet->setCellValue('J'.$index, $tradeinauditReceived);
                $sheet->setCellValue('K'.$index, $tradein->order_price);
                $sheet->setCellValue('L'.$index, $tradein->admin_cost);
                $sheet->setCellValue('M'.$index, $tradein->carriage_cost);
                $sheet->setCellValue('N'.$index, $tradein->quarantine_date);
                $sheet->setCellValue('O'.$index, $tradein->getTrayName($tradein->id));
                $sheet->setCellValue('P'.$index, '');

            }
        }

        if(!is_dir(public_path() . '/reports/receiving')){
            mkdir(public_path() . '/reports/receiving', 0777, true);
        }

        $filename = 'receiving_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/receiving/' . $filename);

        return '/reports/receiving/' . $filename;
    }

    public function testingReport(){
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in ID');
        $sheet->setCellValue('B1', 'Trade in barcode');
        $sheet->setCellValue('C1', 'Manufacturer');
        $sheet->setCellValue('D1', 'Model');
        $sheet->setCellValue('E1', 'IMEI');
        $sheet->setCellValue('F1', 'Network');
        $sheet->setCellValue('G1', 'Colour');
        $sheet->setCellValue('H1', 'Customer Grade');
        $sheet->setCellValue('I1', 'Customer Grade after testing');
        $sheet->setCellValue('J1', 'Offer Price');
        $sheet->setCellValue('K1', 'Offer after Testing');
        $sheet->setCellValue('L1', 'Bamboo Grade');
        $sheet->setCellValue('M1', 'Bamboo Status');
        $sheet->setCellValue('N1', 'Fully Functional');
        $sheet->setCellValue('O1', 'Fail Result');
        $sheet->setCellValue('P1', 'Date Received');
        $sheet->setCellValue('Q1', 'Date Tested');
        $sheet->setCellValue('R1', 'Quarantine Date');
        $sheet->setCellValue('S1', 'Processor Name');
        $sheet->setCellValue('T1', 'Quarantine');
        $sheet->setCellValue('U1', 'FMIP/ Google Lock');
        $sheet->setCellValue('V1', 'Stock Location');

        $tradeins = Tradein::all();
        $additionalCosts = AdditionalCosts::first();

        foreach($tradeins as $key=>$tradein){

            if($tradein->isInTesting()){

                $correct_network = '';
                if($tradein->correct_network === null){
                    $correct_network = $tradein->customer_network;
                }
                else{
                    $correct_network = $tradein->correct_network;
                }

                $fullyFunctional = '';
                if($tradein->isFullyFunctional()){
                    $fullyFunctional = "Yes";
                }
                else{
                    $fullyFunctional = "No";
                }

                $fimpOrGoogle = 'NO';
                if($tradein->isFimpLocked() || $tradein->isGoogleLocked()){
                    $fimpOrGoogle = "YES";
                }
            
                $quarantine = '';
                if($tradein->isInQuarantine()){
                    $quarantine = 'YES';
                }
                else{
                    $quarantine = 'NO';
                }

                $tradeinauditTPDespatched = TradeinAudit::where('tradein_id', $tradein->id)->where('customer_status', 'Trade Pack Despatched')->first();
                $tradeinauditReceived = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', '!=' ,'Not received yet.')->first();
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device has passed testing')->first();
                $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
                $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
                if($tradeinauditTPDespatched === null){
                    $tradeinauditTPDespatched = '';
                }
                else{
                    $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
                }
                $tradeinauditUser = '';
                if($tradeinauditReceived === null){
                    $tradeinauditReceived = '';
                    $tradeinauditUser = '';
                }
                else{
                    $tradeinauditUser = $tradeinauditReceived->getUser();
                    $tradeinauditReceived = $tradeinauditReceived->created_at;
                }
                if($tradeinauditTested === null){
                    $tradeinauditTested = '';
                }
                else{
                    $tradeinauditTested = $tradeinauditTested->created_at;
                }
                if($tradeinauditBoxed === null){
                    $tradeinauditBoxed = '';
                }
                else{
                    $tradeinauditBoxed = $tradeinauditBoxed->created_at;
                }
                if($tradeinauditReturned === null){
                    $tradeinauditReturned = '';
                }
                else{
                    $tradeinauditReturned = $tradeinauditReturned->created_at;
                }

                $testing_faults = [];
                $fully_functional = 'Yes';
                $faults_col = "";
                $testingFaults = TestingFaults::where('tradein_id', $tradein->id)->first();
                if($testingFaults !== null){
                    $available_faults = [
                        "audio_test" => "Audio Test",
                        "front_microphone" => "Front Microphone",
                        "headset_test" => "Headset Test",
                        "loud_speaker_test" => "Loud Speaker Test",
                        "microphone_playback_test" => "Microphone Playback Test",
                        "buttons_test" => "Buttons Test",
                        "sensor_test" => "Sensor Test",
                        "camera_test" => "Camera Test",
                        "glass_condition" => "Glass Condition",
                        "vibration" => "Vibration",
                        "original_colour" => "Original Colour",
                        "battery_health" => "Battery Health",
                        "nfc" => "NFC",
                        "no_power" => "No Power",
                        "fake_missing_parts" => "Fake Missing Parts",
                    ];

                    foreach($available_faults as $fault => $text){
                        if($testingFaults[$fault] !== null){
                            array_push($testing_faults, $text);
                        }
                    }
                    $fully_functional = 'No';
                }

                if(count($testing_faults) > 1){
                    $faults_col = implode(' / ', $testing_faults);
                } else {
                    if(count($testing_faults) === 1){
                        $faults_col = $testing_faults[0];
                    }
                }

                $index = $key+2;

                $sheet->setCellValue('A'.$index, $tradein->barcode_original);
                $sheet->setCellValue('B'.$index, $tradein->barcode);
                $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValueExplicit('E'.$index, (string)$tradein->imei_number, DataType::TYPE_STRING);
                $sheet->setCellValue('F'.$index, $correct_network);
                $sheet->setCellValue('G'.$index, $tradein->product_colour);
                $sheet->setCellValue('H'.$index, $tradein->customer_grade);
                $sheet->setCellValue('I'.$index, $tradein->getCustomerStatus());
                $sheet->setCellValue('J'.$index, $tradein->order_price);
                $sheet->setCellValue('K'.$index, $tradein->bamboo_price);
                $sheet->setCellValue('L'.$index, $tradein->bamboo_grade);
                $sheet->setCellValue('M'.$index, $tradein->getBambooStatus());
                $sheet->setCellValue('N'.$index, $fully_functional);
                $sheet->setCellValue('O'.$index, $faults_col);
                $sheet->setCellValue('P'.$index, $tradein->created_at);
                $sheet->setCellValue('Q'.$index, $tradein->updated_at);
                $sheet->setCellValue('R'.$index, $tradein->quarantine_date);
                $sheet->setCellValue('S'.$index, $tradein->customerName());
                $sheet->setCellValue('T'.$index, $quarantine);
                $sheet->setCellValue('U'.$index, $fimpOrGoogle);
                $sheet->setCellValue('V'.$index, $tradein->getTrayName($tradein->id));
            }
        }

        if(!is_dir(public_path() . '/reports/testing')){
            mkdir(public_path() . '/reports/testing', 0777, true);
        }

        $filename = 'testing_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/testing/' . $filename);

        return '/reports/testing/' . $filename;
    }

    public function recycleCustomerReturns(){
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Trade in ID');
        $sheet->setCellValue('B1', 'Trade in barcode');
        $sheet->setCellValue('C1', 'Model');
        $sheet->setCellValue('D1', 'Customer Name');
        $sheet->setCellValue('E1', 'Postcode');
        $sheet->setCellValue('F1', 'Address line 1');
        $sheet->setCellValue('G1', 'Fail reason');
        $sheet->setCellValue('H1', 'Quarantine reason');
        $sheet->setCellValue('I1', 'Customer Grade');
        $sheet->setCellValue('J1', 'Customer Grade After Testing');
        $sheet->setCellValue('K1', 'Bamboo Status');
        $sheet->setCellValue('L1', 'Tracking Reference');
        $sheet->setCellValue('M1', 'Return Date');

        $tradeins = Tradein::whereIn('job_state', ['19', '20', '21'])->get();

        foreach($tradeins as $key=>$tradein){

            $tradeinauditTPDespatched = TradeinAudit::where('tradein_id', $tradein->id)->where('customer_status', 'Trade Pack Despatched')->first();
            $tradeinauditReceived = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', '!=' ,'Not received yet.')->first();
            $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device has passed testing')->first();
            $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
            $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device Marked to return to customer')->first();
            if($tradeinauditTPDespatched === null){
                $tradeinauditTPDespatched = '';
            }
            else{
                $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
            }
            $tradeinauditUser = '';
            if($tradeinauditReceived === null){
                $tradeinauditReceived = '';
                $tradeinauditUser = '';
            }
            else{
                $tradeinauditUser = $tradeinauditReceived->getUser();
                $tradeinauditReceived = $tradeinauditReceived->created_at;
            }
            if($tradeinauditTested === null){
                $tradeinauditTested = '';
            }
            else{
                $tradeinauditTested = $tradeinauditTested->created_at;
            }
            if($tradeinauditBoxed === null){
                $tradeinauditBoxed = '';
            }
            else{
                $tradeinauditBoxed = $tradeinauditBoxed->created_at;
            }
            if($tradeinauditReturned === null){
                $tradeinauditReturned = '';
            }
            else{
                $tradeinauditReturned = $tradeinauditReturned->created_at->format('d.m.Y');
            }

            $testing_faults = [];
            $fully_functional = 'Yes';
            $faults_col = "";
            $testingFaults = TestingFaults::where('tradein_id', $tradein->id)->first();
            if($testingFaults !== null){
                $available_faults = [
                    "audio_test" => "Audio Test",
                    "front_microphone" => "Front Microphone",
                    "headset_test" => "Headset Test",
                    "loud_speaker_test" => "Loud Speaker Test",
                    "microphone_playback_test" => "Microphone Playback Test",
                    "buttons_test" => "Buttons Test",
                    "sensor_test" => "Sensor Test",
                    "camera_test" => "Camera Test",
                    "glass_condition" => "Glass Condition",
                    "vibration" => "Vibration",
                    "original_colour" => "Original Colour",
                    "battery_health" => "Battery Health",
                    "nfc" => "NFC",
                    "no_power" => "No Power",
                    "fake_missing_parts" => "Fake Missing Parts",
                ];

                foreach($available_faults as $fault => $text){
                    if($testingFaults[$fault] !== null){
                        array_push($testing_faults, $text);
                    }
                }
                $fully_functional = 'No';
            }

            if(count($testing_faults) > 1){
                $faults_col = implode(' / ', $testing_faults);
            } else {
                if(count($testing_faults) === 1){
                    $faults_col = $testing_faults[0];
                }
            }

            $index = $key+2;

            $sheet->setCellValue('A'.$index, $tradein->barcode_original);
            $sheet->setCellValue('B'.$index, $tradein->barcode);
            $sheet->setCellValue('C'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->customerName());
            $sheet->setCellValue('E'.$index, $tradein->postCode());
            $sheet->setCellValue('F'.$index, $tradein->addressLine());
            $sheet->setCellValue('G'.$index, $faults_col);
            $sheet->setCellValue('H'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('I'.$index, $tradein->customer_grade);
            $sheet->setCellValue('J'.$index, $tradein->bamboo_grade);
            $sheet->setCellValue('K'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('L'.$index, $tradein->tracking_reference);
            $sheet->setCellValue('M'.$index, $tradeinauditReturned);
        }
        

        if(!is_dir(public_path() . '/exports/recycle_customer_returns_')){
            mkdir(public_path() . '/exports/recycle_customer_returns_', 0777, true);
        }

        $filename = 'recycle_customer_returns_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/exports/recycle_customer_returns_/' . $filename);

        return '/exports/recycle_customer_returns_/' . $filename;
    }
}