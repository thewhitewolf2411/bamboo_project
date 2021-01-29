<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BoxContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'box_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'box_id','trade_in_id'
    ];
}
