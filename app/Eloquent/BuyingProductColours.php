<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BuyingProductColours extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buying_products_colours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','color_value'
    ];

}
