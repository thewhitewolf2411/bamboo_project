<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class QuarantineBin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quarantine_bins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bin_name','device_quantity'
    ];
}
