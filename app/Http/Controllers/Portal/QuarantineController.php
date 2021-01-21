<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\QuarantineBin;
use Auth;
use DNS1D;
use DNS2D;
use PDF;
use File;

class QuarantineController extends Controller
{
    public function showQuarantinePage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.quarantine')->with('portalUser', $portalUser);
    }

    public function showQuarantineOverviewPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::where('marked_for_quarantine', true)->get();
        
        return view('portal.quarantine.quarantine-overview')->with(['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }

    public function showQuarantineBinsPage(){
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineBins = QuarantineBin::all();

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
                    $tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0],  $tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0], $tradein->getTrayName($tradein->id), $tradein->bamboo_grade));
                }
                else{
                    array_push($tradeins, array($tradein->barcode, $tradein->getProductName($tradein->product_id), $tradein->imei_number . "\t", 
                    $tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0],  $tradein->getQuarantineReason($tradein->id)[0], $tradein->getTrayName($tradein->id), $tradein->bamboo_grade));
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
        dd($request->all());
    }

    public function returnToCustomer(Request $request){
        $tradeinNumbers = $request->all();

        #array_pop($tradeinNumbers);

        $tradeins = array();

        foreach($tradeinNumbers as $key=>$tiN){

            $id = substr($key, strpos($key, "-") + 1);    

            $tradein = Tradein::where('id', $id)->first();
            if($tradein != null){
                array_push($tradeins, $tradein);
            }

        }

        return redirect()->back()->with(['hasTradeIns'=>true, 'returnToCustomer'=>$tradeins]);
    }


    public function markDevicesToReturnToCustomer(Request $request){
        $tradeinNumbers = $request->all();

        #array_pop($tradeinNumbers);

        $tradeins = array();

        foreach($tradeinNumbers as $key=>$tiN){

            $id = substr($key, strpos($key, "-") + 1);    

            $tradein = Tradein::where('id', $id)->first();

            if($tradein != null){
                $tradein->job_state = 16;
                $tradein->marked_for_quarantine = false;
                $tradein->quarantine_status = null;
                $tradein->fimp = null;
                $tradein->pinlocked = null;
                $tradein->proccessed_before = true;
                $tradein->save();
            }
        }


        return redirect()->back()->with('success', 'You have succesfully marked devices to be returned to customer');
    }

    public function addQuarantineStatus(Request $request){

        $tradein = Tradein::where('id', $request->id)->first();

        $tradein->quarantine_status = $request->val;

        $tradein->save();

        return 200;
    }

    public function removeQuarantineStatus(Request $request){

        $tradein = Tradein::where('id', $request->id)->first();

        $tradein->quarantine_status = null;

        $tradein->save();

        return 200;

    }

    public function addNewQuarantineBin(){

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();


        return view('portal.quarantine.addquarantinebin')->with(['portalUser'=>$portalUser]);
    }

    public function addQuarantineBin(Request $request){


        $quarantineBin = new QuarantineBin();

        $quarantineBin->bin_name = $request->bin_name;
        $quarantineBin->save();

        return redirect('/portal/quarantine/quarantine-bins')->with('success', 'You have succesfully created bin ' . $request->bin_name);


    }

    public function deleteQuarantineBin($id){
        $quarantineBin = QuarantineBin::where('id', $id)->first();

        $name = $quarantineBin->bin_name;

        $quarantineBin->delete();

        return redirect('/portal/quarantine/quarantine-bins')->with('success', 'You have succesfully deleted bin ' . $name);
    }

    public function showBinView(Request $request){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineBin = QuarantineBin::where('bin_name', $request->bin_id_scan)->first();

        return view('portal.quarantine.binview')->with(['portalUser'=>$portalUser]);
    }

    public function printBinLabel($binname){
        $traybarcode = $binname;
     
        $barcode = DNS1D::getBarcodeHTML($traybarcode, 'C128');

        $this->generateBinLabel($barcode, $traybarcode);
    }

    public function generateBinLabel($barcode, $id){


        $filename = "bin-" . $id . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.quarantinebin', array('barcode'=>$barcode, 'id'=>$id))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
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
