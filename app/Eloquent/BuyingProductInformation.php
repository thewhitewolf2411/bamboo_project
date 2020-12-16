<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Network;

class BuyingProductInformation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buying_product_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','memory','customer_grade_price_1','customer_grade_price_2','customer_grade_price_3'
    ];

    public function getNetWorkImage($id){
        $network = Network::where('id', $id)->first();
        return $network->network_image;
    }

}
