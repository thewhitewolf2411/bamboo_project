<?php

namespace App\Eloquent\Payment;

use Illuminate\Database\Eloquent\Model;

class UserBankDetails extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_bank_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'account_name',
        'sort_code',
        'card_number',
        'country'
    ];
}
