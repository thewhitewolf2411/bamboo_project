<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class FeedLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feed_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log_id', 'error_log'
    ];
}
