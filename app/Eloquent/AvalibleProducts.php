<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AvalibleProducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avalible_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','avalible'
    ];
}
