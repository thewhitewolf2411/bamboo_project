<?php

namespace App\Helpers;

use App\Eloquent\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationHelper {

    public static function count(){
        if(Auth::user()){
            // $notifications = Notification::where('user_id', Auth::user()->id)->where('status', 'alert')->where('resolved', false)->get();
            $notifications = Notification::where('user_id', Auth::user()->id)->get();            
            $total = $notifications->count();
            if($total > 0){
                return $total;
            }
            return null;
        }
        return null;
    }
    
    public static function hasTestingAlerts(){
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->where('type', 12)
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }

    public static function hasProcessingAlerts(){
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->whereIn('type', [6,7,8,9,14])
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }

    public static function hasPaymentAlerts(){
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->where('type', 13)
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }

}