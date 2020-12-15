<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BuyingProductInformation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buying_product_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','memory','customer_grade_price_1','customer_grade_price_2','customer_grade_price_3'
    ];

}
