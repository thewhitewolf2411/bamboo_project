<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class UserPromotionalCode extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_promotional_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','promotional_code_id', 'trade_in_id'
    ];
}
