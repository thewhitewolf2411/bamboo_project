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
        'product_id','color_value'
    ];

    public function getModelName($modelid){

        $model = SellingProduct::where('id', $modelid)->first();
        return $model->product_name;
    }
}
