<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Tradein extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradein';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barcode','product_id','product_state',
    ];
}
