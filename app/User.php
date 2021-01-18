<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email','password','current_phone','preffered_os','sub','delivery_address','billing_address','contact_number','bamboo_credit',
        'username','worker_email'
    ];

    public function fullName(){
        return $this->first_name . " " . $this->last_name;
    }
}
