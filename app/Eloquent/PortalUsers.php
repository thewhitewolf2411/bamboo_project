<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PortalUsers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portal_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','customer-care','categories','product','quarantine','testing','payments','reports','feeds','users','settings','cms','trays','boxes'
    ];
}
