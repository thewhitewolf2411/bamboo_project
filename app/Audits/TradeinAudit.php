<?php

namespace App\Audits;

use App\Eloquent\SellingProduct;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TradeinAudit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tradein_audits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id',
        'tradein_barcode',
        'tradein_barcode_original',
        'product_id',
        'user_id',
        'customer_status',
        'bamboo_status',
        'customer_grade',
        'bamboo_grade',
        'value',
        'stock_location',
        'cheque_number'
    ];

    public function getProduct(){
        return SellingProduct::where('id', $this->product_id)->first()->product_name;
    }

    public function getUser(){
        return User::find($this->user_id)->fullName();
    }
}
