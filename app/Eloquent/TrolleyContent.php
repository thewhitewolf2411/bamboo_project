<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Trolley;

class TrolleyContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trolley_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trolley_id','tray_ud'
    ];

}
