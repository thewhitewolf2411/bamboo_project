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
            'quarantine_management',
            'warehouse_management',
            'sales_lots',
            'despatch',
        'customer_care',
            'order_management',
            'create_order',
            'customer_accounts',
            'messages',
        'administration',
            'salvage_models',
            'sales_models',
            'feeds',
            'users',
            'reports',
            'cms',
            'categories',
            'settings',
            'promo_codes',
            'promo_devices',
        'payments',
            'awaiting_payments',
            'submit_payments',
            'payment_confirmations',
            'failed_payments'
    ];
}
