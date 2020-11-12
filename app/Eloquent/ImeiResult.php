<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ImeiResult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'imei_result';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id', 'API', 'remarks', 'model_name', 'blackliststatus', 'greyliststatus'
    ];
}
