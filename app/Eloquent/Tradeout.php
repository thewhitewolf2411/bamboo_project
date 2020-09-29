<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Tradeout extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradeout';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'order_state',
    ];
}
