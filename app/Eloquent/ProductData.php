<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','buying_price','selling_price'
    ];
}
