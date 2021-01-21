<?php

namespace App\Observers;

use App\Audits\TradeinAudit;
use App\Eloquent\Tradein;
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
            'stock_location' => null,
            'cheque_number' => null
        ]);
        // TradeinAudit::create([
        //     'tradein_id'    => $tradein->id,
        //     'column_name'   => $changed_column,
        //     'old_value'     => (string)$old_value,
        //     'new_value'     => (string)$new_value,
        //     'user_id'       => Auth::user()->id
        // ]);
        // dd('trade created', $tradein);
    }

    /**
     * Handle the tradein "updated" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function updated(Tradein $tradein)
    {
        # To check:
        # 1. when clicked on revert to receiving, tradein id changes and older audits are not visible
        $last_audit = TradeinAudit::where('tradein_id', $tradein->id)->orderBy('created_at', 'DESC')->first();
        $audit = new TradeinAudit([
            'tradein_id' => $tradein->id,
            'tradein_barcode' => $tradein->barcode,
            'tradein_barcode_original' => $tradein->barcode_original,
            'product_id' => $tradein->product_id,
            'user_id' => Auth::user()->id,
            'customer_status' => $tradein->getCustomerStatus(),
            'bamboo_status' => $tradein->getBambooStatus(),
            'customer_grade' => $tradein->product_state,
            'bamboo_grade' => $tradein->bamboo_grade,
            'value' => (string)$tradein->order_price,
            'stock_location' => ($tradein->getTrayName($tradein->id) !== 'Error') ? $tradein->getTrayName($tradein->id) : null,
            'cheque_number' => null
        ]);

        $can_store_audit = false;
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
            if($last_audit->bamboo_grade !== $audit->bamboo_grade){
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
        } else {
            $can_store_audit = true;
        }
        
        if($can_store_audit){
            $audit->save();
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
