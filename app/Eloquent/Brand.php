<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;


class Brand extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brand';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name','brand_image','total_produts'
    ];

    public function getNumberOfDevices($brandid){

        return count(SellingProduct::where('brand_id', $brandid)->get());

    }

    public function getBrandFirstName(){
        if($this->id === 1){
            return "Apple";
        }
        else if($this->id === 2){
            return "Samsung";
        }
        else if($this->id === 3){
            return "Huawei";
        }
        else{
            return "Miscellaneous";
        }
    }
}
