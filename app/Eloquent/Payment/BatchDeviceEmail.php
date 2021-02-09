<?php

namespace App\Eloquent\Payment;

use Illuminate\Database\Eloquent\Model;

class BatchDeviceEmail extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batch_device_emails';

    public $types = [
        1 => 'Success',
        2 => 'Failed'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'order',
        'batch_device_id',
        'reference'
    ];
}
