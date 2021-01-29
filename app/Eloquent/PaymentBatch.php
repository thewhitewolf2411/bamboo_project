<?php

namespace App\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        2 => 'Successfull payment',
        3 => 'Failed payment'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_code_number',
        'arrive_at',
        'payment_state'
    ];

    public function getReference(){
        if($this->payment_state === 1){
            $date = Carbon::parse($this->created_at)->format('d-m-Y');
            return 'SP-'.$date;
        }
    }

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
