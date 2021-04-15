<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use Auth;
use File;
use Session;
use App\Services\BinService;
use App\Services\KlaviyoEmail;
use App\Services\NotificationService;
use App\Services\MoveToTray;
use App\Services\Testing;
use App\User;
use App\Services\GetLabel;

class QuarantineController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showQuarantinePage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.quarantine')->with('portalUser', $portalUser);
    }

    public function showQuarantineOverviewPage(){

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::all();

        $matches = ["4","5","6","7","8a","8b","8c","8d","8e","8f","11","11a","11b","11c","11d","11e","11f","11g","11h","11i","11j","15","15a","15b","15c","15d","15e",
        "15f","15g","15h","15i"];


        $tradeins = $tradeins->filter(function($tradein) use ($matches){
            if(in_array($tradein->job_state, $matches)){
                return $tradein;
            }
            return null;
        });
        
        return view('portal.quarantine.quarantine-overview')->with(['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }

    public function showQuarantineBinsPage(){
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineBins = Tray::where('tray_type', 'B')->get()->sortBy('tray_name');

        return view('portal.quarantine.quarantine-bins')->with(['portalUser'=>$portalUser, 'quarantineBins'=>$quarantineBins]);

    }

    public function exportCsv(Request $request){
 
        $tradeinNumbers = $request->all();

        #array_pop($tradeinNumbers);

        $tradeins = array();

        foreach($tradeinNumbers as $key=>$tiN){

            $id = substr($key, strpos($key, "-") + 1);    

            $tradein = Tradein::where('id', $id)->first();

            if($tradein != null){
                if($tradein->quarantine_status == null){
                    array_push($tradeins, array($tradein->barcode, $tradein->getProductName($tradein->product_id), $tradein->imei_number . "\t", 
                    $tradein->getBambooStatus(),  $tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0], $tradein->getTrayName($tradein->id), $tradein->getDeviceBambooGrade()));
                }
                else{
                    array_push($tradeins, array($tradein->barcode, $tradein->getProductName($tradein->product_id), $tradein->imei_number . "\t", 
                    $tradein->getDeviceStatus(),  $tradein->getQuarantineReason($tradein->id)[0], $tradein->getTrayName($tradein->id), $tradein->getDeviceBambooGrade()));
                }
            }

        }


        $filename = 'quarantine-export-' . date('Y-m-d') . '.csv';

        $fp = fopen( \public_path() .  '/quarantinecsv/' . $filename, 'w');

        $headers = array("Trade-In Barcode", "Model", "IMEI", "Bamboo Status", "Blacklisted Reason", "Stock Location", "Bamboo Grade");


        \fputcsv($fp, $headers);

        foreach($tradeins as $tradein){

            \fputcsv($fp, $tradein);
        }

        fclose($fp);

        $this->downloadFile(\public_path() .  '/quarantinecsv/' . $filename, false);
        
    }

    public function allocateToTray(Request $request){
        #dd($request->all());
        
        $tradeins = [];

        if($request->submitscannedid_allocatetotray){
            if(Session::has('allocateToTrays')){
                $tradeins = Session::get('allocateToTrays');
            }

            $matches = ["4","5","6","7","8a","8b","8c","8d","8e","8f","11","11a","11b","11c","11d","11e","11f","11g","11h","11i","11j","15","15a","15b","15c","15d","15e",
            "15f","15g","15h","15i"];
            $tradein = Tradein::where('barcode', $request->submitscannedid_allocatetotray)->first();

            if(!in_array($tradein->job_state, $matches)){
                return redirect()->back()->with(['hasAllocateToTrays'=>true, 'error'=>'This device cannot be moved at this moment']);
            }

            if(count($tradeins)>0){
                foreach($tradeins as $t){
                    if($t->barcode != $request->submitscannedid_allocatetotray){
                        array_push($tradeins, $tradein);
                    }
                }
            }
            else{
                array_push($tradeins, $tradein);
            }

        
        }
        else{
            Session::forget('allocateToTrays');
        }

        #dd($tradeins);
        $request->session()->put('allocateToTrays', $tradeins);

        $trays = Tray::where('tray_type', '!=', 'B')->where('tray_type', '!=', 'Bo')->get();

        return redirect()->back()->with(['hasAllocateToTrays'=>true, 'trays'=>$trays]);
    }

    public function checkScannedDevices(Request $request){

        $tradeins = [];
        if(Session::has('allocateToTrays')){
            $tradeins = Session::get('allocateToTrays');
        }

        $tray = Tray::where('id', $request->newTrayId)->first();

        /*foreach($tradeins as $tradein){
            if($tradein->job_state !== "12"){
                return response('Offer for device '. $tradein->barcode .' not been accepted yet.', 404);
            }
            if($tradein->job_state !== ""){
                return response('Device ' . $tradein->barcode . ' cannot be moved out of quarantine yet.', 404);
            }
        }*/

        return response('', 200);
    }

    public function allocateConfirmedDevices(Request $request){

        $data = $request->all();
        array_shift($data);

        foreach($data as $key=>$trayid){
            $tradeinid = explode('-',$key)[1];
            $newTrayid = $trayid;

            $tradein = Tradein::where('id', $tradeinid)->first();
            $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
            $newTray = Tray::where('id', $newTrayid)->first();

            if(!MoveToTray::checkTrayValidity($request, $tradein, $newTray)){
                return redirect()->back()->with('error', 'Order no ' . $tradein->barcode .  ' cannot be placed in this tray.');
            }
            else{
                $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
                $newTray = Tray::where('id', $newTrayid)->first();
                if($oldTrayContent !== null){
                    $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
                    $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
                    $oldTray->save();
                    $oldTrayContent->delete();
                }

                $traycontent = new TrayContent();
                $traycontent->tray_id = $newTrayid;
                $traycontent->trade_in_id = $tradein->id;
                $traycontent->save();
                
                
                //after receiving
                if($newTray->tray_type === 'R'){
                    $tradein->job_state = '14';
                }
                //after testing
                elseif($newTray->tray_type === 'T'){
                    $tradein->job_state = '12';
                }
                $tradein->location_changed_at = \Carbon\Carbon::now();
                $tradein->save();
            }
        
        
            if(empty($response)){
                return redirect()->back()->with(['success'=>'All devices have been succesfully reallocated to new trays.']);
            }
            else{
                return redirect()->back()->with(['error'=>'Some devices are allocated to new trays.', 'notallocated'=>$response]);
            }

        }

    }

    public function returnToCustomer(Request $request){

        $tradeins = [];

        if($request->submitscannedid_returntocustomer){
            if(Session::has('returnToCustomer')){
                $tradeins = Session::get('returnToCustomer');
            }
            $tradein = Tradein::where('barcode', $request->submitscannedid_returntocustomer)->first();
            if($tradein !== null){
                array_push($tradeins, $tradein);
            }
        }
        else{
            Session::forget('returnToCustomer');
        }

        $request->session()->put('returnToCustomer', $tradeins);

        return redirect()->back()->with(['hasTradeIns'=>true]);
    }


    public function markDevicesToReturnToCustomer(Request $request){

        $tradeinNumbers = $request->all();

        $tradeinNumbers = array_values($tradeinNumbers);
        $notificationService = new NotificationService();

        unset($tradeinNumbers[0]);

        $tradeins = array();

        foreach($tradeinNumbers as $key=>$tiN){

            $tradein = Tradein::where('id', $tiN)->first();

            if($tradein != null){
                $tradein->job_state = '20';
                $tradein->save();

                // send notification - marked for return
                $notificationService->sendMarkedToReturn($tradein->id);

                $traycontent = TrayContent::where('trade_in_id', $tiN)->first();
                $traycontent->delete();
            }
        }


        return redirect()->back()->with('success', 'You have succesfully marked devices to be returned to customer');
    }

    public function addQuarantineStatus(Request $request){

        $tradein = Tradein::where('id', $request->id)->first();
        $user = User::where('id', $tradein->user_id)->first();

        if($request->val === '8a'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->blacklisted($user, $tradein);

            $tradein->quarantine_reason = "Lost";
        }
        if($request->val === '8b'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->deviceUnderContract($user, $tradein);

            $tradein->quarantine_reason = "Insurance claim";
        }
        if($request->val === '8c'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->blacklisted($user, $tradein);

            $tradein->quarantine_reason = "Blocked/FRP";
        }
        if($request->val === '8d'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->deviceStolen($user, $tradein);

            $tradein->quarantine_reason = "Stolen";
        }
        if($request->val === '8e'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->blacklisted($user, $tradein);

            $testingClass = new Testing();
            $bambooPrice = $testingClass->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, 1);
            $tradein->bamboo_price = $bambooPrice;

            $tradein->quarantine_reason = "Knox";
        }
        if($request->val === '8f'){
            $klaviyoemail = new KlaviyoEmail();
            $klaviyoemail->deviceUnderContract($user, $tradein);

            $tradein->quarantine_reason = "Assetwatch";
        }

        $tradein->job_state = $request->val;

        $tradein->save();

        // send notification - device blacklisted
        $notificationService = new NotificationService();
        $notificationService->sendBlacklisted($tradein);

        return 200;
    }

    public function removeQuarantineStatus(Request $request){

        $tradein = Tradein::where('id', $request->id)->first();

        $tradein->job_state = '7';

        $tradein->save();

        return 200;

    }

    public function addNewQuarantineBin(){

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();


        return view('portal.quarantine.addquarantinebin')->with(['portalUser'=>$portalUser]);
    }

    public function addQuarantineBin(Request $request){

        $trayGrade = explode('-', $request->bin_name);
        $trayGrade = $trayGrade[0];

        if(Tray::where('tray_name', $request->bin_name)->first() !== null ){
            return \redirect('/portal/quarantine/quarantine-bins')->with('error', 'Bin ' . $request->bin_name . ' already exists.');
        }

        $quarantineBin = new Tray();

        $quarantineBin->tray_name = $request->bin_name;
        $quarantineBin->tray_type = "B";
        $quarantineBin->tray_brand = "Q";
        $quarantineBin->tray_grade = $trayGrade;
        $quarantineBin->max_number_of_devices = 30;

        $quarantineBin->save();

        return redirect('/portal/quarantine/quarantine-bins')->with('success', 'You have succesfully created bin ' . $request->bin_name);


    }

    public function deleteQuarantineBin($id){
        $quarantineBin = Tray::where('id', $id)->first();

        $name = $quarantineBin->tray_name;

        $quarantineBin->delete();

        return redirect('/portal/quarantine/quarantine-bins')->with('success', 'You have succesfully deleted bin ' . $name);
    }

    public function showBinView(Request $request){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineBin = Tray::where('tray_name', $request->bin_id_scan)->first();
        if($quarantineBin === null){
            return redirect()->back()->with(['error'=>$request->bin_id_scan . ' does not exist.']);
        }
        $quarantineBinContent = TrayContent::where('tray_id', $quarantineBin->id)->get();

        $tradeins = array();

        foreach($quarantineBinContent as $tc){
            $tradein = Tradein::where('id', $tc->trade_in_id)->first();
            array_push($tradeins, $tradein);
        }

        return view('portal.quarantine.binview')->with(['portalUser'=>$portalUser, 'bin'=>$quarantineBin, 'quarantineBinContent'=>$tradeins]);
    }

    public function showPopupAddDeviceToBin($binname){

        $bin = Tray::where('tray_name', $binname)->first();
        

        if($bin->number_of_devices < $bin->max_number_of_devices){
            return redirect()->back()->with(['adddevices'=>true, 'devices_type'=>$bin->tray_grade]);
        }
        else{
            return redirect()->back()->with(['error'=>'This bin already has 30 devices. You cannot assign more devices to this bin.']);
        }

    }

    public function checkAddingDevicesToBin(Request $request){

        #dd($request->all());

        $tradein = Tradein::where('barcode', $request->id)->first();
        if($tradein === null){
            return response(['deviceadded'=>0, 'error'=>'This order does not exist.']);
        }

        $bintype = $request->bintype;

        $binservice = new BinService();

        #dd($binservice->handleDeviceBin($tradein, $bintype, $request->binname));
        return $binservice->handleDeviceBin($tradein, $bintype, $request->binname);
    }

    public function addDevicesToBin(Request $request){

        $data = $request->all();

        $bin = Tray::where('tray_name', $request->binname)->first();

        array_shift($data);
        array_pop($data);
        foreach($data as $tradeinId){
            $tradein = Tradein::where('id', $tradeinId)->first();
  
            $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
            $bin->number_of_devices = $bin->number_of_devices + 1;
            $bin->save();
    
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
    
            $oldTrayContent->delete();
    
            $traycontent = new TrayContent();
            $traycontent->tray_id = $bin->id;
            $traycontent->trade_in_id = $tradein->id;
            $traycontent->save();

            $tradein->location_changed_at = \Carbon\Carbon::now();
            $tradein->save();
        }

        return redirect()->back()->with('success', 'All devices have been moved to ' . $bin->tray_name);
        
    }

    public function printBinLabel(Request $request){
        $binid = $request->binid;

        $bin = Tray::where('id', $binid)->first();

        $getlabel = new GetLabel();
        $pdf = $getlabel->getBinLabel($bin);

        return response('pdf/binlabel-'.$bin->tray_name, 200);
    }

    public function changeTray($tradeinId, $newTrayId){

        $tradein = Tradein::where('id', $tradeinId)->first();
        $oldTray = Tray::where('id', $tradein->getTrayId())->first();

        if(count($oldTray)<1){

        }else{

        }
    }


    public function downloadFile($file, $delete = true){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            // if file is downloaded delete all created files from the sistem
            if($delete){
                File::delete($file);
            }

        }
    }

}
