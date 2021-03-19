<?php

namespace App\Eloquent\Despatch;

use App\Eloquent\Tradein;
use Illuminate\Database\Eloquent\Model;

class DespatchedDevice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'despatched_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tradein_id','order_identifier','order_reference', 'order_date', 'despatched_at'
    ];

    public function getTradeinId(){
        $tradein = Tradein::find($this->tradein_id);
        if($tradein){
            return $tradein->barcode;
        }
    }
}
