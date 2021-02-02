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
use App\Services\BatchService;
use App\Services\PaymentBatchService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
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
                    $query->where('job_state','=','10')->orWhere('job_state', '=', '16');
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
            $tradeins = Tradein::where('job_state','=','10')->orWhere('job_state', '=', '16')->get();
        }

        return view('portal.payments.awaiting', [
            'portalUser' => $portalUser,
            'trolleys' => $trolleys,
            'trays' => $trays,
            'tradeins' => $tradeins
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
     * Create batch from selected devices.
     */
    public function createBatch(Request $request){
        if(isset($request->ids)){

            $ids = $request->ids;
            $tradeins = Tradein::whereIn('id', $ids)->get();
            
            // create payment batch from tradein
            $payment_batch = new PaymentBatch([
                // 'payment_type' - default 01 for now (domestic)
                'sort_code_number' => 15100031806542,       // bamboo account
                'arrive_at' => Carbon::now()->addDay(),  //Carbon::now()->addDay()->format('dmY'),
                'payment_state' => 1,
                'csv_file' => null,
                'reference' => null
            ]);
            $payment_batch->save();

            $payment_batch_devices = collect();
            $payment_batch_reference = null;

            foreach($tradeins as $tradein){
                
                if($tradein->job_state !== '21'){
                   
                    $tradein->job_state = '21';
                    $tradein->save();

                    // create payment batch device
                    $payment_batch_device = new PaymentBatchDevice([
                        'payment_batch_id' => $payment_batch->id,
                        'tradein_id' => $tradein->id,
                        'device_price' => $tradein->bamboo_price,
                    ]);

                    $payment_batch_reference = $tradein->barcode_original;

                    $payment_batch_device->save();
                    $payment_batch_devices->push($payment_batch_device);
                }
            }

            $payment_batch->reference = "INVOICE " . $payment_batch_reference;
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
        $payment_batches = PaymentBatch::where('payment_state', 1)->get();
        $submited_batches = PaymentBatch::where('payment_state', 2)->get();

        return view('portal.payments.submit', [
            'portalUser'        => $portalUser,
            'payment_batches'   => $payment_batches,
            'submitted_batches' => $submited_batches
        ]);
    }


    /**
     * Export payment batches as a CSV file.
     */
    public function exportCSV(Request $request){
        if(isset($request->batches)){

            // generate payment batch csv file
            $batch_ids = explode(',', request()->batches);
            $batchService = new PaymentBatchService();
            $file = $batchService->generateCSV($batch_ids);

            return redirect()->back();
            // return response()->download($file);
        }
    }

    /**
     * Download batch csv.
     */
    public function downloadCSV(){
        if(isset(request()->batchid)){
            $payment_batch = PaymentBatch::findOrFail(request()->batchid);
            return response()->download(storage_path().'\app\public\exports\batches' . $payment_batch->csv_file);
        }
    }


    /**
     * Show payments confirmation page.
     */
    public function showConfirmPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $payment_batches = PaymentBatch::where("payment_state", ">", "1")->get();
        $devices = collect();
        foreach($payment_batches as $batch){
            $payment_batch_devices = PaymentBatchDevice::where('payment_batch_id', $batch->id)->get();
            foreach($payment_batch_devices as $device){
                $devices->push($device);
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
        if(isset($request->batchdeviceid)){
            $batchdevice = PaymentBatchDevice::find($request->batchdeviceid);
            if($batchdevice){
                $tradein = Tradein::find($batchdevice->tradein_id);
                // set tradein job state - paid
                if($tradein){
                    $tradein->job_state = '24';
                    $tradein->save();
                    return response('Success');
                }
            }
            return response("No such device", 404);
        }
    }

    /**
     * Mark device payment as failed.
     */
    public function markAsFailed(Request $request){
        if(isset($request->batchdeviceid)){
            $batchdevice = PaymentBatchDevice::find($request->batchdeviceid);
            if($batchdevice){
                $tradein = Tradein::find($batchdevice->tradein_id);
                // set tradein job state - failed
                if($tradein){
                    $tradein->job_state = '23';
                    $tradein->save();
                    // add device into failed payments module
                    return response('Success');
                }
            }
            return response("No such device", 404);
        }
    }


    /**
     * Show failed payments page.
     */
    public function showFailedPayments(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.failed')->with('portalUser', $portalUser);
    }
}
