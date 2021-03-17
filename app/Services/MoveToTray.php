<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;


class MoveToTray{


    public static function checkTrayValidity(Request $request, Tradein $tradein, Tray $tray){
        
        #dd(!($tray->tray_grade === 0 && $tradein->getBambooStatus() === "Blacklisted"));

        if(($tray->tray_grade === 0 && $tradein->getBambooStatus() === "Blacklisted")){
            dd("here");
            return true;
        }
        if($tray->tray_brand !== $tradein->getBrandLetter($tradein->product_id)){
            dd("here2");
            return false;
        }
        if($tray->tray_grade !== $tradein->cosmetic_condition){
            dd("here3");
            return false;
        }
        
        return true;

    }

}