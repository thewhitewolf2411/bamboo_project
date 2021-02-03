<?php

namespace App\Eloquent\Payment;

use App\Eloquent\Tradein;
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
        'payment_state'
    ];

    public function model(){
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
}
