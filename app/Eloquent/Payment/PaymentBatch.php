<?php

namespace App\Eloquent\Payment;

use App\Eloquent\Tradein;
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

    public $batch_types = [
        1 => 'submitted',
        2 => 'failed payment',
        3 => 'failed cheque',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'arrive_at',
        'csv_file',
        'reference',
        'batch_type',
        'exported'
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

    public function cost(){
        $total = 0;
        $tradein_ids = PaymentBatchDevice::where('payment_batch_id', $this->id)->get()->pluck('tradein_id');
        $tradeins = Tradein::whereIn('id', $tradein_ids)->get();
        foreach($tradeins as $tradein){
            $total+=$tradein->bamboo_price;
        }

        return "£ " . $total ;
    }
}
