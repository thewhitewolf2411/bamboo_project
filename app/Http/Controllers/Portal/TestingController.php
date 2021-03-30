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
use App\Services\KlaviyoEmail;
use App\Services\NotificationService;
use App\Services\Testing;
use App\Eloquent\AdditionalCosts;
use App\Services\GetLabel;

class TestingController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
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
        if($tradein->job_state === "9" || $tradein->job_state === "10" || $tradein->job_state === "13" || $tradein->job_state === "14"){
            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();
            $product_networks = ProductNetworks::where('product_id', $tradein->product_id)->get()->pluck('network_id');
            $networks = Network::whereIn('id', $product_networks)->get();
            $productinformation = ProductInformation::where('product_id', $tradein->product_id)->get();
            $productColors = Colour::where('product_id', $tradein->product_id)->get();
            $sellingProduct = SellingProduct::all();

            return view('portal.testing.testdevice')->with(['tradein'=>$tradein, 'portalUser'=>$portalUser, 'networks'=>$networks, 'productinformation'=>$productinformation, 'productColors'=>$productColors, 'products'=>$sellingProduct]);

        }else{
            if($tradein->isInQuarantine()){
                return redirect()->back()->with('error', 'Device was marked for quarantine on receiving and cannot be tested. If this device is in your tray, please remove it.');
            }
            return redirect()->back()->with('error', 'This device cannot be tested at this time.');
        }

    }

    public function getDeviceData(Request $request){
        $device_id = $request->deviceid;
        $tradein = Tradein::where('id', $request->tradeinid)->first();

        $networks = Network::all();
        $sellingProduct = SellingProduct::where('id', $device_id)->first();
        $productinformation = ProductInformation::where('product_id', $device_id)->get();
        $productnetworks = ProductNetworks::where('product_id', $device_id)->get();
        $hassamenetwork = false;
        
        foreach($productinformation as $productInfo){
            if($tradein->customer_memory === $productInfo->memory){
                $hassamenetwork = true;
            }
        }

        $response = [

            'networks'=>$networks,
            'sellingProduct'=>$sellingProduct,
            'productinformation'=>$productinformation,
            'productnetworks'=>$productnetworks,
            'hassamenetwork'=>$hassamenetwork

        ];

        return $response;
    }

    public function receive(Request $request){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}

        $tradeins = Tradein::where('barcode', $request->scanid)->get();
        foreach($tradeins as $tradein){
            if($tradein->job_state === "21"){
                return redirect()->back()->with('error', 'This order need to be returned to customer.');
            }
        }

        $tradeins = Tradein::where('barcode', $request->scanid)->whereIn('job_state', ["2","3"])->get();


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
        $additionalCosts = AdditionalCosts::first();
        $tradein->carriage_cost = $additionalCosts->carriage_costs;
        $tradein->admin_cost = $additionalCosts->administration_costs;

        $miscCost = AdditionalCosts::where('id', '!=', 1)->first();
        if($miscCost !== null){
            $miscCost->miscellaneous_costs = $miscCost->miscellaneous_costs - $miscCost->per_job_deduction;
            $miscCost->save();

            $tradein->misc_cost = $miscCost->per_job_deduction;
        }
        $notificationService = new NotificationService();

        $expiryDate = Carbon::parse($tradein->expiry_date);
        $daysToExpiry = Carbon::now()->diffInDays($expiryDate, false);
        #dd($expiryDate, $daysToExpiry);

        $user = User::where('id', $tradein->user_id)->first();

        $message = array();

        if($daysToExpiry<0){

            $bamboogradeval = 0;

            switch($tradein->customer_grade){
                case 'Excellent Working':
                    $bamboogradeval = 5;
                    break;
                case 'Good Working':
                    $bamboogradeval = 4;
                    break;
                case 'Poor Working':
                    $bamboogradeval = 3;
                    break;
                case 'Damaged Working':
                    $bamboogradeval = 2;
                    break;
                case 'Faulty':
                    $bamboogradeval = 1;
                    break;
                default:
                $bamboogradeval = 5;
                    break;
            }

            $checkPrice = new Testing();
            $deviceCurrentPrice = $checkPrice->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, $bamboogradeval);

            if($deviceCurrentPrice < $tradein->order_price){
                $tradein->job_state = "11j";
                $tradein->save();
                array_push($message, "This order has been identified by system as older than 14 days and has been marked for quarantine. Please confirm this.");

                // send notification - trade pack received after 14 days
                $notificationService->receivedAfterFourteenDays($tradein);
            }
        }

        if($request->missing == "missing"){

            $filenameWithExt = $request->file('missing_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('missing_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //$path = $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore); AAAAAAAAAAAAA
            $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore);
            $path = $fileNameToStore;


            $tradein->missing_image = $path;
            $tradein->job_state = 4;

            array_push($message, "This device has been found as missing from received order, and has been marked for quarantine. Please confirm this.");
        
            $tradein->save();

            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->missingDevice($user);

            $mti = false;
            if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
                $mti = true;
            }

            // send notification - missing device
            $notificationService = new NotificationService();
            $notificationService->sendMissingDevice($tradein);

            return redirect('/portal/testing/result/' . $tradein->id);
        }

        $tradein->save();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        // for products without network, send device to serial check
        $product_category = SellingProduct::find($tradein->product_id)->category_id;

        if($product_category > 1 && is_null($tradein->customer_network)){
            return redirect('/portal/testing/checkforserial/' . $tradein->id);
        } else {
            return redirect('/portal/testing/checkforimei/' . $tradein->id);
        }
    }

    /**
     * Display check for device serial number visibility.
     */
    public function showCheckForSerialPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.showcheckserial')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    /**
     * Display check for device IMEI number visibility.
     */
    public function showCheckForImeiPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkimei')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
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
        #dd("here");
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->visible_imei != "yes"){
            if($tradein->customer_grade !== 'Faulty'){
                $tradein->job_state = "6";

                $user = User::where('id', $tradein->user_id)->first();

                $newPrice = "";

                $testing = new Testing();
                $newPrice = $testing->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, 1);
                
                $tradein->bamboo_price = $newPrice;

                $klaviyoemail = new KlaviyoEmail();
                $klaviyoemail->noImei($user, $tradein);
            }
            else{
                $tradein->job_state = "9";
            }

            // send notification - no imei
            $notificationService = new NotificationService();
            $notificationService->sendNoIMEI($tradein);
        }
        $tradein->save();

        if($request->visible_imei != "yes"){
            return redirect('/portal/testing/result/' . $tradein->id);
        }

        return redirect('/portal/testing/checkimei/' . $tradein->id);
    }

    /**
     * Determine if device's serial is visible.
     */
    public function deviceSerialVisibility(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->visible_serial == "no"){
            $tradein->job_state = "6";
            $user = User::where('id', $tradein->user_id)->first();

            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->noImei($user, $tradein);
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
        if($request->visible_serial === "yes"){
            $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();
            return view('portal.testing.receiving.checkserial', [
                'tradein'       =>  $tradein, 
                'product'       =>  $tradein, 
                'user'          =>  Auth::user(),
                'portalUser'    =>  $portalUser
                ]
            );
        }
    }

    /**
     * Save device serial number and finish receiving.
     */
    public function saveSerial(Request $request){
        if(isset($request->tradein_id) && isset($request->serial_number)){
            $tradein = Tradein::find($request->tradein_id);
            $tradein->serial_number = $request->serial_number;
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
    }

    /**
     * Show page for IMEI verification.
     */
    public function showCheckImeiPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkmend')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    /**
     * Show page for serial verification.
     */
    public function showCheckSerialPage($id){
        //if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkserial')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    /**
     * Verify device's IMEI number.
     */
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
            $tradein->job_state = "7";
            $tradein->save();

            $user = User::where('id', $tradein->user_id)->first();

            $klaviyomail = new KlaviyoEmail();
            $klaviyomail->blacklisted($user, $tradein);
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

        $testing = new Testing();
        $testingResult =  $testing->testDevice($request);
        $quarantineName = $testingResult['tray_name'];
        $quarantineTrays = $testingResult['tray'];
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        
        $getLabel = new GetLabel();
        $pdf = $getLabel->getTradeinLabel($tradein);

        #dd($pdf);
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName, 'pdf'=>$pdf, 'portalUser'=>$portalUser, 'testing'=>true, 'tradein'=>$tradein]);
        
    }

    public function printNewLabel(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        $newBarcode = "";

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();

        if($tradein->isInQuarantine() === true){
            $newBarcode .= "90";
            $newBarcode .= mt_rand(100000, 999999);
            $tradein->quarantine_date = \Carbon\Carbon::now();
        }
        else{
            $tradein->job_state = 9;
            if($sellingProduct->brand_id < 10){
                $newBarcode .= $tradein->job_state . "0" . $sellingProduct->brand_id;
                $newBarcode .= mt_rand(10000, 99999);
            }
            else{
                $newBarcode .= $tradein->job_state . $sellingProduct->brand_id;
                $newBarcode .= mt_rand(1000, 9999);
            }
        }

        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }
        
        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($tradein->isInQuarantine()){
            $quarantineTrays = Tray::where('tray_type', 'R')->where('tray_brand', 'Q')->where('number_of_devices', "<" ,100)->get()->sortBy('tray_name');
            $quarantineTrays = $quarantineTrays->first();
            $quarantineName = $quarantineTrays->tray_name;
        }
        else{
            $quarantineTrays = Tray::where('tray_type', 'R')->where('tray_brand',$tradein->getBrandLetter($tradein->product_id))->where('number_of_devices', "<" ,100)->get()->sortBy('tray_name');
            $quarantineTrays = $quarantineTrays->first();
            $quarantineName = $quarantineTrays->tray_name;
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


        $getLabel = new GetLabel();
        $pdf = $getLabel->getTradeinLabel($tradein);

        $klaviyoemail = new KlaviyoEmail();
        $klaviyoemail->receiptOfDevice(User::where('id', $tradein->user_id)->first(), $tradein);

        $tradein->save();

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName,'pdf'=>$pdf,'barcode'=>$tradein->barcode, 'portalUser'=>$portalUser, 'tradein'=>$tradein,'testing'=>false, 'mti'=>$mti]);

    }


    public function sendtotray(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        
        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }


        $tradein->job_state = 5;

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

    public function downloadSingleFile(Request $request){

        return response(['code'=>200, 'filename'=>$request->file . ".pdf"]);

    }

}
