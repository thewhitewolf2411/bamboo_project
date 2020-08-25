<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Conditions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conditions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','alias','importance',
    ];
}
