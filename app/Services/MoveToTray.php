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
            if($tray->tray_brand !== $tradein->getBrandLetter($tradein->product_id)){
                return false;
            }
            if($tray->tray_grade !== $tradein->cosmetic_condition){
                return false;
            }
        }

        
        return true;

    }

}