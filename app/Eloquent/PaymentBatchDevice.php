<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PaymentBatchDevice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_batch_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_batch_id',
        'tradein_id',
    ];
}
