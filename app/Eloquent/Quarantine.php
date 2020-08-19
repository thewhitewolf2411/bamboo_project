<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Quarantine extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quarantine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','awaiting_seller_response','return_to_seller','products_to_retest','add_to_stock','manually_managed'
    ];
}
