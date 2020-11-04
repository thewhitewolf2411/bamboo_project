<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Network;

class ProductNetworks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_networks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'network_id', 'product_id', 'knockoff_price'
    ];

    public function getNetWorkName($id){
        $network = Network::where('id', $id)->first();
        return $network->network_name;
    }

    public function getNetWorkImage($id){
        $network = Network::where('id', $id)->first();
        return $network->network_image;
    }
}
