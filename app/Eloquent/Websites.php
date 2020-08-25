<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Websites extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'websites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_image','website_name','website_address'
    ];
}
