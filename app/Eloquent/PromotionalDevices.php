<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PromotionalDevices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotional_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promo_type','device_1','device_2','device_3', 'device_4'
    ];
}
