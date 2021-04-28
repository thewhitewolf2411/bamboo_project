<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'link',
        'link_text',
        'link_color'
    ];
}
