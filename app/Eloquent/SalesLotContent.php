<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SalesLotContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_lot_content';


    protected $fillable = [
        'sales_lot_id','box_id','device_id', 'picked'
    ];

    public function getBoxName(){
        $box = Tray::find($this->box_id);

        if($box){
            return $box->tray_name;
        }

        return null;
    }
}
