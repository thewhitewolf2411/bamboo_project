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
        'administration_costs','carriage_costs', 'miscellaneous_costs','per_job_deduction','applied_to', 'cost_description'
    ];
}