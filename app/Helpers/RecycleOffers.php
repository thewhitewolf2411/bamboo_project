<?php

namespace App\Helpers;

use App\Eloquent\RecycleOffer;
use Carbon\Carbon;

class RecycleOffers{    

    public static function check(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->getImage();
        }
        return null;
    }

    public static function getDevice(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->getDevice();
        }
        return null;
    }

    public static function getTitle(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->offer_title;
        }
        return null;
    }

    public static function getDescription(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->offer_description;
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

    public static function getMisc(){
        $offer = RecycleOffer::where('status', 1)->first();
        if($offer){
            return $offer->offer_additional_info;
        }
        return null;
    }
}