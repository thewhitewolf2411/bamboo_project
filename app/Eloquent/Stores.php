<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_image','store_name','store_address',
    ];
}
