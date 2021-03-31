<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\Despatch\DespatchedDevice;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DespatchService;
use App\Services\NotificationService;
use Carbon\Carbon;
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
    public function requestDespatch(Request $request){
        if(isset($request->despatch_ids)){
            $ids = explode(",",$request->despatch_ids);
            $tradeins = Tradein::whereIn('id', $ids)->get();

            if($tradeins->count() > 0){
                $despatchService = new DespatchService();
                $result = $despatchService->requestDespatch($tradeins);

                $messages = [];
                if(!empty($result['error'])){
                    $messages['error'] = $result['error'];
                }
                if(!empty($result['success'])){
                    $messages['success'] = $result['success'];
                }
                if(!empty($result['info'])){
                    $messages['info'] = $result['info'];
                }
                return redirect()->back()->with('messages', $messages);
            }
        }
    }

    public function confirmDespatch(Request $request){
        $error = [];
        $success = [];
        $notificationService = new NotificationService();
        if(isset($request->despatch_ids)){
            
            $ids = explode(',', $request->despatch_ids);
            $tradeins = Tradein::whereIn('id', $ids)->get();

            if($tradeins->count() > 0){
                foreach($tradeins as $tradein){
                    $despatchDevice = DespatchedDevice::where('tradein_id', $tradein->id)->first();
                    if($tradein->job_state === '20' && $despatchDevice !== null){
                        if($tradein->tracking_reference !== null){
                            $despatchDevice->despatched_at = Carbon::now();
                            $despatchDevice->save();
                            $tradein->job_state = '21';
                            $tradein->save();
                            array_push($success, 'Tradein ' . $tradein->barcode . ' despatch confirmed succesfully.');

                            // send notification - device despathed
                            $notificationService->sendDespatched($tradein);
                        } else {
                            array_push($error, 'Tradein ' . $tradein->barcode . ' not manifested yet.');
                        }

                    } else {
                        array_push($error, 'Tradein ' . $tradein->barcode . ' first needs to be requested for despatch.');
                    }
                }
            }
        } else {
            $error = ['Selected devices were not manifested yet.'];
        }
        
        $messages = [];
        if(!empty($error)){
            $messages['error'] = $error;
        }
        if(!empty($success)){
            $messages['success'] = $success;
        }
        return redirect()->back()->with('messages', $messages);
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
            $sheet->setCellValue('B1', 'Trade-in barcode number');
            $sheet->setCellValue('C1', 'Model');
            $sheet->setCellValue('D1', 'Customer Name');
            $sheet->setCellValue('E1', 'Postcode');
            $sheet->setCellValue('F1', 'Address Line 1');
            $sheet->setCellValue('G1', 'Bamboo Status');
            $sheet->setCellValue('H1', 'Carrier');
            $sheet->setCellValue('I1', 'Tracking Reference');

            $row = 2;
            foreach($devices as $device){
                $sheet->setCellValue('A'.$row, $device->getTradeinId());
                $sheet->setCellValue('B'.$row, $device->getTradeinBarcode());
                $sheet->setCellValue('C'.$row, $device->getModel());
                $sheet->setCellValue('D'.$row, $device->getCustomer());
                $sheet->setCellValue('E'.$row, $device->getPostCode());
                $sheet->setCellValue('F'.$row, $device->getAddressLine());
                $sheet->setCellValue('G'.$row, $device->getBambooStatus());
                $sheet->setCellValue('H'.$row, $device->getCarrier());
                $sheet->setCellValue('I'.$row, $device->getTrackingReference());

                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="despatch_archive_export.xlsx"');
            $writer->save('php://output');
        
    }
}
