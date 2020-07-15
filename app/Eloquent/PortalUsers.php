<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PortalUsers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portal_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_receipt_and_dispatch_portal', 'warehouse_stock_management_portal', 'phone_testing_portal',
        'customer_care_portal', 'administration_portal', 'warehouse_administration_console',
    ];
}
