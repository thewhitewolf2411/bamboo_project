<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\User;
use DNS1D;
use DNS2D;

class SoldTradeIns extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sold_tradeins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_barcode', 'user_id','product_id', 'sales_lot_id','bamboo_price', 'bamboo_grade','cosmetic_condition','sold_to',
    ];


}