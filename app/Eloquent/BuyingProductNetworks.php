<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BuyingProductNetworks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buying_product_network';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'network_id', 'product_id', 'knockoff_price'
    ];

}
