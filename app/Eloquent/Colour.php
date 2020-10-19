<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'colours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id','color_value'
    ];

    public function getBrandName($brandid){

        $brand = Brand::where('id', $brandid)->first();
        return $brand->brand_name;
    }
}
