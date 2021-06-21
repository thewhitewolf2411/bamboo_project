<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Services\Reports;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showReportsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.reports')->with('portalUser', $portalUser);
    }


    public function showReportsOverviewPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::all();

        return view('portal.reports.overview', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }

    public function showReportsStockPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.stock', ['portalUser'=>$portalUser]);
    }

    public function showReportsReceivingPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.receiving', ['portalUser'=>$portalUser]);
    }

    public function showReportsTestingPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.testing', ['portalUser'=>$portalUser]);
    }

    public function showReportsAwaitingPaymentPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.awaiting-payment', ['portalUser'=>$portalUser]);
    }

    public function showReportsRecycleCustomerReturnsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.recycle-customer-returns', ['portalUser'=>$portalUser]);
    }

    public function showReportsFinanceRecycleReportsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $awaitingTradePack = Tradein::where('job_state', 1)->get();
        $awaitingReceipt = Tradein::whereIn('job_state', [2,3])->get();
        $notReceived = Tradein::whereIn('job_state', [4,5])->get();
        $noImei = Tradein::where('job_state', 6)->get();
        $blacklisted = Tradein::whereIn('job_state', ["7", "8a", "8b", "8c", "8d", "8e", "8f"])->get();
        $awaitingTesting = Tradein::where('job_state', 9)->get();
        $testComplete = Tradein::whereIn('job_state', ["10", "12", "16"])->get();
        $testingQuarantine = Tradein::whereIn('job_state', ["11", "11a", "11b", "11c", "11d", "11e", "11f", "11g", "11h", "11i", "11j", "15", "15a", "15b", "15c", "15d", "15e", "15f", "15g", "15h", "15i", "15j"])->get();
        $destroyedDevices = Tradein::whereIn('job_state', [17, 18])->get();
        $returnToCustomer = Tradein::whereIn('job_state', [19, 20, 21])->get();
        $awaitingBoxBuild = Tradein::whereIn('job_state', [22,23,24,25])->get();

        #dd($testingQuarantine);

        $tradeins = ['Awaiting Trade Pack'=>$awaitingTradePack, 'Awaiting Receipt'=>$awaitingReceipt, 'Not Received'=>$notReceived, 
                    'No Imei'=>$noImei, 'Blacklisted'=>$blacklisted, 'Awaiting Testing'=>$awaitingTesting, 
                    'Test Complete'=>$testComplete, 'Testing Quarantine'=>$testingQuarantine, 'Destroyed Devices'=>$destroyedDevices, 
                    'Return To Customer'=>$returnToCustomer, 'Awaiting Box Build'=>$awaitingBoxBuild];

        return view('portal.reports.finance-recycle-reports', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }


    public function generateOverviewReport(Request $request){
        
        $reports = new Reports();

        $file = $reports->overviewReport($request);
        #dd($file);

        return response($file, 200);

    }

    public function generateStockReport(Request $request){
        $reports = new Reports();

        $file = $reports->stockReport($request);
        #dd($file);

        return response($file, 200);
    }

    public function generateReceivingReport(Request $request){
        $reports = new Reports();

        $file = $reports->receivingReport($request);
        #dd($file);

        return response($file, 200);
    }

    public function generateTestingReport(Request $request){

        $reports = new Reports();

        $file = $reports->testingReport($request);

        return response($file, 200);
    }

    public function generateRecycleCustomerReturnsReport(){
        $reports = new Reports();

        $file = $reports->recycleCustomerReturns();

        return response($file, 200);
    }

    public function generatePurchasedReport(Request $request){

        $fromDate = \Carbon\Carbon::parse($request->from);
        $toDate = \Carbon\Carbon::parse($request->to);

        $toDate = $toDate->addDay();

        $tradeins = Tradein::whereBetween('created_at', [$fromDate, $toDate])->whereIn('job_state', ['25', '26', '27', '28', '29'])->get();
       # dd($tradeins);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Order ref');
        $sheet->setCellValue('B1', 'Trade-in ID');
        $sheet->setCellValue('C1', 'Make');
        $sheet->setCellValue('D1', 'Model');
        $sheet->setCellValue('E1', 'Grade');
        $sheet->setCellValue('F1', 'IMEI');
        $sheet->setCellValue('G1', 'Cost');
        $sheet->setCellValue('H1', 'Carriage');
        $sheet->setCellValue('I1', 'Total Cost');
        $sheet->setCellValue('J1', 'Date in');
        $sheet->setCellValue('K1', 'Date passed');
        $sheet->setCellValue('L1', 'Time passed');
        $sheet->setCellValue('M1', 'Date Paid');
        $sheet->setCellValue('N1', 'Location');

        $index = 2;
        foreach($tradeins as $key=>$tradein){
            

            $sheet->setCellValue('A'.$index, $tradein->barcode_original);
            $sheet->setCellValue('B'.$index, $tradein->barcode);
            $sheet->setCellValue('C'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('E'.$index, $tradein->cosmetic_condition);
            $sheet->setCellValue('F'.$index, ($tradein->imei_number === null) ? $tradein->serial_number : $tradein->imei_number);
            $sheet->setCellValue('G'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('H'.$index, $tradein->carriage_cost);
            $sheet->setCellValue('I'.$index, $tradein->getDeviceCost());
            $sheet->setCellValue('J'.$index, \Carbon\Carbon::parse($tradein->created_at)->format('d/m/y'));
            $sheet->setCellValue('K'.$index, $tradein->getDatePassed());
            $sheet->setCellValue('L'.$index, $tradein->getTimePassed());
            $sheet->setCellValue('M'.$index, $tradein->getDatePaid());
            $sheet->setCellValue('N'.$index, $tradein->getTrayName($tradein->id));
            $index++;
        }


        if(!is_dir(public_path() . '/reports/purchased')){
            //mkdir(public_path() . '/reports/purchased', 0777, true);
        }
        
        $filename = 'purchased_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        //$writer->save(public_path() . '/reports/purchased/' . $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

    public function generateCurrentReport(Request $request){

        #dd($request->all());

        $tradeins = "";

        switch($request->bamboo_status){
            case 'all':
                $tradeins = Tradein::all();
                break;
            case 'Awaiting Trade Pack':
                $tradeins = Tradein::where('job_state', 1)->get();
                break;
            case 'Awaiting Receipt':
                $tradeins = Tradein::whereIn('job_state', [2,3])->get();
                break;
            case 'Not Received':
                $tradeins = Tradein::whereIn('job_state', [4,5])->get();
                break;
            case 'No Imei':
                $tradeins = Tradein::where('job_state', 6)->get();
                break;
            case 'Blacklisted':
                $tradeins = Tradein::whereIn('job_state', ["7", "8a", "8b", "8c", "8d", "8e", "8f"])->get();
                break;
            case 'Awaiting Testing':
                $tradeins = Tradein::where('job_state', 9)->get();
                break;
            case 'Test Complete':
                $tradeins = Tradein::whereIn('job_state', ["10", "12", "16"])->get();
                break;
            case 'Testing Quarantine':
                $tradeins = Tradein::whereIn('job_state', ["11", "11a", "11b", "11c", "11d", "11e", "11f", "11g", "11h", "11i", "11j", "15", "15a", "15b", "15c", "15d", "15e", "15f", "15g", "15h", "15i", "15j"])->get();
                break;
            case 'Destroyed Devices':
                $tradeins = Tradein::whereIn('job_state', [17, 18])->get();
                break;
            case 'Return To Customer':
                $tradeins = Tradein::whereIn('job_state', [19, 20, 21])->get();
                break;
            case 'Awaiting Box Build':
                $tradeins = Tradein::whereIn('job_state', [22,23,24,25])->get();
                break;
            default:
                $tradeins = Tradein::all();
                break;
        }

        #dd($tradeins);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Order ref');
        $sheet->setCellValue('B1', 'Make');
        $sheet->setCellValue('C1', 'Model');
        $sheet->setCellValue('D1', 'Grade');
        $sheet->setCellValue('E1', 'IMEI');
        $sheet->setCellValue('F1', 'Cost');
        $sheet->setCellValue('G1', 'Carriage');
        $sheet->setCellValue('H1', 'Total Cost');
        $sheet->setCellValue('I1', 'Date in');
        $sheet->setCellValue('J1', 'Status');
        $sheet->setCellValue('K1', 'Time in status');
        $sheet->setCellValue('L1', 'Location');

        $index = 2;

        foreach($tradeins as $key=>$tradein){

            $sheet->setCellValue('A'.$index, $tradein->barcode);
            $sheet->setCellValue('B'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('C'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->getDeviceBambooGrade());
            $sheet->setCellValue('E'.$index, ($tradein->imei_number === null) ? $tradein->serial_number : $tradein->imei_number);
            $sheet->setCellValue('F'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('G'.$index, $tradein->carriage_cost);
            $sheet->setCellValue('H'.$index, $tradein->getDeviceCost());
            $sheet->setCellValue('I'.$index, $tradein->created_at);
            $sheet->setCellValue('J'.$index, $tradein->getBambooStatus());
            $sheet->setCellValue('K'.$index, $tradein->getTimeIn());
            $sheet->setCellValue('L'.$index, $tradein->getTrayName($tradein->id));

            $index++;
        }


        if(!is_dir(public_path() . '/reports/current')){
            //mkdir(public_path() . '/reports/current', 0777, true);
        }
        
        $filename = 'current_report_[' . $request->bamboo_status . ']';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        //$writer->save(public_path() . '/reports/current/' . $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function generateTransferReport(Request $request){
        dd($request);
    }

}
