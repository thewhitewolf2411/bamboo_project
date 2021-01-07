<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProductInformation extends Model
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
        'product_id','memory','excellent_working','good_working','poor_working','damaged_working','faulty'
    ];
}
