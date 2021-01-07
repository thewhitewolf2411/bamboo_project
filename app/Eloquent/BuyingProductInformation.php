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
        'product_id','memory','excellent_working','good_working','poor_working'
    ];

    public function getNetWorkImage($id){
        $network = Network::where('id', $id)->first();
        return $network->network_image;
    }

}
