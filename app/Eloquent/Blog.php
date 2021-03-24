<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cms_type', 'cms_title', 'cms_parg_1', 'cms_parg_2', 'cms_parg_3', 'image_1', 'image_2', 'image_3', 'author'
    ];


    
}
