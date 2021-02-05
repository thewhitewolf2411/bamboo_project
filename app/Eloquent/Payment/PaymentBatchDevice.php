<?php

namespace App\Eloquent\Payment;

use App\Eloquent\Tradein;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PaymentBatchDevice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_batch_devices';

    public $states = [
        null => 'Awaiting response',
        1 => 'Payment successful',
        2 => 'Payment failed'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_batch_id',
        'tradein_id',
        'payment_state',
        'cheque_number',
        'failed_at'
    ];

    public function product(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->getProductName($tradein->id);
    }

    public function customer(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->customer()->fullName();
    }

    public function price(){
        $tradein = Tradein::find($this->tradein_id);
        return $tradein->bamboo_price;
    }

    public function batchReference(){
        return PaymentBatch::find($this->payment_batch_id)->reference;
    }

    public function tradeinId(){
        return Tradein::find($this->tradein_id)->barcode;
    }

    public function tradeinBarcode(){
        return Tradein::find($this->tradein_id)->barcode_original;
    }

    public function orderDate(){
        return PaymentBatch::find($this->payment_batch_id)->created_at->format('d/m/Y');
    }

    public function failedDate(){
        return Carbon::parse($this->failed_at)->format('d.m.Y H:i');
    }

    public function bankDetailsUpdated(){
        return null;
    }
}