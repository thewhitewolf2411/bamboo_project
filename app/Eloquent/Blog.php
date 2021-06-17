<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cms_type', 'cms_title', 'cms_parg_1', 'cms_parg_2', 'cms_parg_3', 'image_1', 'image_2', 'image_3', 'author'
    ];

    public function getBlogType(){
        if($this->cms_type === 0){
            return "News";
        }
        if($this->cms_type === 1){
            return "Blog";
        }
        if($this->cms_type === 2){
            return "How to with boo";
        }
    }

    public function getType(){
        dd($this);
    }

    public function getFirstImage(){
        if($this->image_1 === 'news_stock_image.png'){
            return asset($this->image_1);
        } else {
            return "/storage/news_images/".$this->image_1;
        }
    }
}
