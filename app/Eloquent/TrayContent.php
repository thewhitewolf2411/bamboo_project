<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Trolley;

class TrayContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tray_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tray_id','trade_in_id', 'pseudo_tray_id'
    ];

}
