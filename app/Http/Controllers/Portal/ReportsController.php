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

        $tradeins = Tradein::all()->groupBy('job_state');
        #dd($tradeins);

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

        $tradeins = Tradein::whereBetween('created_at', [$fromDate, $toDate])->get();

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
        $sheet->setCellValue('J1', 'Date passed');
        $sheet->setCellValue('K1', 'Time passed');
        $sheet->setCellValue('L1', 'Date Paid');
        $sheet->setCellValue('M1', 'Location');

        foreach($tradeins as $key=>$tradein){
            $index = $key+1;
            if($index === 1){
                $index = 2;
            }

            $sheet->setCellValue('A'.$index, $tradein->barcode);
            $sheet->setCellValue('B'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('C'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->cosmetic_condition);
            $sheet->setCellValue('E'.$index, $tradein->imei);
            $sheet->setCellValue('F'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('G'.$index, $tradein->carriage_cost);
            $sheet->setCellValue('H'.$index, $tradein->bamboo_price + $tradein->carriage_cost);
            $sheet->setCellValue('I'.$index, $tradein->created_at);
            $sheet->setCellValue('J'.$index, 'Date passed');
            $sheet->setCellValue('K'.$index, 'Time passed');
            $sheet->setCellValue('L'.$index, 'Date Paid');
            $sheet->setCellValue('M'.$index, $tradein->getTrayName($tradein->id));
        }


        if(!is_dir(public_path() . '/reports/purchased')){
            mkdir(public_path() . '/reports/purchased', 0777, true);
        }
        
        $filename = 'purchased_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/purchased/' . $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

    public function generateCurrentReport(Request $request){
        $tradeins = "";

        if($request->bamboo_status === 'all'){
            $tradeins = Tradein::all();
        }
        else{
            $tradeins = Tradein::where('job_state', $request->bamboo_status)->get();
        }

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
        $sheet->setCellValue('J1', 'Date passed');
        $sheet->setCellValue('K1', 'Time passed');
        $sheet->setCellValue('L1', 'Date Paid');
        $sheet->setCellValue('M1', 'Location');

        foreach($tradeins as $key=>$tradein){
            $index = $key+1;
            if($index === 1){
                $index = 2;
            }

            $sheet->setCellValue('A'.$index, $tradein->barcode);
            $sheet->setCellValue('B'.$index, $tradein->getBrandName($tradein->product_id));
            $sheet->setCellValue('C'.$index, $tradein->getProductName($tradein->product_id));
            $sheet->setCellValue('D'.$index, $tradein->cosmetic_condition);
            $sheet->setCellValue('E'.$index, $tradein->imei);
            $sheet->setCellValue('F'.$index, $tradein->bamboo_price);
            $sheet->setCellValue('G'.$index, $tradein->carriage_cost);
            $sheet->setCellValue('H'.$index, $tradein->bamboo_price + $tradein->carriage_cost);
            $sheet->setCellValue('I'.$index, $tradein->created_at);
            $sheet->setCellValue('J'.$index, 'Date passed');
            $sheet->setCellValue('K'.$index, 'Time passed');
            $sheet->setCellValue('L'.$index, 'Date Paid');
            $sheet->setCellValue('M'.$index, $tradein->getTrayName($tradein->id));
        }


        if(!is_dir(public_path() . '/reports/current')){
            mkdir(public_path() . '/reports/current', 0777, true);
        }
        
        $filename = 'current_report_' . \Carbon\Carbon::now()->format('Y_m_d_h_i') . '.xlsx';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . '/reports/current/' . $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function generateTransferReport(Request $request){
        dd($request);
    }

}
