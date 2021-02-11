<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_type', 'article_title', 'article_image', 'article_text'
    ];

}
