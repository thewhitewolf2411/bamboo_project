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
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;

class TrolleyController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showTrolleysPage(){
        //if(!$this->checkAuthLevel(13)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::where('trolley_type', '!=', 'Bay')->get();

        return view('portal.trolleys.trolleys')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function showAddTrolleyPage(){
        //if(!$this->checkAuthLevel(12)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::where('trolley_type', '!=', 'Bay')->get();

        return view('portal.add.trolley')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function showTrolleyPage(Request $request){

        $trolleyid = $request->trolley_id_scan;

        $trolley = Trolley::where('trolley_name', $trolleyid)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleyTrays = Tray::where('trolley_id', $trolleyid)->get();


        return view('portal.trolleys.trolley')->with(['portalUser'=>$portalUser, 'trolley'=>$trolley, 'trolleyTrays'=>$trolleyTrays]);
    }

    public function printTrolleyLabel($id){

        $barcode = DNS1D::getBarcodeHTML($id, 'C128');

        $this->generateTrolleyLabel($barcode, $id);
    }

    public function generateTrolleyLabel($barcode, $id){
        

        $filename = "labeltrolley-" . $id . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.trolley', array('barcode'=>$barcode, 'id'=>$id))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function addTrolley(Request $request){

        if(count(Trolley::where('trolley_name', $request->trolley_name)->get()) >= 1){
            return redirect()->back()->with('error', $request->trolley_name . " trolley already exists.");
        }

        $trolley = new Trolley();

        $trolley->trolley_name = $request->trolley_name;
        $trolley->trolley_type = $request->trolley_name[0];
        $trolley->trolley_brand = $request->trolley_name[1];

        $trolley->save();

        return redirect('/portal/trolleys')->with('success', 'Trolley ' . $trolley->trolley_name . ' was succesfully created.');
    }

    public function deleteTrolley($id){
        $trolley = Trolley::where('id', $id)->first();
        $trays = Tray::where('trolley_id', $id)->get();
        
        foreach($trays as $tray){
            $traycontent = TrayContent::where('tray_id', $id)->get();
    
            foreach($traycontent as $trayitem){
                $tradein = Tradein::where('id', $trayitem->trade_in_id)->first();
                $tradein->delete();
            }

            $tray->delete();
        }

        $trolley->delete();

        return redirect()->back()->with('success', 'You have succesfully deleted the trolley and it\'s content.');
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
