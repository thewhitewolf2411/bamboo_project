<?php

namespace App\Observers;

use App\Audits\TradeinAudit;
use App\Eloquent\Tradein;
use App\Eloquent\JobStateChanged;
use Illuminate\Support\Facades\Auth;

class TradeInObserver
{
    /**
     * Handle the tradein "created" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function created(Tradein $tradein)
    {
        TradeinAudit::create([
            'tradein_id' => $tradein->id,
            'tradein_barcode' => $tradein->barcode,
            'tradein_barcode_original' => $tradein->barcode_original,
            'product_id' => $tradein->product_id,
            'user_id' => $tradein->user_id,
            'customer_status' => $tradein->getCustomerStatus(),
            'bamboo_status' => $tradein->getBambooStatus(),
            'customer_grade' => null,
            'bamboo_grade' => null,
            'value' => $tradein->order_price,
            'stock_location' => $tradein->getTrayName($tradein->id),
            'cheque_number' => null,
            'pin_pattern_number' => null
        ]);
        // TradeinAudit::create([
        //     'tradein_id'    => $tradein->id,
        //     'column_name'   => $changed_column,
        //     'old_value'     => (string)$old_value,
        //     'new_value'     => (string)$new_value,
        //     'user_id'       => Auth::user()->id
        // ]);
        // dd('trade created', $tradein);

        JobStateChanged::create([
            'tradein_id'=>$tradein->id,
            'job_state'=>$tradein->job_state,
            'sent'=>false,
        ]);
    }

    /**
     * Handle the tradein "updated" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function updated(Tradein $tradein)
    {

        $value = 0;
        if($tradein->bamboo_price === null && $tradein->order_price === null){
            $value = 0;
        }
        else{
            if($tradein->bamboo_price !== null && $tradein->order_price === null){
                $value = $tradein->bamboo_price;
            }
            elseif($tradein->bamboo_price === null && $tradein->order_price !== null){
                $value = $tradein->order_price;
            }
            else{
                if($tradein->bamboo_price > $tradein->order_price){
                    $value = $tradein->order_price;
                }
                else{
                    $value = $tradein->bamboo_price;
                }
            }
        }
        
        # To check:
        # 1. when clicked on revert to receiving, tradein id changes and older audits are not visible
        $last_audit = TradeinAudit::where('tradein_id', $tradein->id)->orderBy('created_at', 'DESC')->first();
        $audit = new TradeinAudit([
            'tradein_id' => $tradein->id,
            'tradein_barcode' => $tradein->barcode,
            'tradein_barcode_original' => $tradein->barcode_original,
            'product_id' => ($tradein->correct_product_id !== null) ? $tradein->correct_product_id : $tradein->product_id,
            'user_id' => Auth::user()->id,
            'customer_status' => $tradein->getCustomerStatus(),
            'bamboo_status' => $tradein->getBambooStatus(),
            'customer_grade' => $tradein->customer_grade,
            // 'bamboo_grade' => $tradein->bamboo_grade,
            'bamboo_grade' => $tradein->getDeviceBambooGrade(),
            'value' => $value,
            'stock_location' => $tradein->getTrayName($tradein->id),
            'cheque_number' => $tradein->cheque_number,
            'pin_pattern_number' => $tradein->pin_pattern_number
        ]);

        $can_store_audit = true;
        if($last_audit){
            if($last_audit->tradein_barcode !== $audit->tradein_barcode){
                $can_store_audit = true;
                //echo 'barcode';
            }
            if($last_audit->tradein_barcode_original !== $audit->tradein_barcode_original){
                $can_store_audit = true;
                //echo 'barcode orig';
            }
            if($last_audit->user_id !== $audit->user_id){
                //echo 'user';
            }
            if($last_audit->customer_status !== $audit->customer_status){
                $can_store_audit = true;
                //echo 'customer status';
            }
            if($last_audit->bamboo_status !== $audit->bamboo_status){
                $can_store_audit = true;
                //echo 'bamboo status';
            }
            if($last_audit->customer_grade !== $audit->customer_grade){
                $can_store_audit = true;
                //echo 'customer grade';
            }
            if($last_audit->cosmetic_condition !== $audit->cosmetic_condition){
                $can_store_audit = true;
                //echo 'bamboo grade';
            }
            if($last_audit->value !== $audit->value){
                $can_store_audit = true;
                //echo 'value';
            }
            if($last_audit->stock_location !== $audit->stock_location){
                $can_store_audit = true;
                //echo 'tray';
            }
            if($last_audit->value !== $audit->value){
                $can_store_audit = true;
                //echo 'tray';
            }
            if($last_audit->cheque_number !== $audit->cheque_number){
                $can_store_audit = true;
                //echo 'tray';
            }
            if($last_audit->pin_pattern_number !== $audit->pin_pattern_number){
                $can_store_audit = true;
                //echo 'tray';
            }
        } else {
            $can_store_audit = true;
        }
        
        if($can_store_audit){
            $audit->save();
        }

        $last_job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        if($last_job_state->job_state !== $tradein->job_state){
            $last_job_state->previous_job_state = $last_job_state->job_state;
            $last_job_state->job_state = $tradein->job_state;
            $last_job_state->save();
        }
    }

    /**
     * Handle the tradein "deleted" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function deleted(Tradein $tradein)
    {
        //dd('trade deleted');
    }

    /**
     * Handle the tradein "restored" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function restored(Tradein $tradein)
    {
        //dd('trade restored');
    }

    /**
     * Handle the tradein "force deleted" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function forceDeleted(Tradein $tradein)
    {
        //dd('trade force deleted');
    }
}
