<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DNS1D;
use DNS2D;
use PDF;
use File;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;
use App\Services\GetLabel;

class TraysController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }

    public function showTraysPage(){
        //if(!$this->checkAuthLevel(12)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trays = Tray::where('tray_type', '!=', 'B')->where('tray_type', '!=', 'Bo')->get();

        return view('portal.trays.trays')->with(['portalUser'=>$portalUser, 'trays'=>$trays]);
    }

    public function showAddTrayPage(){
        //if(!$this->checkAuthLevel(12)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        return view('portal.add.tray')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function addTray(Request $request){

        $trays = Tray::where('tray_name', $request->tray_name)->get();

        if(count($trays)>=1){
            return redirect('/portal/trays/create')->with('error', 'Tray with name '.$request->tray_name.' already exists.');
        }
        else{

            $trayType = $request->tray_name[0];
            $trayBrand = $request->tray_name[1];
            $trayGrade = 0;
            if(substr_count($request->tray_name, '-') === 1){
                $trayGrade = 0;
            }
            else if(substr_count($request->tray_name, '-') === 2){
                $parts = explode('-', $request->tray_name);
                if($parts[2] === 'CATASTROPHIC'){
                    $trayGrade = 'CAT';
                }
                else{
                    $trayGrade = $parts[2];
                }
            }
            else{
                return redirect('/portal/trays/create')->with('error', 'Wrong format of tray name.');
            }

            $tray = new Tray();
            $tray->tray_name = $request->tray_name;
            $tray->tray_type = $trayType;
            $tray->tray_brand = $trayBrand;
            $tray->tray_grade = $trayGrade;

            $tray->save();
        }

        return redirect('/portal/trays')->with('success', 'You have succesfully created a tray '.$request->tray_name.'.');
    }

    public function showTrayPage(Request $request){

        #dd($request->all());

        $trayid = $request->tray_id_scan;

        $tray = Tray::where('tray_name', $trayid)->first();
        if($tray === null){
            return redirect()->back()->with('error', 'Tray doesn\'t exist.');
        }
        if($tray->tray_type === 'B'){
            return redirect()->back()->with('error', 'Tray doesn\'t exist.');
        }

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        $trayContent = TrayContent::where('tray_id', $tray->id)->get();

        $tradeins = array();

        foreach($trayContent as $tc){
            $tradein = Tradein::where('id', $tc->trade_in_id)->first();
            array_push($tradeins, $tradein);
        }

        return view('portal.trays.tray')->with(['portalUser'=>$portalUser, 'tray'=>$tray, 'trolleys'=>$trolleys, 'trayContetnt'=>$trayContent, 'tradeins'=>$tradeins]);
    }

    public function printTrayLabel(Request $request){

        $trayid = $request->trayid;

        $tray = Tray::where('id', $trayid)->first();

        $getlabel = new GetLabel();
        $pdf = $getlabel->getTrayLabel($tray);

        return response('pdf/traylabel-'.$tray->tray_name, 200);
        
    }

    public function addTrayToTrolley(Request $request){

        $tray = Tray::where('id', $request->tray_id)->first();
        $trolley = "";

        if($tray->trolley_id == null){
            $tray->trolley_id = $request->trolley_select;

            $tray->save();
    
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays +=1 ;
            $trolley->save();
        }
        else{
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays -=1 ;
            $trolley->save();

            $tray->trolley_id = $request->trolley_select;

            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays +=1 ;
            $trolley->save();

            $tray->save();
        }



        return redirect()->back()->with('success', 'You have assigned this tray to trolley '. $trolley->trolley_name);
    }

    public function deleteTray($id){
        $tray = Tray::where('id', $id)->first();
        if($tray->trolley_id != null){
            $traycontent = TrayContent::where('tray_id', $id)->get();
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
    
            foreach($traycontent as $trayitem){
                $tradein = Tradein::where('id', $trayitem->trade_in_id)->first();
                $tradein->delete();
            }

            $trolley->number_of_trays = $trolley->number_of_trays-1;
            $trolley->save();
        }

        $trayname = $tray->tray_name;

        $tray->delete();

        return redirect()->back()->with('success', 'You have succesfully deleted the tray with name '.$trayname);

    }

    public function downloadFile($file){
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
            File::delete($file);
            return \redirect()->back()->with('success','You have succesfully exported products.');
        }
    }

}
