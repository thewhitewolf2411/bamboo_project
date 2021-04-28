<?php

namespace App\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RecycleOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recycle_offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id', 
        'offer_banner', 
        'offer_selling_banner', 
        // 'offer_title', 
        // 'offer_description', 
        // 'offer_additional_info', 
        // 'offer_start_date', 
        // 'offer_end_date', 
        // 'offer_price', 
        'status'
    ];

    public function getDevice(){
        return SellingProduct::find($this->device_id)->product_name;
    }

    public function getStartDate(){
        return Carbon::parse($this->offer_start_date)->format('d.m');
    }

    public function getEndDate(){
        return Carbon::parse($this->offer_end_date)->format('d.m');
    }

    public function getStatus(){
    }

    public function getImage(){
        // for seeded recycle offer
        if($this->offer_banner === 'recycle_offer_home.svg'){
            return '/'.$this->offer_banner;
        }
        return Storage::url('public/recycle_offers_images/'.$this->offer_banner);
    }

    public function getSellingBanner(){
        // for seeded recycle offer
        if($this->offer_selling_banner === 'recycle_offer_selling_banner.png'){
            return '/'.$this->offer_selling_banner;
        }
        return Storage::url('public/recycle_offers_images/'.$this->offer_selling_banner);
    }

    public function getInputStartDate(){
        return Carbon::parse($this->offer_start_date)->format('Y-m-d');
    }

    public function getInputEndDate(){
        return Carbon::parse($this->offer_end_date)->format('Y-m-d');
    }

    public function getDeviceLink(){
        return '/sell/sellitem/'.$this->device_id;
    }
}
