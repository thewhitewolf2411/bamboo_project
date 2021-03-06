<?php

namespace App\Http\Controllers\Portal;

use App\Audits\TradeinAudit;
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
use App\Services\ReceivingService;

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
        if($tradein->job_state === "9" || $tradein->job_state === "9a" || $tradein->job_state === "9b" || $tradein->job_state === "13" || $tradein->job_state === "14"){
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
            if(count(Tradein::where('barcode', $request->scanid)->whereIn('job_state', ["19","20", "21"])->get())>=1){
                return redirect()->back()->with('error', 'This order need to be returned to customer.');
            }
            return redirect()->back()->with('error', 'Trade-pack has not been despatched');
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
            $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore);
            $path = $fileNameToStore;


            $tradein->missing_image = $path;
            $tradein->job_state = 4;

            array_push($message, "This device has been found as missing from received order, and has been marked for quarantine. Please confirm this.");
        
            $tradein->save();

            //$klaviyoemail = new KlaviyoEmail();
            //$klaviyoemail->missingDevice($user);

            $mti = false;
            if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
                $mti = true;
            }

            // send notification - missing device
            //$notificationService = new NotificationService();
            //$notificationService->sendMissingDevice($tradein);

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

    public function checkimei(Request $request){

        $imei_number = request()->imei_number;

        /*if(strlen($imei_number)>15 || strlen($imei_number)<15){
            return redirect()->back()->with('error', 'Incorrect IMEI number. Must be 15 characters');
        }*/

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

        return response()->json($result);
    }

    public function receivingResults(Request $request){

        $receivingService = ReceivingService::checkReceivingResaults($request);

        $tradein = Tradein::find($request->tradeinid);
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>0){
            $mti = true;
        }

        $lastTradeinAudit = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', 'Not received yet.')->latest('created_at')->first()->delete();

        return view('portal.testing.totray')->with(['tray_name'=>$receivingService[0],'pdf'=>$receivingService[1],'barcode'=>$tradein->barcode, 'portalUser'=>$portalUser, 'tradein'=>$tradein,'testing'=>false, 'mti'=>$mti]);

    }

    public function toQuarantineBlacklisted(Request $request){
        $receivingService = ReceivingService::checkBlacklistedReceivingResaults($request);

        $tradein = Tradein::find($request->tradeinid);
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>0){
            $mti = true;
        }

        $lastTradeinAudit = TradeinAudit::where('tradein_id', $tradein->id)->where('stock_location', 'Not received yet.')->latest('created_at')->first()->delete();

        return view('portal.testing.totray')->with(['tray_name'=>$receivingService[0],'pdf'=>$receivingService[1],'barcode'=>$tradein->barcode, 'portalUser'=>$portalUser, 'tradein'=>$tradein,'testing'=>false, 'mti'=>$mti]);
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

        //Generate unique barcode
        do{
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
        }
        while(Tradein::where('barcode', $newBarcode)->exists());

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
