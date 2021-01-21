<?php

namespace App\Audits;

use App\Eloquent\SellingProduct;
use App\User;
use App\Audits\TradeinAuditNote;
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
        $user = User::find($this->user_id);
        if($user->type_of_user < 1){
            return 'Customer';
        } else {
            return $user->fullName();
        }
    }

    /**
     * Get the notes for the audits.
     */
    public function notes()
    {
        return $this->hasMany(TradeinAuditNote::class);
    }
}
