<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class QuarantineReffItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quarantine_reffs_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quarantine_reffs_id','trade_in_id'
    ];
}
