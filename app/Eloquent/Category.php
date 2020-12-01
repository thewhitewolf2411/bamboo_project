<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

use App\Eloquent\SellingProduct;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'category_description', 'category_image','total_produts'
    ];

    public function getNumberOfDevices($categoryid){

        return count(SellingProduct::where('category_id', $categoryid)->get());

    }

}
