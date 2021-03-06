<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;


class Boxing{

    public function checkBoxStatusForDevice(Tradein $tradein, Tray $box, Request $request){


        $traycontent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($traycontent !== null){
            $tray = Tray::where('id', $traycontent->tray_id)->first();

            if($traycontent->pseudo_tray_id === $box->id){
                return ['This device is already in this box', 404];
            }

            if($tray->tray_type === 'Bo'){
                return ['This device is already in the box.' . $tray->tray_name . '.', 404];
            }
        }

        if($box->number_of_devices === $box->max_number_of_devices){
            return ['Box is at it\'s capacity. Please create new box.', 404];
        }

        if($tradein->isBoxed()){
            return ['Device is already boxed to other box.', 404];
        }

        if($box->tray_grade == "BL"){
            $blacklisted = ["7", "8a", "8b", "8c", "8d", "8e", "8f"];
            if(in_array($tradein->job_state, $blacklisted)){
                return ['', 200];
            }
            else{
                return ['Device is not blacklisted', 404];
            }
        }

        if(!($tradein->deviceInPaymentProcess())){
            return ['Tradein with barcode ' . $tradein->barcode .' is not submitted for payment yet.', 404];
        }

        if(($box->tray_grade === 'TAB' && $tradein->getCategoryId($tradein->correct_product_id) === 2) || ($box->tray_grade === 'SW' && $tradein->getCategoryId($tradein->correct_product_id) === 3)){
            return ['', 200];
        }
        else{
            if($box->tray_grade === 'TAB' && $tradein->getCategoryId($tradein->correct_product_id) !== 2){
                return ['Device is not a tablet.', 404];
            }
            if($tradein->isTablet() && $box->tray_grade !== 'TAB'){
                return ['Box is not accepting tablets.', 404];
            }

            if($box->tray_grade === 'SW' && $tradein->getCategoryId($tradein->correct_product_id) !== 3){
                return ['Device is not a watch.', 404];
            }
            if($tradein->isSmartWatch() && $box->tray_grade !== 'SW'){
                return ['Box is not accepting tablets.', 404];
            }

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
            return ['Manufacturer is wrong.', 404];
        }

        if($box->getBoxBrand() !== $tradein->getBrandId($tradein->correct_product_id)){
            if($box->getBoxBrand() === 4 && $tradein->getBrandId($tradein->correct_product_id)>=4){
                return ['Device can be added to this box.', 200];
            }
            else{
                return ['Manufacturer is wrong.', 200];
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