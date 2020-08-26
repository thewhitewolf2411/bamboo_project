<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','product_image','product_description','category_id', 'brand_id', 'product_network', 'product_memory','product_colour', 'product_grade',
        'product_weight','product_screen','product_system','product_connectivity','product_battery','product_signal','product_camera','product_camera_2','product_sim',
        'product_memory_slots','product_quantity','product_price_a_plus','product_price_a','product_price_b','product_price_c','product_price_d','product_price_f','product_selling_price_a_plus',
        'product_selling_price_a', 'product_selling_price_b','product_selling_price_c', 'product_selling_price_d','product_selling_price_f'
    ];
}
