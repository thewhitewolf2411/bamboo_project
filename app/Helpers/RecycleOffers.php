<?php

namespace App\Helpers;

use App\Eloquent\RecycleOffer;
use Carbon\Carbon;

class RecycleOffers{    

    public static function check(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return json_encode([
                'desktop' => $offer->getImage(), 
                'mobile' => $offer->getMobileImage(), 
                'tablet' =>  $offer->getTabletImage()
            ]);
        }
        return null;
    }

    public static function getLink(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->getDeviceLink();
        }
        return null;
    }

    public static function getSellBanner(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return json_encode([
                'desktop' => $offer->getSellingBanner(), 
                'mobile' => $offer->getMobileSellingBanner(), 
                'tablet' =>  $offer->getTabletSellingBanner()
            ]);
        }
        return null;
    }
}