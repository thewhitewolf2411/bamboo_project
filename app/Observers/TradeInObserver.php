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
        $changes = $tradein->getChanges();
        foreach($changes as $changed_column => $new_value){
            if($changed_column !== 'updated_at'){
                $old_value = $tradein->getOriginal($changed_column);
                if($old_value !== $new_value){
                    TradeinAudit::create([
                        'tradein_id'    => $tradein->id,
                        'column_name'   => $changed_column,
                        'old_value'     => (string)$old_value,
                        'new_value'     => (string)$new_value,
                        'user_id'       => Auth::user()->id
                    ]);
                }
            }
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
        dd('trade deleted');
    }

    /**
     * Handle the tradein "restored" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function restored(Tradein $tradein)
    {
        dd('trade restored');
    }

    /**
     * Handle the tradein "force deleted" event.
     *
     * @param  \App\Tradein  $tradein
     * @return void
     */
    public function forceDeleted(Tradein $tradein)
    {
        dd('trade force deleted');
    }
}
