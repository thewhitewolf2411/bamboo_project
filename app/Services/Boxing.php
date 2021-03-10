<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;


class Boxing{

    public function checkBoxStatusForDevice(Tradein $tradein, Tray $box, Request $request){

        #dd($tradein, $box, $request);

        if($request->tradeinid === ''){
            return ['Please input device barcode.', 404];
        }

        $traycontent = TrayContent::where('trade_in_id', $tradein->id)->where('tray_id', $box->id)->first();
        if($traycontent !== null){
            return ['This device is already in the box.', 404];
        }

        if($box->number_of_devices === $box->max_number_of_devices){
            return ['Box is at it\'s capacity. Please create new box.', 404];
        }

        if($tradein->isBoxed()){
            return ['Device is already boxed to other box. You can move it to this box.', 200];
        }

        if($tradein->cosmetic_condition !== $box->tray_grade){
            return ['This device grade is not matching box grade.', 404];
        }

        if(!($tradein->deviceInPaymentProcess())){
            return ['Tradein with barcode ' . $request->tradeinid .' is not submitted for payment yet.', 404];
        }

        if(!(($box->tray_network === 'Unlocked' && $tradein->deviceLocked() === false) || ($box->tray_network !== 'Unlocked' && $tradein->deviceLocked() === true))){
            return ['Network missmatch. Cannot add this device to this box.', 404];
        }

        if($this->getDeviceGrade($tradein) === false){
            return ['Offer for this device has not been accepted by customer yet.', 404];
            
        }

        if(substr($box->tray_brand, 0, 1) !== $tradein->getBrandLetter($tradein->product_id)){
            return ['Manifacturer is wrong.', 404];
        }
        if($box->getBoxBrand() !== $tradein->getBrandId($tradein->product_id)){
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
        return ['Device can be added to this box.', 200];
        
    }

    public function getDeviceGrade(Tradein $tradein){
        if(($tradein->isInQuarantine() && $tradein->offer_accepted === true) || $tradein->deviceInPaymentProcess()){
            return $tradein->cosmetic_condition;
        }
        elseif($tradein->isInQuarantine() && $tradein->offer_accepted !== true){
            return false;
        }
    }

}


?>