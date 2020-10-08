<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class QuarantineReff extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quarantine_reffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bay_name','bay_description','number_of_reffs'
    ];
}
