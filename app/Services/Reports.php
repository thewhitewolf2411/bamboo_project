<?php 
namespace App\Services;

use App\Audits\TradeinAudit;
use App\Eloquent\AdditionalCosts;
use App\Eloquent\Tradein;
use Schema;

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

            $sheet->setCellValue('A'.$index, $tradein->barcode_original);
            $sheet->setCellValue('B'.$index, $tradein->barcode);
            $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('E'.$index, $tradein->imei_number);
            $sheet->setCellValue('F'.$index, $correctMemory);
            $sheet->setCellValue('G'.$index, '');
            $sheet->setCellValue('H'.$index, $tradein->order_price);
            $sheet->setCellValue('I'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('J'.$index, $additionalCosts->administration_costs);
            $sheet->setCellValue('K'.$index, $additionalCosts->carriage_costs + $additionalCosts->miscellaneous_costs_individual);
            $sheet->setCellValue('L'.$index, $tradein->bamboo_price + $additionalCosts->administration_costs + $additionalCosts->carriage_costs + $additionalCosts->miscellaneous_costs_individual);
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
                $sheet->setCellValue('G'.$index, '');
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
        #$sheet->setCellValue('G1', 'Colour');
        $sheet->setCellValue('H1', 'Customer Grade');
        #$sheet->setCellValue('I1', 'Customer Grade after testing');
        #$sheet->setCellValue('J1', 'Bamboo Grade');
        #$sheet->setCellValue('K1', 'Customer Status');
        #$sheet->setCellValue('L1', 'Bamboo Status');
        #$sheet->setCellValue('M1', 'Fully Functional');
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
                $sheet->setCellValue('G'.$index, '');
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

        if(!is_dir(public_path() . '/reports/receiving')){
            mkdir(public_path() . '/reports/receiving', 0777, true);
        }

        $filename = 'receiving_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/receiving/' . $filename);

        return '/reports/receiving/' . $filename;
    }

}