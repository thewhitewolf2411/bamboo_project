<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    protected $table = 'abandoned_cart';

    protected $fillable = [
        'user_email', 'price', 'product_id','type', 'network',
        'memory','grade', 'email_sent'
    ];


    public function getProductName(){
        if($this->type === "tradein"){
            $product = SellingProduct::where('id', $this->product_id)->first();
        }
        else if($this->type === "tradeout"){
            $product = BuyingProduct::where('id', $this->product_id)->first();
        }

        return $product->product_name;
    }
}
