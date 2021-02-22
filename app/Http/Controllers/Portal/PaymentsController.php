<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Payment\PaymentBatch;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Payment\BatchDeviceEmail;
use App\Services\BatchService;
use App\Services\KlaviyoEmail;
use App\Services\PaymentBatchService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showPaymentPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.payments')->with('portalUser', $portalUser);
    }


    /**
     * Show awaiting payments.
     */
    public function showAwaitingPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        
        $trolleys = null;
        $trays = null;

        // search by id / barcode
        if(isset(request()->search)){

            // get tradein by barcode / tradein id
            $tradeins_ids_collection = Tradein::where('barcode', request()->search)->where('job_state','=','10')->orWhere('job_state', '=', '16')->get();
            $tradein_ids = $tradeins_ids_collection->pluck('id')->toArray();

            $tradeins = Tradein::where('barcode', request()->search)->orWhere('barcode_original', request()->search)
                ->where(function($query){
                    $query->where('job_state','=','10')->orWhere('job_state', '=', '12')->orWhere('job_state', '=', '16');
                })->get();

            
            // get tray content containing tradein
            $trays_content = TrayContent::whereIn('trade_in_id', $tradein_ids)->get();
            $tray_ids = $trays_content->pluck('tray_id')->toArray();

            // get trays by tray id
            $trays = Tray::whereIn('id', $tray_ids)
            ->where(function($query){
                $query->where('tray_name', 'like', 'TA%')
                ->orWhere('tray_name', 'like', 'TS%')
                ->orWhere('tray_name', 'like', 'TH%')
                ->orWhere('tray_name', 'like', 'TM%');
            })->get();

            // get trolleys that hold trays
            $trolley_ids = $trays->pluck('trolley_id')->toArray();

            $trolleys = Trolley::whereIn('id', $trolley_ids)
            ->where(function($query){
                $query->where('trolley_name', 'like', 'TA%')
                ->orWhere('trolley_name', 'like', 'TS%')
                ->orWhere('trolley_name', 'like', 'TH%')
                ->orWhere('trolley_name', 'like', 'TM%');
            })->get();

        } else {

            // get trolleys
            $trolleys = Trolley::where('trolley_name', 'like', 'TA%')
                ->orWhere('trolley_name', 'like', 'TS%')
                ->orWhere('trolley_name', 'like', 'TH%')
                ->orWhere('trolley_name', 'like', 'TM%')
            ->get();

            // get trays
            $trays = Tray::where('number_of_devices', '>', "0")->where(function($query){
                    $query->where('tray_name', 'like', 'TA%')
                    ->orWhere('tray_name', 'like', 'TS%')
                    ->orWhere('tray_name', 'like', 'TH%')
                    ->orWhere('tray_name', 'like', 'TM%');
            })->get();

            // get devices
            $tradeins = Tradein::where('job_state','=','10')->orWhere('job_state', '=', '12')->orWhere('job_state', '=', '16')->get();
        }

        $num_ref = PaymentBatch::where('batch_type', 1)->get()->count() + 1;
        if(strlen($num_ref) < 2){
            $num_ref = '0'.$num_ref;
        }
        $num_ref = "SP-".$num_ref;

        return view('portal.payments.awaiting', [
            'portalUser' => $portalUser,
            'trolleys' => $trolleys,
            'trays' => $trays,
            'tradeins' => $tradeins,
            'batch_ref' => $num_ref
        ]);
    }

    /**
     * Search for tradeins by barcode (for batch).
     * 
     * @param string $barcode
     */
    public function searchForTradeins(string $barcode){
        if($barcode){
            $tradeins = Tradein::where(function ($query) use($barcode){
                    $query->where('barcode', $barcode)->orWhere('barcode_original', $barcode);
                })->where(function($query){
                    $query->where('job_state', '=', "10")->orWhere('job_state', '=', "16");
                })->get();
                
            foreach($tradeins as $tradein){
                $tradein->model = $tradein->getProductName($tradein->id);
            }
            return $tradeins;
        }
    }

    /**
     * Search for trolley/tray devices or devices barcode.
     */
    public function searchForDevices(Request $request){
        if(isset($request->term) && isset($request->option)){
            $searchterm = $request->term;
            $searchoption = $request->option;

            //$devices = collect();
            switch ($searchoption) {
                case 'trolley':
                    $trolleys = Trolley::where('trolley_name', 'LIKE', "%{$searchterm}%")->get()->pluck('id')->toArray();
                    $trolley_content = TrolleyContent::whereIn('tray_id', $trolleys)->get()->pluck('tray_id')->toArray();
                    $trays = TrayContent::whereIn('tray_id', $trolley_content)->get()->pluck('trade_in_id')->toArray();
                    $tradeins = Tradein::whereIn('id', $trays)->where(function($query){
                        $query->where('job_state', '=', '10');
                    })->get();
                    if($tradeins->count() > 0){
                        foreach($tradeins as $tradein){
                            $tradein->product = $tradein->getProductName($tradein->id);
                            $tradein->stock_location = $tradein->getTrayName($tradein->id);
                        }
                    }
                    return $tradeins;
                    break;

                case 'tray':
                    $trays = Tray::where('tray_name', 'LIKE', "%{$searchterm}%")->get()->pluck('id')->toArray();
                    $tray_content = TrayContent::whereIn('tray_id', $trays)->get()->pluck('trade_in_id')->toArray();
                    $tradeins = Tradein::whereIn('id', $tray_content)->where(function($query){
                        $query->where('job_state', '=', '10');
                    })->get();
                    if($tradeins->count() > 0){
                        foreach($tradeins as $tradein){
                            $tradein->product = $tradein->getProductName($tradein->id);
                            $tradein->stock_location = $tradein->getTrayName($tradein->id);
                        }
                    }
                    return $tradeins;
                    break;

                case 'barcode':
                    $tradeins = Tradein::where('barcode', $searchterm)->orWhere('barcode_original', $searchterm)
                        ->where(function($query){
                            $query->where('job_state', '=', '10');
                        })->get();

                    if($tradeins->count() > 0){
                        foreach($tradeins as $tradein){
                            $tradein->product = $tradein->getProductName($tradein->id);
                            $tradein->stock_location = $tradein->getTrayName($tradein->id);
                        }
                    }
                    return $tradeins;
                    break;

                default:
                    # code...
                    break;
            }
            //dd($searchterm, $searchoption);
        }
    }


    /**
     * Create batch from selected devices.
     */
    public function createBatch(Request $request){
        if(isset($request->ids)){

            // auto batch reference
            $num_ref = PaymentBatch::all()->count() + 1;
            if(strlen($num_ref) < 2){
                $num_ref = '0'.$num_ref;
            }
            $num_ref = "SP-".$num_ref;

            $ids = $request->ids;
            $tradeins = Tradein::whereIn('id', $ids)->get();
            
            // create payment batch from tradein
            $payment_batch = new PaymentBatch([
                // 'payment_type' => 1                         default 01 for now (domestic)
                'arrive_at' => Carbon::now()->addDay(),     //Carbon::now()->addDay()->format('dmY'),
                'payment_state' => 1,
                'csv_file' => null,
                'reference' => null,
                'batch_type' => 1                           // submitted payment batch type,
            ]);

            $payment_batch->save();

            $payment_batch_devices = collect();

            foreach($tradeins as $tradein){
                
                if($tradein->job_state !== '23'){
                   
                    $tradein->job_state = '23';
                    $tradein->save();

                    // create payment batch device
                    $payment_batch_device = new PaymentBatchDevice([
                        'payment_batch_id' => $payment_batch->id,
                        'tradein_id' => $tradein->id,
                        'device_price' => $tradein->bamboo_price,
                        'batch_state' => null
                    ]);

                    $payment_batch_device->save();
                    $payment_batch_devices->push($payment_batch_device);
                }
            }

            $payment_batch->reference = $num_ref;
            $payment_batch->save();

            return response('OK', 200);
        }
    }



    /**
     * Show submit for payments page.
     */
    public function showSubmitPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $submited_batches = PaymentBatch::where(function($query){
            $query->where('batch_type', 1)->orWhere('batch_type', 2);
        })->where('exported', 0)->get();

        return view('portal.payments.submit', [
            'portalUser'        => $portalUser,
            'submitted_batches' => $submited_batches
        ]);
    }


    /**
     * Export payment batches as a CSV file.
     */
    public function exportCSV(Request $request){
        if(isset($request->batches)){

            // generate payment batch csv file
            $batch_ids = request()->batches;
            $batchService = new PaymentBatchService();
            $file = $batchService->generateCSV($batch_ids);

            return response($batch_ids[0], 200);
        }
    }

    /**
     * Download batch csv.
     */
    public function downloadCSV(){
        if(isset(request()->batch_id)){
            $payment_batch = PaymentBatch::findOrFail(request()->batch_id);
            return response()->download(storage_path().'/app/public/exports/batches/' . $payment_batch->csv_file);
        }
        if(isset(request()->batchdevice_id)){
            $device = PaymentBatchDevice::find(request()->batchdevice_id);
            $payment_batch = PaymentBatch::findOrFail($device->payment_batch_id);
            return response()->download(storage_path().'/app/public/exports/batches/' . $payment_batch->csv_file);
        }
    }


    /**
     * Show payments confirmation page.
     */
    public function showConfirmPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $devices = collect();
        if(isset(request()->search)){
            $searchterm = request()->search;

            // by reference
            $payment_batches = PaymentBatch::where("exported", true)->where(function ($query) use($searchterm) {
                $query->where('reference', 'LIKE', "%{$searchterm}%");
            })->get()->pluck('id')->toArray();

            $devices_by_reference = PaymentBatchDevice::whereIn('payment_batch_id', $payment_batches)->get();

            // by tradein id || tradein barcode
            $tradeins = Tradein::where(function($query) use($searchterm){
                $query->where('barcode', 'LIKE', "%".$searchterm."%")->orWhere('barcode_original', 'LIKE', "%".$searchterm."%");
                $query->where('job_state', '=', '24')->orWhere('job_state', '=', '23');
            })->get()->pluck('id')->toArray();

            $devices_by_tradein = PaymentBatchDevice::whereIn('tradein_id', $tradeins)->get();


            if($devices_by_reference->count() < 1){
                $devices = $devices_by_tradein;
            } else {
                $devices = $devices_by_reference;
            }

        } else {
            $payment_batches = PaymentBatch::where(function($query){
                $query->where("exported", true)->orWhere('batch_type', 3);
            })->get();

            foreach($payment_batches as $batch){
                $payment_batch_devices = PaymentBatchDevice::where('payment_batch_id', $batch->id)->where('payment_state', null)->get();
                foreach($payment_batch_devices as $device){
                    $devices->push($device);
                }
            }
        }

        return view('portal.payments.confirm', ['portalUser' => $portalUser, 'devices' => $devices]);
        // return view('portal.payments.confirm')->with('portalUser', $portalUser);
    }


    /**
     * Mark device payment as successfull.
     * 
     * @param Request $request
     */
    public function markAsSuccessful(Request $request){
        if(isset($request->ids)){
            
            $cheque_numbers = null;
            if(isset($request->cheque_numbers)) $cheque_numbers = $request->cheque_numbers;

            $batchdevices = PaymentBatchDevice::whereIn('id', $request->ids)->get();
            if($batchdevices->count() > 0){

                foreach($batchdevices as $batchdevice){
                    $tradein = Tradein::find($batchdevice->tradein_id);
                    // set tradein job state - paid
                    // customer status paid
                    if($tradein){

                        // if cheque number set, update it
                        $has_cheque_number = false;
                        if(isset($cheque_numbers[$batchdevice->id])){
                            $has_cheque_number = true;
                        }
                        // set tradein state
                        $tradein->job_state = '25';
                        if($has_cheque_number){
                            $tradein->cheque_number = $cheque_numbers[$batchdevice->id];
                        }
                        $tradein->save();

                        // set batch device state
                        $batchdevice->payment_state = 1;
                        $batchdevice->save();

                        // send payment successful email
                        $klaviyo = new KlaviyoEmail();

                        $user = User::find($tradein->user_id);
                        $klaviyo->paymentSuccesful($user, $tradein);

                        BatchDeviceEmail::create([
                            'type' => 1,
                            'order' => 1,
                            'batch_device_id' => $batchdevice->id
                        ]);
                    }
                }
                return response('Success');
            }
            return response("No such device", 404);
        }
    }

    /**
     * Mark device payment as failed.
     */
    public function markAsFailed(Request $request){
        if(isset($request->ids)){

            $cheque_numbers = null;
            if(isset($request->cheque_numbers)) $cheque_numbers = $request->cheque_numbers;

            $batchdevices = PaymentBatchDevice::whereIn('id', $request->ids)->get();

            if($batchdevices->count() > 0){

                // mark batch as failed
                $payment_batch = PaymentBatch::find($batchdevices[0]->payment_batch_id);
                $payment_batch->save();

                foreach($batchdevices as $batchdevice){
                    $tradein = Tradein::find($batchdevice->tradein_id);
                    if($tradein){

                        // if cheque number set, update it
                        $has_cheque_number = false;
                        if(isset($cheque_numbers[$batchdevice->id])){
                            $has_cheque_number = true;
                        }
                        if($has_cheque_number){
                            $tradein->cheque_number = $cheque_numbers[$batchdevice->id];
                        }

                        // set tradein job state - failed
                        $tradein->job_state = '24';
                        $tradein->save();

                        $batchdevice->payment_state = 2;
                        $batchdevice->failed_at = Carbon::now();
                        $batchdevice->save();
                        // add device into failed payments module
                        // send payment failed email
                        $klaviyo = new KlaviyoEmail();

                        $user = User::find($tradein->user_id);
                        $klaviyo->paymentUnsuccesful($user, $tradein);

                        BatchDeviceEmail::create([
                            'type' => 2,
                            'order' => 1,
                            'batch_device_id' => $batchdevice->id
                        ]);
                    }
                }
                return response('Success');
            }
            return response("No such device", 404);
        }
    }


    /**
     * Show failed payments page.
     */
    public function showFailedPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $fp_num_ref = PaymentBatch::where('batch_type', 2)->get()->count() + 1;
        if(strlen($fp_num_ref) < 2){
            $fp_num_ref = '0'.$fp_num_ref;
        }
        $fp_num_ref = "FP-".$fp_num_ref;

        $fc_num_ref = PaymentBatch::where('batch_type', 3)->get()->count() + 1;
        if(strlen($fc_num_ref) < 2){
            $fc_num_ref = '0'.$fc_num_ref;
        }
        $fc_num_ref = "FC-".$fc_num_ref;

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $devices =  PaymentBatchDevice::where('payment_state', 2)->get();
        foreach($devices as $device){
            $device->can_create_fc = $device->canCreateFCBatch();
            $device->can_create_fp = $device->canCreateFPBatch();
        }

        return view('portal.payments.failed', [
            'portalUser' => $portalUser, 
            'devices' => $devices,
            'fp_ref' => $fp_num_ref,
            'fc_ref' => $fc_num_ref
        ]);
    }


    /**
     * Create failed batch.
     */
    public function createFailedBatch(Request $request){
        if(isset($request->ids) && isset($request->type)){
            $ids = $request->ids;
            $type = $request->type;
            
            $payment_batch = null;
            $payment_batch_devices = PaymentBatchDevice::whereIn('id', $ids)->get();

            $fp_ref = PaymentBatch::where('batch_type', 2)->get()->count() + 1;
            if(strlen($fp_ref) < 2){
                $fp_ref = '0'.$fp_ref;
            }
            $fp_ref = "FP-".$fp_ref;

            $fc_ref = PaymentBatch::where('batch_type', 3)->get()->count() + 1;
            if(strlen($fc_ref) < 2){
                $fc_ref = '0'.$fc_ref;
            }
            $fc_ref = "FC-".$fc_ref;
            
            $payment_batch =  null;
            switch ($type) {
                case 'FP':  // failed payment batch
                    // can be created after user updates his bank account details (TODO create event for bank account details update)
                    
                    $payment_batch = new PaymentBatch([
                        // 'payment_type' => 1                         default 01 for now (domestic)
                        'sort_code_number' => 12341234123412,           // bamboo account
                        'arrive_at' => Carbon::now()->addDay(),     // Carbon::now()->addDay()->format('dmY'),
                        'payment_state' => 1,
                        'csv_file' => null,
                        'reference' => null,
                        'batch_type' => 2,                          // submitted payment batch type,
                        'reference' => $fp_ref
                    ]);
        
                    $payment_batch->save();
                    break;

                case 'FC': // failed cheque batch
                    // will be created only after 3rd payment unsuccessful email
                    $payment_batch = new PaymentBatch([
                        // 'payment_type' => 1                         default 01 for now (domestic)
                        'sort_code_number' => 12341234123412,           // bamboo account
                        'arrive_at' => Carbon::now()->addDay(),     // Carbon::now()->addDay()->format('dmY'),
                        'payment_state' => 1,
                        'csv_file' => null,
                        'reference' => null,
                        'batch_type' => 3,                          // submitted payment batch type,
                        'reference' => $fc_ref
                    ]);
        
                    $payment_batch->save();
                    break;

                default:
                    # code...
                    break;
            }

            // change devices batch id
            $tradein_ids = [];
            foreach($payment_batch_devices as $device){
                $device->payment_batch_id = $payment_batch->id;
                $device->payment_state = null;
                $device->save();
                array_push($tradein_ids, $device->tradein_id);
            }

            // update tradein state
            $tradeins = Tradein::whereIn('id', $tradein_ids)->get();
            foreach($tradeins as $tradein){     
                $tradein->job_state = '23';
                $tradein->save();
            }

            return response('Success', 200);
        
        }
    }
}
