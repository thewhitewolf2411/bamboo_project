<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade','manifacturer','network', 'box_devices', 'max_devices', 'status'
    ];

    
}
