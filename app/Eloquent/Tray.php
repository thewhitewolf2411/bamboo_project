<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\Trolley;

class Tray extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tray_name','trolley_id','number_of_devices'
    ];

    public function getTrolleyName($trolley_id){
        $trolley = Trolley::where('id', $trolley_id)->first();
        return $trolley->trolley_name;
    }
}
