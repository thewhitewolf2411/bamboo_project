<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DNS1D;
use DNS2D;
use PDF;
use App\User;
use Carbon\Carbon;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductInformation;
use App\Eloquent\ImeiResult;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Network;
use App\Eloquent\Colour;
use App\Eloquent\TestingFaults;
use App\Eloquent\ProductNetworks;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

class TestingController extends Controller
{
    public function showTestingPage(){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.testing')->with('portalUser', $portalUser);
    }

    public function showReceiveTradeIn(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receive')->with('portalUser', $portalUser);
    }

    public function showFindTradeIn(){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.find')->with('portalUser', $portalUser);
    }

    public function find(Request $request){

        #dd($request);
        //if(!$this->checkAuthLevel(5)){return redirect('/');}


        $barcode = $request->scanid;

        $tradein = Tradein::where('barcode', $request->scanid)->first();

        if($tradein == null){
            return redirect()->back()->with('error', 'There is no such device');
        }
        if($tradein->job_state < 3){
            return redirect()->back()->with('error', 'Device has not been received yet, or has been sent to quarantine.');
        }
        elseif($tradein->job_state == 5){
            return redirect()->back()->with('error', 'Device was already tested.');
        }
        elseif($tradein->job_state != 6 && $tradein->marked_for_quarantine){
            return redirect()->back()->with('error', 'Device was marked for quarantine on receiving and cannot be tested. If this device is in your tray, please remove it.');
        }
        else{
            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();
            $networks = Network::all();
            $productinformation = ProductInformation::where('product_id', $tradein->product_id)->get();
            $productColors = Colour::where('product_id', $tradein->product_id)->get();
            $sellingProduct = SellingProduct::all();

            return view('portal.testing.testdevice')->with(['tradein'=>$tradein, 'portalUser'=>$portalUser, 'networks'=>$networks, 'productinformation'=>$productinformation, 'productColors'=>$productColors, 'products'=>$sellingProduct]);
        }    


    }

    public function receive(Request $request){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}

        #dd($request->scanid);
        $tradeins = Tradein::where('barcode', $request->scanid)->where('job_state', 2)->get();

        if(count($tradeins)<1){
            return redirect()->back()->with('error', 'Trade pack despach has not been sent, or device was already received.');
        }

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
       
        return view('portal.testing.order')->with('tradeins', $tradeins)->with('portalUser', $portalUser);
    }

    public function testItem($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.present')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);

    }

    public function isDeviceMissing(Request $request){

        #dd($request);

        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $tradein->created_at);
        $now = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        $user = User::where('id', $tradein->user_id)->first();

        $diff_in_days = $now->diffInDays($from);

        $message = array();

        if($diff_in_days>=14){
            $tradein->marked_for_quarantine = true;
            $tradein->older_than_14_days = true;
            $tradein->job_state = 9;
            $tradein->save();
            array_push($message, "This order has been identified by system as older than 14 days and has been marked for quarantine. Please confirm this.");
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device Older',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price,
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
        
        }

        if($request->missing == "present"){
            $tradein->device_missing = false;
            $tradein->received = true;
        }
        else if($request->missing == "missing"){
            $tradein->device_missing = true;
            $tradein->received = true;
            $tradein->marked_for_quarantine = true;
            $tradein->received = true;

            $filenameWithExt = $request->file('missing_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('missing_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore);

            $tradein->missing_image = $path;

            $tradein->job_state = 4;
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device Missing',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
            array_push($message, "This device has been found as missing from received order, and has been marked for quarantine. Please confirm this.");
        
            $tradein->save();

            $mti = false;
            if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
                $mti = true;
            }
    

            return redirect('/portal/testing/result/' . $tradein->id);
        }

        $tradein->save();

        $mti = false;

        

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }



        return redirect('/portal/testing/checkforimei/' . $tradein->id);
        
    }

    public function showCheckForImeiPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkimei')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function sendReceivingDeviceToQuarantine(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineTrays = "";
        $quarantineName = "";


        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_brand','Q')->where('tray_type', 'R')->where('number_of_devices', "<=" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;

            $user  = User::where('id', $tradein->user_id)->first();
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device sent to quarantine',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
        }
        else{

            $quarantineTrays = Tray::where('tray_type', 'R')->where('tray_brand', $tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', '<', 200)->first();

        }

        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        $newBarcode = "90";
        $newBarcode .= mt_rand(10000, 99999);
        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }
        
        $tradein->save();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();

        $response = $this->generateNewLabel($barcode, $sellingProduct, $tradein);

        return view('portal.testing.totray')->with(['response'=>$response, 'barcode'=>$tradein->barcode, 'tray_name'=>$quarantineName, 'portalUser'=>$portalUser, 'tradein'=>$tradein, 'mti'=>$mti]);
    }

    public function showOlderOrderPage($id){
        $tradein = Tradein::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        return view('portal.testing.receiving.olderorder')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function deviceImeiVisibility(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->visible_imei == "yes"){
            $tradein->visible_imei = true;
        }
        else{
            $tradein->visible_imei = false;
            $tradein->marked_for_quarantine = true;
        }

        $tradein->save();
        if($tradein->visible_imei == false){
            return redirect('/portal/testing/result/' . $tradein->id);
        }

        return redirect('/portal/testing/checkimei/' . $tradein->id);
    }

    public function showCheckImeiPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkmend')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function checkimei(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $imei_number = $request->imei_number;

        #dd($imei_number);

        if(strlen($imei_number)>15 || strlen($imei_number)<15){
            return redirect()->back()->with('error', 'Incorrect IMEI number. Must be 15 characters');
        }

        $url = 'https://clientapiv2.phonecheck.com/cloud/cloudDB/CheckEsn/';


        $ApiKey = "f06581b6-f4b3-4d40-a65e-6a39acf045fb";
        $username = "bamboo11";
        $devicetype = "Android";
        $carrier = "AT&T";
        
        $post = [
            'ApiKey' => $ApiKey,
            'Username' => $username,
            'IMEI' => $imei_number,
            'Devicetype' => $devicetype,
            'carrier' => $carrier,
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);

        $result = (json_decode($response));
        if($result->RawResponse->blackliststatus == "Yes"){
            $tradein->marked_for_quarantine = true;
            $tradein->chekmend_passed = false;
            $tradein->save();
        }


        $imeiResult = ImeiResult::where('tradein_id', $request->tradein_id)->first();

        if($imeiResult == null){
            $imeiResult = new ImeiResult();
        }

        $imeiResult->tradein_id = $request->tradein_id;
        $imeiResult->API =  $result->API;
        $imeiResult->remarks =  $result->Remarks;
        $imeiResult->model_name =  $result->RawResponse->modelname;
        $imeiResult->blackliststatus =  $result->RawResponse->blackliststatus;
        $imeiResult->greyliststatus =  $result->RawResponse->greyliststatus;

        $imeiResult->save();

        $tradein->imei_number = $imei_number;
        $tradein->save();

        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        #$this->showCheckImeiReultPage($tradein->barcode, $result);

        return redirect('/portal/testing/result/' . $tradein->id);

    }

    public function userCheckImei(Request $request){
        #dd($request);

        if($request->correct == "yes"){
            $tradein = Tradein::where('id', $request->tradein_id)->first();

            $tradein->marked_as_risk = false;
            $tradein->marked_for_quarantine = false;
            $tradein->chekmend_passed = true;
            $tradein->device_correct = true;
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
        else{
            $tradein = Tradein::where('id', $request->tradein_id)->first();
            $user  = User::where('id', $tradein->user_id)->first();
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device failed IMEI check',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );

            $tradein->marked_as_risk = false;
            $tradein->marked_for_quarantine = true;
            $tradein->chekmend_passed = false;
            $tradein->device_correct = false;
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
    }

    public function showReceivingResultPage($id){
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.resault')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function checkDeviceStatus(Request $request){

        #dd($request->all());

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        if($request->fimp_or_google_lock === "true" || $request->pin_locked === "true"){

            $tradein->marked_for_quarantine = true;
            $tradein->quarantine_date = \Carbon\Carbon::now();

            if($request->fimp_or_google_lock === "true"){
                $tradein->fimp = true;
            }
            if($request->pin_lock === "true"){
                $tradein->pinlocked = true;
            }

            $tradein->save();
        }
        else{
            if($request->device_correct === "false"){
                $tradein->marked_for_quarantine = true;
                $tradein->device_correct = $request->select_correct_device;
                $tradein->save();
            }

            if($tradein->job_state === 6){
                $tradein->proccessed_before = true;
                $tradein->save();
            }

            $customergradeval = "";
            $bambogradeval = $request->bamboo_customer_grade;
            $old_customer_grade = $request->old_customer_grade;
    
            if($request->device_fully_functional === "false" && !($old_customer_grade == "Faulty" || $old_customer_grade == "Catastrophic")){
                $tradein->marked_for_quarantine = true;
    
                $testingfaults = new TestingFaults();
                $testingfaults->tradein_id = $tradein->id;
    
                if($request->audio_tests === "true"){
                    $testingfaults->audio_test = true;
                }
                if($request->front_microphone === "true"){
                    $testingfaults->front_microphone = true;
                }
                if($request->headset_test === "true"){
                    $testingfaults->headset_test = true;
                }
                if($request->loud_speaker_test === "true"){
                    $testingfaults->loud_speaker_test = true;
                }
                if($request->microphone_playback_test === "true"){
                    $testingfaults->microphone_playback_test = true;
                }
                if($request->buttons_test === "true"){
                    $testingfaults->buttons_test = true;
                }
                if($request->sensor_test === "true"){
                    $testingfaults->sensor_test = true;
                }
                if($request->camera_test === "true"){
                    $testingfaults->camera_test = true;
                }
                if($request->glass_condition === "true"){
                    $testingfaults->glass_condition = true;
                }
                if($request->vibration === "true"){
                    $testingfaults->vibration = true;
                }
                if($request->original_colour === "true"){
                    $testingfaults->original_colour = true;
                }
                if($request->battery_health === "true"){
                    $testingfaults->battery_health = true;
                }
                if($request->nfc === "true"){
                    $testingfaults->nfc = true;
                }
                if($request->no_power === "true"){
                    $testingfaults->no_power = true;
                }
                if($request->fake_missing_parts === "true"){
                    $testingfaults->fake_missing_parts = true;
                }
    
                $testingfaults->save();
    
            }
            else{
                $tradein->marked_for_quarantine = false;
                $tradein->save();
            }
    
            #dd($old_customer_grade === "Excellent Working", $old_customer_grade, "Excellent Working");
            
            if($old_customer_grade === "Excellent Working"){
                $customergradeval = 5;
            }
            if($old_customer_grade === "Good Working"){
                $customergradeval = 4;
            }
            if($old_customer_grade === "Poor Working"){
                $customergradeval = 3;
            }
            if($old_customer_grade === "Damaged Working"){
                $customergradeval = 2;
            }
            if($old_customer_grade === "Faulty" || $old_customer_grade === "Catastrophic"){
                $customergradeval = 1;
            }

            #dd($bambogradeval, $customergradeval, $old_customer_grade);

            if($bambogradeval < $customergradeval){
                $tradein->marked_for_quarantine = true;
            }
            if($request->correct_network == "false"){
                $correctNetworkName = $request->correct_network_value;
                $correctNetworkData = Network::where('network_name', $correctNetworkName)->first();
    
                $userNetworkName = $tradein->network;
                $userNetworkData = Network::where('network_name', $userNetworkName)->first();
                $correctNetworkPrice = ProductNetworks::where('network_id', $correctNetworkData->id)->where('product_id', $tradein->product_id)->first()->knockoff_price;
                $userNetworkPrice = ProductNetworks::where('network_id', $userNetworkData->id)->where('product_id', $tradein->product_id)->first()->knockoff_price;
    
                if($correctNetworkPrice > $userNetworkPrice){
                    $tradein->marked_for_quarantine = true;
                }
    
                $tradein->correct_network = $correctNetworkName;
            }
    
            if($request->correct_memory == "false"){
    
                if($request->correct_memory_value>$tradein->memory){
                    $tradein->correct_memory = $request->correct_memory_value;
                }
                else{
                    $tradein->marked_for_quarantine = true;
                    $tradein->correct_memory = $request->correct_memory_value;
                }
    
            }
            
            $tradein->job_state = 5;
            $tradein->bamboo_grade = $request->bamboo_final_grade;
            $tradein->save();
        }

        $newBarcode = "";

        #dd($tradein);

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_type', 'T')->where('tray_grade', 'Q')->where('number_of_devices', "<=" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;

            $tradein->job_state = 9;
            $tradein->save();
            $newBarcode .= "90";
            $newBarcode .= mt_rand(10000, 99999);
        }
        else{
            $newBarcode .= $tradein->job_state;
            $newBarcode .= mt_rand(10000, 99999);
            if($tradein->barcode == $tradein->barcode_original){
                $tradein->barcode = $newBarcode;
            }
            
            $tradein->save();

            $quarantineName ="";
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
        
        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $response = $this->generateNewLabel($barcode, $tradein->barcode, $tradein->getBrandName($tradein->product_id), $tradein->getProductName($tradein->product_id), $tradein->imei_number, $quarantineTrays->tray_name);
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName, 'portalUser'=>$portalUser, 'testing'=>true, 'tradein'=>$tradein]);
        
    }

    public function printNewLabel(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        $tradein->job_state = 3;


        $newBarcode = "";

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();
        $brands = Brand::all();

        if($tradein->marked_for_quarantine == true){
            $newBarcode .= "90";
            $newBarcode .= mt_rand(10000, 99999);
            $tradein->quarantine_date = \Carbon\Carbon::now();
        }
        else{
            foreach($brands as $brand){
                if($sellingProduct->brand_id == $brand->id){
                    if($brand->id < 10){
                        $newBarcode .= $tradein->job_state . "0" . $brand->id;
                        $newBarcode .= mt_rand(1000, 9999);
                    }
                    else{
                        $newBarcode .= $tradein->job_state . $brand->id;
                        mt_rand(1000, 9999);
                    }
                }
            }
        }

        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }
        
        $tradein->save();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RQ01%')->where('number_of_devices', "<=" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;
        }
        else{
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RM01%')->where('number_of_devices', "<=" ,100)->first();
            $quarantineName = $quarantineTrays->tray_name;
            if($tradein->getBrandId($tradein->product_id) == 1){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RA01%')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;

            }
            if($tradein->getBrandId($tradein->product_id) == 2){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RS01%')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            if($tradein->getBrandId($tradein->product_id) == 3){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RH01%')->where('number_of_devices', "<=" ,100)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
        }

        
        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }


        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        $response = $this->generateNewLabel($barcode, $tradein->barcode, $tradein->getBrandName($tradein->product_id), $tradein->getProductName($tradein->product_id), $tradein->imei_number, $quarantineTrays->tray_name);

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName,'response'=>$response,'barcode'=>$tradein->barcode, 'portalUser'=>$portalUser, 'tradein'=>$tradein,'testing'=>false, 'mti'=>$mti]);

    }


    public function sendtotray(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        
        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }


        $tradein->job_state = 5;

        $user = User::where('id', $tradein->user_id)->first();

        $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
        $event = new KlaviyoEvent(
            array(
                'event' => 'Item received',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$name' => $user->first_name,
                    '$last_name' => $user->last_name,
                    '$birthdate' => $user->birthdate,
                    '$newsletter' => $user->email,
                    '$products' => $tradein->getProductName($tradein->id),
                    '$price'=> $tradein->order_price
                ),
                'properties' => array(
                    'Item Sold' => True
                )
            )
        );

        $client->publicAPI->track( $event );  

        $product = SellingProduct::where('id', $tradein->product_id)->first();
        $tray = null;

        if($tradein->marked_for_quarantine === true){
            $trays = Tray::where('trolley_id', 5)->get();
        }
        else{
            if($product->brand_id === 1){
                $trays = Tray::where('trolley_id', 1)->get();
            }
            elseif($product->brand_id === 2){
                $trays = Tray::where('trolley_id', 2)->get();
            }
            elseif($product->brand_id === 3){
                $trays = Tray::where('trolley_id', 3)->get();
            }
            else{
                $trays = Tray::where('trolley_id', 4)->get();
            }
        }

        foreach($trays as $tr){
            if($tr->number_of_devices < $tr->max_number_of_devices){
                $tray = $tr;
                break;
            }
        }

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }

        $traycontent = new TrayContent();
        $traycontent->tray_id = $tray->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        $tray->number_of_devices = count(TrayContent::where('tray_id', $tray->id)->get());

        $tray->save();

        $tradein->save();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.totray')->with(['tray_name'=>$tray->tray_name, 'portalUser'=>$portalUser,'testing'=>true, 'mti'=>$mti]);
    }


    function generateNewLabel($barcode, $tradein_barcode, $manifacturer, $model, $imei, $location){

        $customPaper = array(0,0,141.90,283.80);

        $pdf = PDF::loadView('portal.labels.devicelabel', 
        array(
            'barcode'=>$barcode,
            'tradein_barcode'=>$tradein_barcode,
            'manifacturer'=>$manifacturer,
            'model'=>$model,
            'imei'=>$imei,
            'location'=>$location))
        ->setPaper($customPaper, 'landscape')
        ->save('pdf/devicelabel-'. $tradein_barcode .'.pdf');
    
    }

    public function downloadSingleFile(Request $request){

        return response(['code'=>200, 'filename'=>$request->file . ".pdf"]);

    }
}
