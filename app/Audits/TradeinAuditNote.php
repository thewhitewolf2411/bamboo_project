<?php

namespace App\Audits;

use Illuminate\Database\Eloquent\Model;

class TradeinAuditNote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradein_audits_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_audit_id',
        'user_id',
        'note'
    ];

}
