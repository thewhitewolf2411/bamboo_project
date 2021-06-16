<?php 
namespace App\Services;

use App\Audits\TradeinAudit;
use App\Eloquent\AdditionalCosts;
use App\Eloquent\TestingFaults;
use App\Eloquent\Tradein;
use Illuminate\Http\Request;
use Schema;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;
class Reports{

    public function overviewReport(Request $request){

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
        $sheet->setCellValue('L1', 'Miscellaneous');
        $sheet->setCellValue('M1', 'Total');
        $sheet->setCellValue('N1', 'Customer Grade');
        $sheet->setCellValue('O1', 'Customer Grade after testing');
        $sheet->setCellValue('P1', 'Bamboo Grade');
        $sheet->setCellValue('Q1', 'Customer Status');
        $sheet->setCellValue('R1', 'Bamboo Status');
        $sheet->setCellValue('S1', 'Fully Functional');
        $sheet->setCellValue('T1', 'Date Order Placed');
        $sheet->setCellValue('U1', 'TP Despatch Date');
        $sheet->setCellValue('V1', 'Date Received');
        $sheet->setCellValue('W1', 'Expiry Date');
        $sheet->setCellValue('X1', 'Date Tested');
        $sheet->setCellValue('Y1', 'Return Date');
        $sheet->setCellValue('Z1', 'Quarantine Date');
        $sheet->setCellValue('AA1', 'Quarantine Reason');
        $sheet->setCellValue('AB1', 'Box Date');
        $sheet->setCellValue('AC1', 'Processor Name');
        $sheet->setCellValue('AD1', 'Quarantine');
        $sheet->setCellValue('AE1', 'FMIP');
        $sheet->setCellValue('AF1', 'Stock Location');
        $sheet->setCellValue('AG1', 'Paid Date');
        $sheet->setCellValue('AH1', 'Cancellation Date');
        $sheet->setCellValue('AI1', 'Sales Lot Number');

        $from = "";
        $to = "";
        if(isset($request->from) && isset($request->to)){
            $from = \Carbon\Carbon::parse($request->from);
            $to = \Carbon\Carbon::parse($request->to);
            $to->addDay();
        }

        $tradeins = "";

        if(isset($request->from) && isset($request->to)){
            $tradeins = Tradein::whereBetween('created_at', [$from, $to])->get();
        }
        else{
            $tradeins = Tradein::all();
        }
        
        $additionalCosts = AdditionalCosts::first();

        foreach($tradeins as $key=>$tradein){

            $correctMemory = '';
            if($tradein->correct_network === null){
                $correctMemory = $tradein->customer_network;
            }
            else{
                $correctMemory = $tradein->correct_network;
            }

            $fullyFunctional = $tradein->fullyFunctional();

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
            $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Test Complete')->first();
            $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
            $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
            if($tradeinauditTPDespatched === null){
                $tradeinauditTPDespatched = '';
            }
            else{
                if($tradein->trade_pack_send_by_customer){
                    $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
                }
                $tradeinauditTPDespatched = 'N/A';
                
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
                if($tradein->isBoxed()){
                    $tradeinauditBoxed = $tradeinauditBoxed->created_at;
                }
                else{
                    $tradeinauditBoxed = '';
                }
            }
            if($tradeinauditReturned === null){
                $tradeinauditReturned = '';
            }
            else{
                $tradeinauditReturned = $tradeinauditReturned->created_at;
            }

            $index = $key+2;

            $number = "";

            if($tradein->imei_number === null){
                $number = $tradein->serial_number;
            }
            else{
                $number = $tradein->imei_number;
            }

            $sheet->setCellValue('A'.$index, $tradein->barcode_original);
            $sheet->setCellValue('B'.$index, $tradein->barcode);
            $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('E'.$index, $number);
            $sheet->setCellValue('F'.$index, $correctMemory);
            $sheet->setCellValue('G'.$index, $tradein->product_colour);
            $sheet->setCellValue('H'.$index, '£' . $tradein->order_price);
            $sheet->setCellValue('I'.$index, '£' . $tradein->bamboo_price);
            $sheet->setCellValue('J'.$index, '£' . $tradein->admin_cost);
            $sheet->setCellValue('K'.$index, '£' . $tradein->carriage_cost);
            $sheet->setCellValue('L'.$index, '£' . $tradein->getDeviceMiscCost());
            $sheet->setCellValue('M'.$index, '£' . $tradein->getDeviceCost());
            $sheet->setCellValue('N'.$index, $tradein->customer_grade);
            $sheet->setCellValue('O'.$index, $tradein->bamboo_grade);
            $sheet->setCellValue('P'.$index, $tradein->getDeviceBambooGrade());
            $sheet->setCellValue('Q'.$index, $tradein->getCustomerStatus());
            $sheet->setCellValue('R'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('S'.$index, $fullyFunctional);
            $sheet->setCellValue('T'.$index, $tradein->created_at);
            $sheet->setCellValue('U'.$index, $tradeinauditTPDespatched);
            $sheet->setCellValue('V'.$index, $tradeinauditReceived);
            $sheet->setCellValue('W'.$index, $tradein->expiry_date);
            $sheet->setCellValue('X'.$index, $tradeinauditTested);
            $sheet->setCellValue('Y'.$index, $tradeinauditReturned);
            $sheet->setCellValue('Z'.$index, $tradein->quarantine_date);
            $sheet->setCellValue('AA'.$index, $tradein->quarantineReason());
            $sheet->setCellValue('AB'.$index, $tradeinauditBoxed);
            $sheet->setCellValue('AC'.$index, $tradeinauditUser);
            $sheet->setCellValue('AD'.$index, $quarantine);
            $sheet->setCellValue('AE'.$index, $fimp);
            $sheet->setCellValue('AF'.$index, $tradein->getTrayName($tradein->id));
            $sheet->setCellValue('AG'.$index, $tradein->getDatePaid());
            $sheet->setCellValue('AH'.$index, $tradein->getCancellationDate());
            $sheet->setCellValue('AI'.$index, $tradein->getSalesLotNumber());
        }

        if(!is_dir(public_path() . '/reports/overview')){
           //mkdir(public_path() . '/reports/overview', 0777, true);
        } 

        $filename = 'overview_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        //$writer->save(public_path() . '/reports/overview/' . $filename);

        #return '/reports/overview/' . $filename;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function stockReport(Request $request){
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
        $sheet->setCellValue('X1', 'Box Name');

        $from = "";
        $to = "";
        if(isset($request->from) && isset($request->to)){
            $from = \Carbon\Carbon::parse($request->from);
            $to = \Carbon\Carbon::parse($request->to)->addDay();
        }

        $tradeins = "";

        if(isset($request->from) && isset($request->to)){
            $tradeins = Tradein::whereBetween('created_at', [$from, $to])->get();
        }
        else{
            $tradeins = Tradein::all();
        }
        $additionalCosts = AdditionalCosts::first();

        $i=2;
        foreach($tradeins as $key=>$tradein){

            if($tradein->isBoxed()){

                $correctMemory = '';
                if($tradein->correct_network === null){
                    $correctMemory = $tradein->customer_network;
                }
                else{
                    $correctMemory = $tradein->correct_network;
                }

                $fullyFunctional = $tradein->fullyFunctional();

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
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Test Complete')->first();
                $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
                $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Device requested by customer')->first();
                if($tradeinauditTPDespatched === null){
                    $tradeinauditTPDespatched = '';
                }
                else{
                    if($tradein->trade_pack_send_by_customer){
                        $tradeinauditTPDespatched = $tradeinauditTPDespatched->created_at;
                    }
                    else{
                        $tradeinauditTPDespatched = 'N/A';
                    }
                    
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

                $number = "";

                if($tradein->imei_number === null){
                    $number = $tradein->serial_number;
                }
                else{
                    $number = $tradein->imei_number;
                }
    

                #$index = $key+2;

                $sheet->setCellValue('A'.$i, $tradein->barcode_original);
                $sheet->setCellValue('B'.$i, $tradein->barcode);
                $sheet->setCellValue('C'.$i, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$i, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValue('E'.$i, $number);
                $sheet->setCellValue('F'.$i, $correctMemory);
                $sheet->setCellValue('G'.$i, $tradein->product_colour);
                $sheet->setCellValue('H'.$i, $tradein->customer_grade);
                $sheet->setCellValue('I'.$i, $tradein->bamboo_grade);
                $sheet->setCellValue('J'.$i, $tradein->getDeviceBambooGrade());
                $sheet->setCellValue('K'.$i, $tradein->getCustomerStatus());
                $sheet->setCellValue('L'.$i, $tradein->getBambooStatus());
                $sheet->setCellValue('M'.$i, $fullyFunctional);
                $sheet->setCellValue('N'.$i, $tradein->created_at);
                $sheet->setCellValue('O'.$i, $tradeinauditTPDespatched);
                $sheet->setCellValue('P'.$i, $tradeinauditReceived);
                $sheet->setCellValue('Q'.$i, $tradeinauditTested);
                $sheet->setCellValue('R'.$i, $tradein->quarantine_date);
                $sheet->setCellValue('S'.$i, $tradeinauditBoxed);
                $sheet->setCellValue('T'.$i, $tradeinauditUser);
                $sheet->setCellValue('U'.$i, $quarantine);
                $sheet->setCellValue('V'.$i, $fimp);
                $sheet->setCellValue('W'.$i, $tradein->getStockLocation());
                $sheet->setCellValue('X'.$i, $tradein->getBoxName());

                $i++;
            }
        }

        if(!is_dir(public_path() . '/reports/stock')){
            //mkdir(public_path() . '/reports/stock', 0777, true);
        }

        $filename = 'stock_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        #$writer->save(public_path() . '/reports/stock/' . $filename);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        $writer->save('php://output');

        #return '/reports/stock/' . $filename;
    }

    public function receivingReport(Request $request){
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

        $from = "";
        $to = "";
        if(isset($request->from) && isset($request->to)){
            $from = \Carbon\Carbon::parse($request->from);
            $to = \Carbon\Carbon::parse($request->to);
            $to->addDay();
        }

        $tradeins = "";

        if(isset($request->from) && isset($request->to)){
            $tradeins = Tradein::whereBetween('created_at', [$from, $to])->get();
        }
        else{
            $tradeins = Tradein::all();
        }

        $i = 2;
        foreach($tradeins as $key=>$tradein){

            if($tradein->hasDeviceBeenReceived()){

                $correctNetwork = '';
                if($tradein->correct_network === null){
                    $correctNetwork = $tradein->customer_network;
                }
                else{
                    $correctNetwork = $tradein->correct_network;
                }

                $fullyFunctional = $tradein->fullyFunctional();

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
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Test Complete')->first();
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

                $number = "";

                if($tradein->imei_number === null){
                    $number = $tradein->serial_number;
                }
                else{
                    $number = $tradein->imei_number;
                }
    

                #$index = $key+2;

                $sheet->setCellValue('A'.$i, $tradein->barcode_original);
                $sheet->setCellValue('B'.$i, $tradein->barcode);
                $sheet->setCellValue('C'.$i, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$i, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValue('E'.$i, $number);
                $sheet->setCellValue('F'.$i, $correctNetwork);
                $sheet->setCellValue('G'.$i, $tradein->customer_grade);
                $sheet->setCellValue('H'.$i, $tradein->created_at);
                $sheet->setCellValue('I'.$i, $tradeinauditTPDespatched);
                $sheet->setCellValue('J'.$i, $tradeinauditReceived);
                if($tradein->isBlackListed()){
                    $sheet->setCellValue('K'.$i, '0');
                }
                else{
                    $sheet->setCellValue('K'.$i, $tradein->order_price);
                }
                $sheet->setCellValue('L'.$i, $tradein->admin_cost);
                $sheet->setCellValue('M'.$i, $tradein->carriage_cost);
                $sheet->setCellValue('N'.$i, $tradein->quarantine_date);
                $sheet->setCellValue('O'.$i, $tradein->getTrayName($tradein->id));
                $sheet->setCellValue('P'.$i, $tradein->getLastProcessorName());

                $i++;
            }
        }

        if(!is_dir(public_path() . '/reports/receiving')){
            //mkdir(public_path() . '/reports/receiving', 0777, true);
        }

        $filename = 'receiving_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        #$writer->save(public_path() . '/reports/receiving/' . $filename);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function testingReport(Request $request){

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

        $from = "";
        $to = "";
        if(isset($request->from) && isset($request->to)){
            $from = \Carbon\Carbon::parse($request->from);
            $to = \Carbon\Carbon::parse($request->to);
            $to->addDay();
        }

        $tradeins = "";

        if(isset($request->from) && isset($request->to)){
            $tradeins = Tradein::whereBetween('created_at', [$from, $to])->get();
        }
        else{
            $tradeins = Tradein::all();
        }

        $additionalCosts = AdditionalCosts::first();

        $i=2;

        foreach($tradeins as $key=>$tradein){

            if($tradein->hasBeenTested()){

                $correct_network = '';
                if($tradein->correct_network === null){
                    $correct_network = $tradein->customer_network;
                }
                else{
                    $correct_network = $tradein->correct_network;
                }

                $fullyFunctional = $tradein->fullyFunctional();

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
                $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Test Complete')->first();
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
                        "knox_removed"=>"Knox Removed"
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

                $number = "N/A";

                if($tradein->imei_number === null){
                    $number = $tradein->serial_number;
                }
                else{
                    $number = $tradein->imei_number;
                }

                $sheet->setCellValue('A'.$i, $tradein->barcode_original);
                $sheet->setCellValue('B'.$i, $tradein->barcode);
                $sheet->setCellValue('C'.$i, $tradein->getBrandName($tradein->product_id));
                $sheet->setCellValue('D'.$i, $tradein->getProductName($tradein->product_id));
                $sheet->setCellValueExplicit('E'.$i, (string)$number, DataType::TYPE_STRING);
                $sheet->setCellValue('F'.$i, $correct_network);
                $sheet->setCellValue('G'.$i, $tradein->product_colour);
                $sheet->setCellValue('H'.$i, $tradein->customer_grade);
                $sheet->setCellValue('I'.$i, $tradein->getCustomerGradeAfterTesting());
                $sheet->setCellValue('J'.$i, $tradein->order_price);
                $sheet->setCellValue('K'.$i, $tradein->bamboo_price);
                $sheet->setCellValue('L'.$i, $tradein->getDeviceBambooGrade());
                $sheet->setCellValue('M'.$i, $tradein->getBambooStatus());
                $sheet->setCellValue('N'.$i, $fully_functional);
                $sheet->setCellValue('O'.$i, $faults_col);
                $sheet->setCellValue('P'.$i, $tradein->created_at);
                $sheet->setCellValue('Q'.$i, $tradein->updated_at);
                $sheet->setCellValue('R'.$i, $tradein->quarantine_date);
                $sheet->setCellValue('S'.$i, $tradein->customerName());
                $sheet->setCellValue('T'.$i, $quarantine);
                $sheet->setCellValue('U'.$i, $fimpOrGoogle);
                $sheet->setCellValue('V'.$i, $tradein->getTrayName($tradein->id));

                $i++;
            }
        }

        if(!is_dir(public_path() . '/reports/testing')){
            //mkdir(public_path() . '/reports/testing', 0777, true);
        }

        $filename = 'testing_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        #$writer->save(public_path() . '/reports/testing/' . $filename);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
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
            $tradeinauditTested = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Test Complete')->first();
            $tradeinauditBoxed = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Awaiting Box build')->first();
            $tradeinauditReturned = TradeinAudit::where('tradein_id', $tradein->id)->where('bamboo_status', 'Return to customer')->first();
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
                    "knox_removed"=>"Knox Removed"
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
            //mkdir(public_path() . '/exports/recycle_customer_returns_', 0777, true);
        }

        $filename = 'recycle_customer_returns_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/exports/recycle_customer_returns_/' . $filename);

        return '/exports/recycle_customer_returns_/' . $filename;
    }
}