<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AdditionalCosts extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'additional_costs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_costs','logistics_costs'
    ];
}