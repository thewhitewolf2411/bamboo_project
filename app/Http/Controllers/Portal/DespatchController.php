<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\Despatch\DespatchedDevice;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DespatchService;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DespatchController extends Controller
{
    public $portalUser;

    public function __construct(){
        $this->middleware('checkAuth');
    }

    public function index(){
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
        return view('portal.despatch.index', ['portalUser' =>$portalUser]);
    }

    /**
     * Show devices for despatch.
     */
    public function showDespatchDevices(Request $request){
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
        $tradeins = collect();
        if(isset($request->search)){
            $searchterm = $request->search;
            $tradeins = Tradein::where('barcode', $searchterm)->where('job_state', '20')->orWhere('job_state', '19')->get();
        } else {
            $tradeins = Tradein::where('job_state', '20')->orWhere('job_state', '19')->get();
        }
        return view('portal.despatch.despatch', ['portalUser' => $portalUser, 'tradeins' => $tradeins]);
    }

    /**
     * Export list of devices in the module.
     */
    public function exportDevices(Request $request){
        if(isset($request->ids)){
            $ids = explode(',',$request->ids);

            $tradeins = Tradein::whereIn('id', $ids)->get();
            $spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Trade-in ID');
            $sheet->setCellValue('B1', 'Trade-in barcode number');
            $sheet->setCellValue('C1', 'Model');
            $sheet->setCellValue('D1', 'Customer name');
            $sheet->setCellValue('E1', 'Postcode');
            $sheet->setCellValue('F1', 'Address Line 1');
            $sheet->setCellValue('G1', 'Bamboo Status');
            $sheet->setCellValue('H1', 'Carrier');
            $sheet->setCellValue('I1', 'Tracking Reference');
            $row = 2;
            foreach($tradeins as $tradein){
                $sheet->setCellValue('A'.$row, $tradein->barcode);
                $sheet->setCellValue('B'.$row, $tradein->barcode_original);
                $sheet->setCellValue('C'.$row, $tradein->getProductName($tradein->id));
                $sheet->setCellValue('D'.$row, $tradein->customerName());
                $sheet->setCellValue('E'.$row, $tradein->postCode());
                $sheet->setCellValue('F'.$row, $tradein->addressLine());
                $sheet->setCellValue('G'.$row, $tradein->getBambooStatus());
                $sheet->setCellValue('H'.$row, 'Royal Mail');
                $sheet->setCellValue('I'.$row, $tradein->tracking_reference);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="despatch_export.xlsx"');
            $writer->save('php://output');
        }
    }

    /**
     * Despatch devices to RM C&D.
     */
    public function despatchDevices(Request $request){
        if(isset($request->despatch_ids)){
            $ids = $request->despatch_ids;
            $tradeins = Tradein::whereIn('id', $ids)->get();

            if($tradeins->count() > 0){
                $despatchService = new DespatchService();
                $result = $despatchService->despatchDevices($tradeins);
                return response($result);
            }
        }
    }

    /**
     * Show devices that were dispatched
     */
    public function showArchive(){
        $despatched = DespatchedDevice::all();
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
        return view('portal.despatch.archive', ['despatched' => $despatched ,'portalUser' => $portalUser]);
    }


    /**
     * Export dispatch archive.
     */
    public function exportArchive(){
            $devices = DespatchedDevice::all();
            if($devices->count() < 1){
                return;
            }
            $spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Trade-in ID');
            $sheet->setCellValue('B1', 'Order Identifier');
            $sheet->setCellValue('C1', 'Order Reference');
            $sheet->setCellValue('D1', 'Order Date');
            $row = 2;
            foreach($devices as $device){
                $sheet->setCellValue('A'.$row, $device->getTradeinId());
                $sheet->setCellValue('B'.$row, $device->order_identifier);
                $sheet->setCellValue('C'.$row, $device->order_reference);
                $sheet->setCellValue('D'.$row, $device->order_date);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="despatch_archive_export.xlsx"');
            $writer->save('php://output');
        
    }
}
