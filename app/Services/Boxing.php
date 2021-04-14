<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;


class Boxing{

    public function checkBoxStatusForDevice(Tradein $tradein, Tray $box, Request $request){


        $traycontent = TrayContent::where('trade_in_id', $tradein->id)->first();
        $tray = Tray::where('id', $traycontent->tray_id)->first();

        if($tray->tray_type === 'Bo'){
            return ['This device is already in the box ' . $tray->tray_name . '.', 404];
        }

        if($box->number_of_devices === $box->max_number_of_devices){
            return ['Box is at it\'s capacity. Please create new box.', 404];
        }

        if($tradein->isBoxed()){
            return ['Device is already boxed to other box.', 404];
        }

        if(!($tradein->deviceInPaymentProcess())){
            return ['Tradein with barcode ' . $request->tradeinid .' is not submitted for payment yet.', 404];
        }

        if(($box->tray_grade === 'TAB' && $tradein->getCategoryId($tradein->correct_product_id) === 2) || ($box->tray_grade === 'SW' && $tradein->getCategoryId($tradein->correct_product_id) === 3)){
            return ['', 200];
        }

        if($tradein->cosmetic_condition !== $box->tray_grade){
            return ['This device grade is not matching box grade.', 404];
        }

        if($box->tray_network !== null){
            if(!(($box->tray_network === 'Unlocked' && $tradein->deviceLocked() === false) || ($box->tray_network !== 'Unlocked' && $tradein->deviceLocked() === true))){
                return ['Network missmatch. Cannot add this device to this box.', 404];
            }
        }
        
        if($this->getDeviceGrade($tradein) === false){
            return ['Offer for this device has not been accepted by customer yet.', 404];
        }

        if(substr($box->tray_brand, 0, 1) !== $tradein->getBrandLetter($tradein->correct_product_id)){
            return ['Device can be added to this box.', 404];
        }

        if($box->getBoxBrand() !== $tradein->getBrandId($tradein->correct_product_id)){
            if($box->getBoxBrand() === 4 && $tradein->getBrandId($tradein->correct_product_id)>=4){
                return ['Device can be added to this box.', 200];
            }
            else{
                return ['Device manufacturer not matching box manufacturer.', 200];
            }
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