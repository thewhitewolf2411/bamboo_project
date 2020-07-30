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
        'category_id', 'brand_id','product_name','product_image','product_network','product_memory','product_colour','product_grade','product_dimensions',
        'product_processor','product_weight','product_screen','product_system','product_connectivity','product_battery','product_signal','product_camera',
        'product_sim','product_memory_slots', 'price'
    ];
}
