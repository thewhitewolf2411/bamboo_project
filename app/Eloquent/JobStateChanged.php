<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Tradein;
use App\User;

class JobStateChanged extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_state_changed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id','job_state','sent','created_at'
    ];

    public function getTradein(){
        return Tradein::find($this->tradein_id);
    }

    public function getUser(){
        return User::find($this->getTradein()->user_id);
    }
}
