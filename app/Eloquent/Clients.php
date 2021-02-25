<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    protected $fillable = [
        'account_name','contact_name','address','post_code','country','contact_email','contact_number','vat_code','payment_type'
    ];


}
