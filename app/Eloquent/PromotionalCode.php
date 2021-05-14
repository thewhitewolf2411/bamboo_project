<?php

namespace App\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PromotionalCode extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotional_codes';

    public $types = [
        1 => "Recycle",
        2 => "E-Commerce"
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'apply_rules', 'promotional_code', 'value', 'expires_at',
    ];

    public function getExpiryDate(){
        return Carbon::parse($this->expires_at)->format('Y-m-d');
    }
}
