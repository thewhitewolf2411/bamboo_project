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
        $bambooprice = "";
        if($tradein->isInQuarantine()){
            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;
        }
        else{
            $bambogradeval = $request->bamboo_customer_grade;

            if($request->device_correct === "false" || $request->correct_memory === "false" || $request->correct_network === "false"){
                if($request->device_correct === "false" && $request->correct_memory !== "false" && $request->correct_network !== "false"){
                    $bambooprice = $this->generateDevicePrice($request->select_correct_device, $tradein->customer_memory, $tradein->customer_network, $bambogradeval);
                }
                elseif($request->device_correct !== "false" && $request->correct_memory === "false" && $request->correct_network === "false"){
                    $bambooprice = $this->generateDevicePrice($tradein->product_id, $request->correct_memory_value, $request->correct_network_value, $bambogradeval);
                }
                elseif($request->device_correct !== "false" && $request->correct_memory !== "false" && $request->correct_network === "false"){
                    $bambooprice = $this->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $request->correct_network_value, $bambogradeval);
                }
                elseif($request->device_correct !== "false" && $request->correct_memory === "false" && $request->correct_network !== "false"){
                    $bambooprice = $this->generateDevicePrice($tradein->product_id, $request->correct_memory_value, $tradein->customer_network, $bambogradeval);
                }
                elseif($request->device_correct === "false" && $request->correct_memory === "false" && $request->correct_network !== "false"){
                    $bambooprice = $this->generateDevicePrice($request->select_correct_device, $request->correct_memory_value, $tradein->customer_network, $bambogradeval);
                }
                elseif($request->device_correct === "false" && $request->correct_memory !== "false" && $request->correct_network === "false"){
                    $bambooprice = $this->generateDevicePrice($request->select_correct_device, $tradein->customer_memory, $request->correct_network_value, $bambogradeval);
                }
                elseif($request->device_correct === "false" && $request->correct_memory === "false" && $request->correct_network === "false"){
                    $bambooprice = $this->generateDevicePrice($request->select_correct_device, $request->correct_memory_value, $request->correct_network_value, $bambogradeval);
                }
            }

            if($bambooprice >= $tradein->order_price){
                $customergradeval = "";
                $bambogradeval = $request->bamboo_customer_grade;
                $old_customer_grade = $request->old_customer_grade;
    
                if($old_customer_grade == "Excellent Working"){
                    $customergradeval = 5;
                }
                if($old_customer_grade == "Good Working"){
                    $customergradeval = 4;
                }
                if($old_customer_grade == "Poor Working"){
                    $customergradeval = 3;
                }
                if($old_customer_grade == "Damaged Working"){
                    $customergradeval = 2;
                }
                if($old_customer_grade == "Faulty"){
                    $customergradeval = 1;
                }
    
                if($bambogradeval < $customergradeval){
                    $tradein->job_state = '11i';
                }
            }
            else{
                if($request->device_correct === "false"){
                    $tradein->job_state = '11d';
                    $tradein->save();
                }
                else{
                    if($request->correct_memory === "false"){
                        $tradein->job_state = '11f';
                        $tradein->save();
                    }
                    if($request->correct_memory === "false"){
                        $tradein->job_state = '11g';
                        $tradein->save();
                    }
                }
            }
            if($tradein->isInQuarantine()){
                $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            else{
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

        $quarantineName = $quarantineTrays->tray_name;

        return ['tray_name'=>$quarantineName, 'tray'=>$quarantineTrays];

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