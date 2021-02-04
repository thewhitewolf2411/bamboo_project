<?php

namespace App\Services;

use App\Eloquent\Payment\PaymentBatch;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Tradein;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PaymentBatchService {

    private $standard_domestic_payment = [
        'H001' => ',',
        'H002' => ',',
        'H003' => ',',
        'T001' => '01', // record type (01 is for SDP)
        'T002' => ',',
        'T003' => ',',  // template reference
        'T004' => ',',
        'T005' => ',',
        'T006' => ',',
        'T007' => ',',
        'T008' => ',',
        'T009' => ',',
        'T010' => null, // debit account identifier
        'T011' => ',',
        'T012' => ',',
        'T013' => ',',  // payment currency
        'T014' => null, // payment amount (GBP)
        'T015' => ',',
        'T016' => null, // credit date (ddmmyyyy)
        'T017' => ',',
        'T018' => ',',
        'T019' => ',',
        'T020' => ',',
        'T021' => ',',
        'T022' => null, // account with bank identifier
        'T023' => ',',
        'T024' => ',',
        'T025' => ',',
        'T026' => ',',
        'T027' => ',',
        'T028' => null, // beneficiary account number
        'T029' => ',',
        'T030' => null, // beneficiary name and address line
        'T031' => ',',
        'T032' => ',',
        'T033' => ',',
        'T034' => null,  // beneficiary reference,
        'empty_fields' => ',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,'
    ];

    public function __construct()
    {
        
    }

    /**
     * Generate CSV file for payment based on payment batch info.
     */
    public function generateCSV(array $payment_batches_ids){

        // create csv file
        $payment_rows = [];
        $batches = collect();

        foreach($payment_batches_ids as $id){

            $payment_batch = PaymentBatch::find($id);
            $payment_batch_devices = PaymentBatchDevice::where('payment_batch_id', $payment_batch->id)->get();

            $batches->push($payment_batch);

            foreach($payment_batch_devices as $payment_batch_device){
            
                $tradein = Tradein::find($payment_batch_device->tradein_id);
                $user = User::find($tradein->user_id);
    
                // choose csv preset for payment type
                switch ($payment_batch->payment_type) {
                    // standard domestic payment preset
                    case '01':
                        $single_payment = $this->standard_domestic_payment;
                        break;
                    
                    default:
                        # code...
                        break;
                }
    
                $single_payment['T010'] = $payment_batch->sort_code_number; // debit account identifier (bamboo account)
                $single_payment['T014'] = $tradein->bamboo_price;           // device price (bamboo evaluated price)
                $single_payment['T016'] = Carbon::parse($payment_batch->arrive_at)->format('dmY');  // credit date
                $single_payment['T022'] = 151000;                           // user bank account identifier -- TODO
                $single_payment['T028'] = 44298801;                         // user bank account number     -- TODO
                $single_payment['T028'] = $user->fullName();                // beneficiary name and address line
                $single_payment['T034'] = "INVOICE " . $tradein->barcode;   // beneficiary reference
    
                $payment_row = '';
                foreach($single_payment as $payment_column_data){
                    $payment_row.=$payment_column_data;
                }
    
                array_push($payment_rows, $payment_row);
            }
            
            $payment_batch->exported = true;
            $payment_batch->save();

        }

        $path = storage_path().'\app\public\exports\batches';
        $filename = '\SP_batch_export_'.time().'.csv';

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
            
        $file_path = $path.$filename;

        $fp = fopen($file_path, 'w');

        foreach ($payment_rows as $row) {
            fwrite($fp, $row."\n");
        }
        
        fclose($fp);

        foreach($batches as $batch){
            $batch->csv_file = $filename;
            $batch->save();
        }

        return $file_path;
    }

}