<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;
use App\Eloquent\TestingFaults;
use App\User;

class Testing{

    public function testDevice(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $tradein->product_colour = $request->device_color;

        if($request->cosmetic_condition === 'Catastrophic'){
            if($tradein->customer_grade !== 'Faulty'){
                $tradein->job_state = '15i';
            }
            $tradein->bamboo_grade = 'Catastrophic';
        }
        else{
            $tradein->bamboo_grade = $request->bamboo_final_grade;
        }

        if($request->device_fully_functional === 'false'){

            $tradein->fully_functional = 'No';
            
            $testingFaults = new TestingFaults();
            $testingFaults->tradein_id = $request->tradein_id;
            if(isset($request->audio_tests) && $request->audio_tests === 'true'){
                $testingFaults->audio_test = true;
            }
            if(isset($request->front_microphone) && $request->front_microphone === 'true'){
                $testingFaults->front_microphone = true;
            }
            if(isset($request->headset_test) && $request->headset_test === 'true'){
                $testingFaults->headset_test = true;
            }
            if(isset($request->loud_speaker_test) && $request->loud_speaker_test === 'true'){
                $testingFaults->loud_speaker_test = true;
            }
            if(isset($request->microphone_playback_test) && $request->microphone_playback_test === 'true'){
                $testingFaults->microphone_playback_test = true;
            }
            if(isset($request->buttons_test) && $request->buttons_test === 'true'){
                $testingFaults->buttons_test = true;
            }
            if(isset($request->camera_test) && $request->camera_test === 'true'){
                $testingFaults->camera_test = true;
            }
            if(isset($request->sensor_test) && $request->sensor_test === 'true'){
                $testingFaults->sensor_test = true;
            }
            if(isset($request->glass_condition) && $request->glass_condition === 'true'){
                $testingFaults->glass_condition = true;
            }
            if(isset($request->vibration) && $request->vibration === 'true'){
                $testingFaults->vibration = true;
            }
            if(isset($request->original_colour) && $request->original_colour === 'true'){
                $testingFaults->original_colour = true;
            }
            if(isset($request->battery_health) && $request->battery_health === 'true'){
                $testingFaults->battery_health = true;
            }
            if(isset($request->nfc) && $request->nfc === 'true'){
                $testingFaults->nfc = true;
            }
            if(isset($request->no_power) && $request->no_power === 'true'){
                $testingFaults->no_power = true;
            }
            if(isset($request->fake_missing_parts) && $request->fake_missing_parts === 'true'){
                $testingFaults->fake_missing_parts = true;
            }
            if(isset($request->knox_removed) && $request->knox_removed === 'true'){
                $testingFaults->knox_removed = true;
            }

            $testingFaults->save();
        }
        else{
            $tradein->fully_functional = 'Yes';
        }

        if($request->pin_lock === "true"){
            $tradein->job_state = "15c";
            $tradein->pin_locked = true;
        }
        else if($request->fimp_or_google_lock === "true"){
            if($tradein->getBrandId($tradein->product_id) === 1){
                $tradein->job_state = "15a";
                $tradein->fmip_gock = true;
            }
            else{
                $tradein->job_state = "15b";
                $tradein->fmip_gock = true;
            }
        }
        else{
            if($request->water_damage === 'true' && $tradein->customer_grade !== 'Faulty'){
                $tradein->cosmetic_condition = $request->cosmetic_condition;
                $tradein->job_state = '15h';
            }
            else if($request->device_fully_functional !== 'true' && $tradein->customer_grade !== 'Faulty'){
                $tradein->job_state = '15e';
            }
        }
        if($request->device_correct === "false"){
            $tradein->correct_product_id = $request->select_correct_device;
        }
        else{
            $tradein->correct_product_id = $tradein->product_id;
        }

        if($request->correct_memory === "false" || !isset($request->correct_memory)){
            $tradein->correct_memory = $request->correct_memory_value;
        }
        else{
            $tradein->correct_memory = $tradein->customer_memory;
        }
        if($request->correct_network === "false"){
            $tradein->correct_network = $request->correct_network_value;
        }
        else{
            $tradein->correct_network = $tradein->customer_network;
        }

        $bambogradeval = $request->bamboo_customer_grade;
        $bambooprice = $this->generateDevicePrice($tradein->correct_product_id, $tradein->correct_memory, $tradein->correct_network, $bambogradeval);
        $tradein->bamboo_price = $bambooprice;

        if($bambooprice < $tradein->order_price){
            if(!($tradein->job_state === "15c" || $tradein->job_state === "15b" || $tradein->job_state === "15a")){
                #dd($tradein->job_state !== "15c", $tradein->job_state !== "15b", $tradein->job_state !== "15a");
                if($request->device_correct === "false"){
                    $tradein->job_state = '15d';
                }elseif($request->correct_memory === "false" || $request->correct_network === "false"){
                    if($request->correct_memory === "false"){
                        $tradein->job_state = '15f';
                    }
                    if($request->correct_network === "false"){
                        $tradein->job_state = '15g';
                    }
                }
                else{
                    if($request->water_damage === 'true' && $tradein->customer_grade !== 'Faulty'){
                        $tradein->cosmetic_condition = $request->cosmetic_condition;
                        $tradein->job_state = '15h';
                    }
                    else if($request->device_fully_functional !== 'true' && $tradein->customer_grade !== 'Faulty'){
                        $tradein->job_state = '15e';
                    }
                    else{
                        $tradein->job_state = "15i";
                    }
                }
            }
        }


        $quarantineTrays = "";
        $quarantineName = "";

        if($tradein->isInQuarantine()){
            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;
            $tradein->quarantine_date = \Carbon\Carbon::now();
            switch($bambogradeval){
                case 5:
                    //$tradein->customer_grade = 'Excellent Working';
                    $tradein->cosmetic_condition = 'A';
                    break;
                case 4:
                    if($request->cosmetic_condition === "Grade B+"){
                        //$tradein->customer_grade = 'Good Working';
                        $tradein->cosmetic_condition = 'B+';
                    }
                    else{
                        //$tradein->customer_grade = 'Good Working';
                        $tradein->cosmetic_condition = 'B';
                    }
                    break;
                case 3:
                    //$tradein->customer_grade = 'Poor Working';
                    $tradein->cosmetic_condition = 'C';
                    break;
                case 2:
                    if($request->cosmetic_condition === "WSI"){
                        //$tradein->customer_grade = 'Damaged Working';
                        $tradein->cosmetic_condition = 'WSI';
                    }
                    else{
                        //$tradein->customer_grade = 'Damaged Working';
                        $tradein->cosmetic_condition = 'WSD';
                    }
                    break;
                case 1:
                case 0:
                    if($request->cosmetic_condition === "WSI"){
                        //$tradein->customer_grade = 'Faulty';
                        $tradein->cosmetic_condition = 'WSI';
                    }
                    if($request->cosmetic_condition === "WSD"){
                        //$tradein->customer_grade = 'Faulty';
                        $tradein->cosmetic_condition = 'WSD';
                    }
                    if($request->cosmetic_condition === "NWSI"){
                        //$tradein->customer_grade = 'Faulty';
                        $tradein->cosmetic_condition = 'NWSI';
                    }
                    if($request->cosmetic_condition === "NWSD"){
                        //$tradein->customer_grade = 'Faulty';
                        $tradein->cosmetic_condition = 'NWSD';
                    }
                    if($request->cosmetic_condition === "Catastrophic"){

                        //$tradein->customer_grade = 'Faulty';
                    }
                    break;
            }
        }
        else{

            //$tradein->job_state = "10";

            if($tradein->job_state === "9" || $tradein->job_state === "9a" || $tradein->job_state === "9b"){
                $tradein->job_state = "10";
            }else if($tradein->job_state === "14" || $tradein->job_state === "13"){
                $tradein->job_state = "16";
            }
            switch($bambogradeval){
                case 5:
                    $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'A')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                    #dd($quarantineTrays);
                    $tradein->cosmetic_condition = 'A';
                    //$tradein->customer_grade = 'Excellent Working';
                    break;
                case 4:
                    if($request->cosmetic_condition === "Grade B+"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B+')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'B+';
                        //$tradein->customer_grade = 'Good Working';
                    }
                    else{
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'B';
                        //$tradein->customer_grade = 'Good Working';
                    }
                    break;
                case 3:
                    $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'C')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                    $tradein->cosmetic_condition = 'C';
                    //$tradein->customer_grade = 'Poor Working';
                    break;
                case 2:
                    if($request->cosmetic_condition === "WSI"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'WSI';
                        //$tradein->customer_grade = 'Damaged Working';
                    }
                    else{
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'WSD';
                        //$tradein->customer_grade = 'Damaged Working';
                    }
                    break;
                case 1:
                case 0:
                    if($request->cosmetic_condition === "WSI"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'WSI';
                        //$tradein->customer_grade = 'Faulty';
                    }
                    if($request->cosmetic_condition === "WSD"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'WSD';
                        //$tradein->customer_grade = 'Faulty';
                    }
                    if($request->cosmetic_condition === "NWSI"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSI')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'NWSI';
                        //$tradein->customer_grade = 'Faulty';
                    }
                    if($request->cosmetic_condition === "NWSD"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSD')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'NWSD';
                        //$tradein->customer_grade = 'Faulty';
                    }
                    if($request->cosmetic_condition === "Catastrophic"){
                        $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'E')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
                        $tradein->cosmetic_condition = 'CAT';
                        //$tradein->customer_grade = 'Faulty';
                    }
                    break;
            }
        }

        if($quarantineTrays === null){
            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'E')->where('tray_brand',$tradein->getBrandLetter($tradein->correct_product_id))->where('number_of_devices', "<" ,100)->first();
        }

        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
        $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
        $oldTray->save();

        $oldTrayContent->delete();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();
        $tradein->save();

        $quarantineName = $quarantineTrays->tray_name;

        return ['tray_name'=>$quarantineName, 'tray'=>$quarantineTrays];

    }

    public function generateDevicePrice($deviceID, $deviceMemory, $deviceNetwork, $deviceCondition){

        #dd($deviceID, $deviceMemory, $deviceNetwork, $deviceCondition);
        #dd($deviceNetwork);

        $price = 0;
        $basePrice = ProductInformation::where('product_id', $deviceID)->where('memory', $deviceMemory)->first();
        #dd($basePrice);
        switch($deviceCondition){
            case 5:
                $price += $basePrice->excellent_working;
                break;
            case 4:
                $price += $basePrice->good_working;
                break;
            case 3:
                $price += $basePrice->poor_working;
                break;
            case 2:
                $price += $basePrice->damaged_working;
                break;
            case 1:
                $price += $basePrice->faulty;
                break;
            case 0:
                $price += $basePrice->faulty;
                break;
        }

        $deviceNetworks = ProductNetworks::where('product_id', $deviceID)->get();

        foreach($deviceNetworks as $dN){
            if($dN->getNetWorkName($dN->network_id) === $deviceNetwork ){
                $price = $price - $dN->knockoff_price;
            }
        }

        return $price;
    }
}


?>