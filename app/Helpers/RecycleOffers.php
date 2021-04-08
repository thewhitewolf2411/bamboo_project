<?php

namespace App\Helpers;

use App\Eloquent\RecycleOffer;
use Carbon\Carbon;

class RecycleOffers{    

    public static function check(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->getImage();
            }
        }
        return null;
    }

    public static function getDevice(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->getDevice();
            }
        }
        return null;
    }

    public static function getTitle(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->offer_title;
            }
        }
        return null;
    }

    public static function getDescription(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->offer_description;
            }
        }
        return null;
    }

    public static function getLink(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->getDeviceLink();
            }
        }
        return null;
    }

    public static function getMisc(){
        $offers = RecycleOffer::all();
        foreach($offers as $offer){
            $now = Carbon::now();
            $start_date = Carbon::parse($offer->offer_start_date);
            $end_date = Carbon::parse($offer->offer_end_date);
            if($now->between($start_date, $end_date)){
                return $offer->offer_additional_info;
            }
        }
        return null;
    }
}