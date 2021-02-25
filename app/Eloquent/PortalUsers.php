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
        'user_id',
        'recycle',
            'trade_pack_despatch',
            'awaiting_receipt',
            'receiving',
            'device_testing',
            'trolley_management',
            'trays_managment',
            'box_management',
            'quarantine_managment',
            'warehouse_management',
            'despatch',
        'customer_care',
            'order_management',
            'create_order',
            'customer_accounts',
        'administration',
            'salvage_models',
            'sales_models',
            'feeds',
            'users',
            'reports',
            'cms',
            'categories',
            'settings',
        'payments',
            'awaiting_payments',
            'submit_payments',
            'payment_confirmations',
            'failed_payments'
    ];
}
