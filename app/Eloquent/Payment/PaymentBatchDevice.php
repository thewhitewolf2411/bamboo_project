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
        return Tradein::find($this->tradein_id)->getDeviceCustomerPrice();
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
        if($this->bank_details_updated){
            return Carbon::parse($this->bank_details_updated_at)->format('d.m.Y H:i');
        }
        return false;
    }

    public function canCreateFCBatch(){
        $failed_emails = BatchDeviceEmail::where('batch_device_id', $this->id)->where('type', 2)->get();
        if($failed_emails->count() < 3){
            return false;
        }
        return true;
    }

    public function canCreateFPBatch(){
        if($this->bank_details_updated){
            return true;
        }
        return false;
    }

    public function canAddCheque(){
        $batch_type = PaymentBatch::find($this->payment_batch_id)->batch_type;
        if($batch_type === 3){
            return true;
        }
        return false;
    }

    public function hasCheque(){
        $tradein = Tradein::find($this->tradein_id);
        if($tradein->cheque_number !== null){
            return true;
        }
        return false;
    }

    public function paymentFailed(){
        $batch = PaymentBatch::find($this->payment_batch_id)->first();
        if($batch->payment_state === 2){
            return true;
        }
        return false;
    }
}