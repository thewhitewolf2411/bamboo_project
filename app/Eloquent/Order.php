<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_placed', 'product_id', 'user_id','user_email', 'product_total', 
        'order_total','order_status','payment_status','shipping_status','quantity','status',
    ];
}
