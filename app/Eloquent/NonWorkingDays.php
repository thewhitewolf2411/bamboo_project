<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class NonWorkingDays extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'non_working_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day','non_working_days'
    ];
}