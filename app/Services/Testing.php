<?php 
namespace App\Services;

use app\Eloquent\Tradein;
use Illuminate\Http\Request;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;

class Testing{

    public function testDevice(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        if($tradein->job_state === "14" || $tradein->hasDeviceBeenTestedSecondTime()){

            if($request->pin_lock === "true"){
                
                $tradein->job_state = "15c";
                $tradein->save();
            }
            else{
                if($request->fimp_or_google_lock === "true"){
                    if($tradein->getBrandId($tradein->product_id) === 1){
                        $tradein->job_state = "15a";
                    }
                    else{
                        $tradein->job_state = "15b";
                    }
                    $tradein->save();
                }
            }

            $quarantineTrays = "";
            $quarantineName = "";

            $bambooprice = null;
            if($tradein->isInQuarantine()){
                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            else{
                $bambogradeval = $request->bamboo_customer_grade;
                // if($request->device_correct === "false" || $request->correct_memory === "false" || $request->correct_network === "false"){
                    
                    if($request->device_correct === "false"){
                        $tradein->correct_product_id = $request->select_correct_device;
                    }
                    else{
                        $tradein->correct_product_id = $request->product_id;
                    }
                    if($request->correct_memory === "false"){
                        $tradein->correct_memory = $request->correct_memory_value;
                    }
                    else{
                        $tradein->correct_memory = $request->customer_memory;
                    }
                    if($request->correct_network === "false"){
                        $tradein->correct_network = $request->correct_network_value;
                    }
                    else{
                        $tradein->correct_memory = $request->customer_network;
                    }
                // }

                $bambooprice = $this->generateDevicePrice($tradein->correct_product_id, $tradein->correct_memory, $tradein->correct_network, $bambogradeval);
                $tradein->bamboo_price = $bambooprice;
                if($bambooprice >= $tradein->order_price){
                    switch($bambogradeval){
                        case 5:
                            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'A')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            break;
                        case 4:
                            if($request->cosmetic_condition === "Grade B+"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B+')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            else{
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                        case 3:
                            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'C')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            break;
                        case 2:
                            if($request->cosmetic_condition === "WSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            else{
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                        case 1:
                            if($request->cosmetic_condition === "WSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "WSD"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "NWSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "NWSD"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "Catastrophic"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'CAT')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                    }
                }
                else{
                    if($request->device_correct === "false"){
                        $tradein->job_state = '15d';
                    }
                    elseif($request->correct_memory === "false" || $request->correct_network === "false"){
                        if($request->correct_memory === "false"){
                            $tradein->job_state = '15f';
                        }
                        if($request->correct_network === "false"){
                            $tradein->job_state = '15g';
                        }
                    }
                    else{
                        if($request->water_damage === 'true'){
                            $tradein->job_state = '15h';
                        }
                        else if($request->device_fully_functional !== 'true'){
                            $tradein->job_state = '15e';
                        }
                        else{
                            $tradein->job_state = '15i';
                        }
                    }
                    $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
                    $quarantineName = $quarantineTrays->tray_name;
                }
            }

            $tradein->bamboo_price = $bambooprice;
            $tradein->save();
    
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
    
            $quarantineName = $quarantineTrays->tray_name;
    
            return ['tray_name'=>$quarantineName, 'tray'=>$quarantineTrays];

        }
        else{

            if($request->pin_lock === "true"){
                
                $tradein->job_state = "11c";
                $tradein->save();
            }
            else{
                if($request->fimp_or_google_lock === "true"){
                    if($tradein->getBrandId($tradein->product_id) === 1){
                        $tradein->job_state = "11a";
                    }
                    else{
                        $tradein->job_state = "11b";
                    }
                    $tradein->save();
                }
            }

            $quarantineTrays = "";
            $quarantineName = "";

            $bambooprice = null;
            if($tradein->isInQuarantine()){
                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            else{
                $bambogradeval = $request->bamboo_customer_grade;
                // if($request->device_correct === "false" || $request->correct_memory === "false" || $request->correct_network === "false"){
                    
                    if($request->device_correct === "false"){
                        $tradein->correct_product_id = $request->select_correct_device;
                    }
                    else{
                        $tradein->correct_product_id=$tradein->product_id;
                    }
                    if($request->correct_memory === "false"){
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
                // }

                $tradein->save();

                $bambooprice = $this->generateDevicePrice($tradein->correct_product_id, $tradein->correct_memory, $tradein->correct_network, $bambogradeval);
                $tradein->bamboo_price = $bambooprice;
                if($bambooprice >= $tradein->order_price){
                    switch($bambogradeval){
                        case 5:
                            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'A')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            break;
                        case 4:
                            if($request->cosmetic_condition === "Grade B+"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B+')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            else{
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'B')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                        case 3:
                            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'C')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            break;
                        case 2:
                            if($request->cosmetic_condition === "WSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            else{
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                        case 1:
                            if($request->cosmetic_condition === "WSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "WSD"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'WSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "NWSI"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSI')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "NWSD"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'NWSD')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            if($request->cosmetic_condition === "Catastrophic"){
                                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'CAT')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<=" ,100)->first();
                            }
                            break;
                    }
                }
                else{
                    if($request->device_correct === "false"){
                        $tradein->job_state = '11d';
                    }
                    elseif($request->correct_memory === "false" || $request->correct_network === "false"){
                        if($request->correct_memory === "false"){
                            $tradein->job_state = '11f';
                        }
                        if($request->correct_network === "false"){
                            $tradein->job_state = '11g';
                        }
                    }
                    else{
                        if($request->water_damage === 'true'){
                            $tradein->job_state = '11h';
                        }
                        else if($request->device_fully_functional !== 'true'){
                            $tradein->job_state = '11e';
                        }
                        else{
                            $tradein->job_state = '11i';
                        }
                    }
                    $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
                    $quarantineName = $quarantineTrays->tray_name;
                }
            }

            $tradein->bamboo_price = $bambooprice;
            $tradein->save();
    
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
    
            $quarantineName = $quarantineTrays->tray_name;
    
            return ['tray_name'=>$quarantineName, 'tray'=>$quarantineTrays];
        }

    }

    public function generateDevicePrice($deviceID, $deviceMemory, $deviceNetwork, $deviceCondition){

        #dd($deviceNetwork);

        $price = 0;
        $basePrice = ProductInformation::where('product_id', $deviceID)->where('memory', $deviceMemory)->first();

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
        }


        $deviceNetworks = ProductNetworks::where('product_id', $deviceID)->get();

        foreach($deviceNetworks as $dN){
            #dd($dN->getNetWorkName($dN->network_id) === $deviceNetwork);
            if($dN->getNetWorkName($dN->network_id) === $deviceNetwork ){
                $price = $price - $dN->knockoff_price;
            }
        }

        return $price;
    }

}


?>