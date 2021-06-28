<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class SellingProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'selling_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','product_image','category_id','brand_id', 'avaliable_for_sell'
    ];

    public function getBrand(){
        $brandName = Brand::where('id', $this->brand_id)->first();
        #dd($brandName[0]->brand_name);
        if($brandName == null){
            return "Unknown";
        }
        $brandName = $brandName->brand_name;
        return $brandName;
    }

    public function getCategory($category_id){
        $categoryName = Category::where('id', $category_id)->get('category_name');
        return $categoryName[0]->category_name;
    }

    public function getImage(){
        // DEVELOPMENT ONLY
        if(URL::to('/') === 'http://127.0.0.1:8000'){
            switch ($this->category_id) {
                case 1:
                    return asset('example_phone_image.jpg');
                    break;
                case 2:
                    return asset('example_tablet_image.png');
                    break;
                case 3:
                    return asset('example_watch_image.png');
                    break;
                default:
                    break;
            }
        }
        return asset('/storage/product_images').'/'.$this->product_image;
    }
}
