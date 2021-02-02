<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;


class Boxing{

    public function checkBoxStatusForDevice(Tradein $tradein, Tray $box, Request $request){

        if($this->getDeviceGrade($tradein) === 'A' || $this->getDeviceGrade($tradein) === 'B+' || $this->getDeviceGrade($tradein) === 'B' || $this->getDeviceGrade($tradein) === 'C'){
            if($box->tray_network === 'unlocked'){
                if($tradein->deviceLocked() === false){
                    return ['Device is locked to network and cannot be added to this box.', 404];
                }
                else{
                    if($box->number_of_devices === $box->max_number_of_devices){
                        return ['Box is at it\'s capacity. Please create new box.', 404];
                    }
                    else{
                        goto test;
                    }
                }
            }
            else{
                if($tradein->deviceLocked() === true){
                    if($box->number_of_devices === $box->max_number_of_devices){
                        return ['Box is at it\'s capacity. Please create new box.', 404];
                    }
                    else{
                        goto test;
                    }
                }
                else{
                    return ['Device is unlocked and cannot be added to this box.', 404];
                }
            }
        }

        test:
        if($tradein->job_state !== '21'){
            return ['Tradein with barcode ' . $request->tradeinid .' is not submitted for payment yet.', 404];
        }
        else{
            if($box->tray_brand === $tradein->getBrandLetter($tradein->product_id) && $box->box_devices === $tradein->getCategoryId($tradein->product_id)){
                if($box->tray_grade === $this->getDeviceGrade($tradein)){
                    return ['Device can be added to this box.', 200];
                }
                elseif($this->getDeviceGrade($tradein) === false){
                    return ['Offer for this device has not been accepted by customer yet.', 404];
                    
                }
                else{
                    return ['This device grade is not matching box grade.', 404];
                }
            }
            else{
                if($box->tray_brand !== $tradein->getBrandLetter($tradein->product_id)){
                    return ['Manifacturer is wrong.', 404];
                }
                if($box->box_devices !== $tradein->getCategoryId($tradein->product_id)){

                    $message = "";
                    switch($box->box_devices){
                        case 1:
                            $message = "Device is not a mobile phone.";
                            break;
                        case 2:
                            $message = "Device is not a tablet.";
                            break;
                        case 3:
                            $message = "Device is not a smartwatch.";
                            break;
                    }

                    return [$message, 404];
                }
                
            }
        }

    }

    public function getDeviceGrade(Tradein $tradein){
        if(($tradein->isInQuarantine() && $tradein->offer_accepted === true) || $tradein->job_state === '21'){
            return $tradein->cosmetic_condition;
        }
        elseif($tradein->isInQuarantine() && $tradein->offer_accepted !== true){
            return false;
        }
    }

}


?>