<?php

namespace App\Eloquent\Payment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class PaymentBatch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_batches';

    public $states = [
        1 => 'Submitted for payment',
        2 => 'Batch has been submited to the bank',
        3 => 'Successfull payment',
        4 => 'Failed payment'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_code_number',
        'arrive_at',
        'payment_state',
        'csv_file',
        'reference'
    ];

    public function devicesCount(){
        return PaymentBatchDevice::where('payment_batch_id', $this->id)->get()->count();
    }

    public function getDevices(){
        $tradein_ids = PaymentBatchDevice::where('payment_batch_id', $this->id)->get()->pluck('tradein_id');
        $tradeins = Tradein::whereIn('id', $tradein_ids)->get();
        foreach($tradeins as $tradein){
            $tradein->device = $tradein->getProductName($tradein->id);
            $tradein->customer = $tradein->customer()->fullName();
        }

        return $tradeins;
    }
}
