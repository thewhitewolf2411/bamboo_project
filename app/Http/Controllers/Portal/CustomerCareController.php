<?php

namespace App\Http\Controllers\Portal;

use App\Audits\TradeinAudit;
use App\Audits\TradeinAuditNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Eloquent\TestingFaults;
use App\Eloquent\SellingProduct;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\User;
use Auth;
use DNS1D;
use DNS2D;
use PDF;

class CustomerCareController extends Controller
{
    public function showCustomerCare(){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.customer-care')->with('portalUser', $portalUser);
    }

    public function showTradeIn(Request $request){

        //if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeins = null;
        $search = null;


        if($request->all() == null || $request->search == 0){


            $tradeins = Tradein::all()->where('job_state', "1")->groupBy('barcode');

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if(is_numeric($request->search) === true && $request->search <= 3){
                $tradeins = Tradein::where('job_state', "1")->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{

                $tradeins = Tradein::where('barcode', $request->search)->get();

                if(count($tradeins) < 1){
                    $tradeins = Tradein::where('product_state', 'like', '%' . $request->search . '%');

                }
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with those search parameters. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.customer-care.trade-in')->with('tradeins', $tradeins)->with('portalUser', $portalUser)->with('search',$search);
    }

    /**
     * Show tradein details.
     */
    public function showTradeInDetails($id){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradein = Tradein::where('barcode', $id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user = User::where('id', $tradein[0]->user_id)->first();

        $tradein_audits = TradeinAudit::with('notes')->where('tradein_id', $tradein[0]->id)->orderBy('created_at', 'desc')->get();
        foreach($tradein_audits as $audit){
            $audit->notes_count = $audit->notes->count();
            foreach($audit->notes as $note){
                $note->date = $note->created_at->format('d.m.Y H:i');
                $note->user = User::find($note->user_id)->fullName();
            }
        }

        // foreach($tradein_audits as $audit){
        //     $barcode = null;
        //     //$product = null;
        //     $customer_status = null;
        //     $bamboo_status = null;
            
        //     if($audit['column_name'] === 'barcode'){
        //         $barcode = $audit['new_value'];
        //     } else {
        //         $barcode = $trade_in->barcode;
        //     }
        //     if($audit['column_name'] === 'job_state'){
        //         $job_state = $audit['new_value'];
        //         $customer_status = $trade_in->getDeviceStatus($trade_in->id, $job_state)[1];
        //         $bamboo_status = $trade_in->getDeviceStatus($trade_in->id, $job_state)[0];
        //     } else {
        //         $customer_status = $trade_in->getCustomerStatus();
        //         $bamboo_status = $trade_in->getBambooStatus();
        //     }


        //     //$barcode = (isset($audit))
        //     array_push($audits, [
        //         'pos' => $position,
        //         'date_placed' => $audit->created_at->format('d/m/Y H:i'),
        //         'tradein_id' => $barcode,
        //         'tradein_barcode' => $trade_in->barcode_original,
        //         'product' => $trade_in->getProductName($trade_in->product_id),
        //         'user' => Auth::user()->fullName(),
        //         'customer_status' => $customer_status,
        //         'bamboo_status' => $bamboo_status,
        //         'customer_grade' => 'Gr8 m8',
        //         'bamboo_grade' => 'Gr8 m8',
        //         'value' => '3 KM',
        //         'stock_location' => 'Somewhere',
        //         'cheque_number' => '12345',
        //     ]);
        //     $position++;
        // }


        $testingfaults = TestingFaults::where('tradein_id', $tradein[0]->id)->first();

        return view('portal.customer-care.trade-in-details')
            ->with([    'tradeins'=>$tradein,
                        'portalUser'=>$portalUser,
                        'user'=>$user,
                        'barcode'=>$id,
                        'testingfaults'=>$testingfaults,
                        'audits' => $tradein_audits
                ]);
    }

    public function showMoreTradeInDetails($id){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user = User::where('id', $tradein->user_id)->first();
        return view('portal.customer-care.trade-in-product-details')->with('tradein', $tradein)->with('portalUser', $portalUser)->with('user', $user);
    }

    /**
     * Store tradein audit note.
     */
    public function addAuditNote(Request $request){
        if(isset($request->id) && isset($request->note)){
            $audit_note = new TradeinAuditNote([
                'tradein_audit_id' => $request->id,
                'user_id' => Auth::user()->id,
                'note' => $request->note
                ]);
            $audit_note->save();
            return response(200);
        }
    }

    /**
     * Update audit note.
     */
    public function updateAuditNote(Request $request){
        if(isset($request->id) && isset($request->note)){
            $audit_note = TradeinAuditNote::find($request->id);
            $audit_note->note = $request->note;
            $audit_note->save();
            return response(200);
        }
    }

    /**
     * Delete audit note.
     */
    public function deleteAuditNote(Request $request){
        if(isset($request->id)){
            $audit_note = TradeinAuditNote::find($request->id);
            $audit_note->delete();
            return response(200);
        }
    }


    public function PrintTradeInLabelBulk(Request $request){

        $html = "";
        $barcodes = array();

        foreach($request->all() as $item){
            array_push($barcodes, $item);
        }

        $barcodes = array_slice($barcodes, 1);

        $tradeins = array();

        foreach($barcodes as $barcode){
            $tradein = Tradein::where('barcode', $barcode)->first();
            array_push($tradeins, $tradein);
        }

        if(count($tradeins)>50){
            return \redirect()->back()->with('error', 'You can\'t print more than 50 tradeins in one go.');
        }

        foreach($barcodes as $barcode){
            $tiarr = Tradein::where('barcode', $barcode)->get();
            foreach($tiarr as $tradein){
                $tradein->job_state = 3;
                $tradein->save();
            }
        }

        $labels = array();

        ini_set('max_execution_time', 120);

        foreach($tradeins as $tradein){

            $user = User::where('id',$tradein->user_id)->first();
            $product = SellingProduct::where('id', $tradein->product_id);
            $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');
            $delAdress = strtr($user->delivery_address, array(', '=>'<br>'));
            $delAdress = \explode('<br>', $delAdress);

            $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
            $pdf = PDF::loadView('portal.labels.tradeinlabel', 
                array('user'=>$user, 'deladdress'=>$delAdress, 'tradein'=>$tradein, 'barcode'=>$barcode))
                ->save('pdf/tradeinlabel-'. $tradein->barcode .'.pdf');

            array_push($labels, 'pdf/tradeinlabel-'. $tradein->barcode .'.pdf');

        }

        $pdfMerger = \LynX39\LaraPdfMerger\Facades\PdfMerger::init();
    
        foreach($labels as $label){
            $pdfMerger->addPDF($label, 1);
        }

        $pdfMerger->merge();

        $mergedname = '/pdf/tradeinlabels-' . date('Y-m-d') . '.pdf';

        $pdfMerger->save( public_path() . $mergedname);


        return redirect()->back()->with('bulk', $mergedname);
    }

    public function PrintTradeInLabel(Request $request){

        $tradeins = Tradein::where('barcode', $request->hidden_print_trade_pack_trade_in_id)->get();
        $user = User::where('id',$tradeins[0]->user_id)->first();
        $productIds = array();

        foreach($tradeins as $tradein){
            
            if($tradein->job_state < 4){
                $tradein->job_state = 3;
                $tradein->save();
            }

            array_push($productIds, $tradein->product_id);
        }

        $products = SellingProduct::whereIn('id', $productIds)->get();
        $tradein = Tradein::where('barcode',$request->hidden_print_trade_pack_trade_in_id)->first();

        $barcode = DNS1D::getBarcodeHTML($request->hidden_print_trade_pack_trade_in_id, 'C128');
        $delAdress = strtr($user->delivery_address, array(', '=>'<br>'));
        $delAdress = \explode('<br>', $delAdress);

        $pdf = PDF::loadView('portal.labels.tradeinlabel', array('user'=>$user, 'deladdress'=>$delAdress, 'tradein'=>$tradein, 'barcode'=>$barcode))->save('pdf/tradeinlabel-'. $request->hidden_print_trade_pack_trade_in_id .'.pdf');

        return redirect()->back()->with('success', 'pdf/tradeinlabel-'. $request->hidden_print_trade_pack_trade_in_id .'.pdf');
    
    }

    public function deleteTradeInFromSystem(Request $request){
        $tradein = Tradein::where('barcode', $request->delete_trade_in_id)->get();
        foreach($tradein as $ti){
            $ti->delete();
        }

        return redirect()->back();
    }

    public function deleteTradeIn($id){
        $tradein = Tradein::where('barcode', $id)->get();

        $barcode = $id;

        foreach($tradein as $ti){
            $ti->delete();
        }

        return redirect()->back()->with('success', 'You have succesfully deleted '. $barcode . ' from system.');
    }

    public function returnToTesting($id){
        $tradein = Tradein::where('id', $id)->first();

        if($tradein->proccessed_before){
            return redirect()->back()->with('error', 'This device was already tested second time.');
        }

        $tradein->job_state = 6;
        $tradein->save();

        return redirect()->back()->with('success', 'You have succesfully returned '. $tradein->barcode . ' to testing.');

    }

    public function showTradeOut(){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradeouts = Tradeout::all();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-out')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser);
    }

    public function showTradeOutDetails($id){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradeout = Tradeout::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-out-details')->with('tradeout', $tradeout)->with('portalUser', $portalUser);
    }

    public function showDestroyDevice(){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.destroy')->with('portalUser', $portalUser);
    }

    private function getOrderNumbersSorted($array){
        foreach($array as $key=>$item){
            $k = 0;

            foreach($item as $order){
                if($order->barcode !== $key){
                    $k++;
                }
            }

            if($k === count($item)){
                $array->forget($key);
            }

        }

        return $array;
    }

    public function showTradePack(Request $request){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $search = null;

        if($request->all() == null || $request->search == 0){

            $tradeins = Tradein::where('job_state', 2)->orWhere('job_state', 3)->get()->groupBy('barcode_original');

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 2)->orWhere('job_state', 3)->get();

                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();

                foreach($tradeins as $key=>$tradein){
                    if($tradein->getCategoryId($tradein->product_id) !== intval($request->search)){
                        $tradeins->forget($key);
                    }  
                }

                $tradeins = $tradeins->groupBy('barcode_original');
            }
            else{
                
                $tradeins = Tradein::where('job_state', 2)->orWhere('job_state', 3)
                                    ->where('barcode', $request->search)
                                    ->orWhere('barcode_original', $request->search)
                                    ->get();
                #dd($tradeins->toSql());
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode_original');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }

        return view('portal.customer-care.trade-pack')->with('portalUser', $portalUser)->with('tradeins', $tradeins)->with('title', 'Awaiting receipt')->with('search', $search);
    }

    public function setTradePackAsSent(Request $request){
        $tradein = Tradein::where('id', $request->set_trade_in_as_sent)->first();
        $tradein->job_state = 2;
        $tradein->save();
        return redirect()->back();
    }

    public function showSeller(){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $users = User::where('type_of_user', 0)->get();

        return view('portal.customer-care.seller')->with(['portalUser'=>$portalUser, 'users'=>$users]);
    }

    public function showSellerDetails($id){

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $user = User::where('id', $id)->first();

        return view('portal.customer-care.sellerdetails')->with(['portalUser'=>$portalUser, 'user'=>$user]);
    }

    public function disableSellerAccount($id){
        $user = User::where('id', $id)->first();
        $user->account_disabled = true;
        $user->save();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully disabled.');
    }

    public function enableSellerAccount($id){
        $user = User::where('id', $id)->first();
        $user->account_disabled = false;
        $user->save();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully enabled.');
    }

    public function deleteUserAccount($id){
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully deleted.');
    }

    public function createOrder(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.createorder')->with(['portalUser'=>$portalUser]);
    }

    public function markForReprint($id){
        $tradein = Tradein::where('id', $id)->first();
        $tradein->job_state = null;
        $tradein->save();

        return redirect()->back()->with('success', 'Tradein with id '. $tradein->id . ' has been sent to reprint.');
    }

    /**
     * Show order managment table.
     */
    public function showOrderManagment(Request $request){
        //if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::all()->groupBy('barcode');

        if($request->all() == null || $request->search == 0){
            $tradeins = Tradein::all()->groupBy('barcode');

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::all();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    if($tradein->getCategoryId($tradein->product_id) != $request->search){
                        $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->orWhere('barcode_original', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }

        return view('portal.customer-care.order-management')->with('portalUser', $portalUser)->with('tradeins', $tradeins)->with('title', 'Order Management')->with('search', $request->search);
    }

    /**
     * Send device to despatch.
     */
    public function sendToDespatch(){
        if(isset(request()->id)){
            $tradeIn = Tradein::find(request()->id);
            if($tradeIn){
                # received and passed
                $tradeIn->job_state = 11;
                $tradeIn->save();
                return response(200);
            }
        }
    }

    public function sendDeviceBackToReceive($barcode){
        $tradein = Tradein::where('barcode', $barcode)->first();

        $tradein->job_state = 2;
        $tradein->received = 0;
        $tradein->device_missing = null;
        $tradein->device_correct = null;
        $tradein->chekmend_passed = null;
        $tradein->imei_number = null;
        $tradein->marked_as_risk = null;
        $tradein->marked_for_quarantine = null;
        $tradein->visible_imei = null;
        $tradein->bamboo_grade = null;
        $tradein->save();

        $trayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
        $trayContent->delete();

        return redirect()->back();

    }

    public function sendDeviceBackToTest($barcode){
        $tradein = Tradein::where('barcode', $barcode)->first();

        $tradein->job_state = 4;
        $tradein->save();

        return redirect()->back();
    }

    public function cancelOrder($id){
        $tradein = Tradein::where('id', $id)->first();
        $tradein->delete();

        return redirect()->back();
    }

    public function checkAuthLevel($data){
       
        return true;

    }

    public function printDeviceLabel(Request $request){

        $tradein = Tradein::where('barcode', $request->print_device_id)->first();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $trayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
        $tray = Tray::where('id', $trayContent->tray_id)->first();

        $response = $this->generateNewLabel($barcode, $tradein->barcode, $tradein->getBrandName($tradein->product_id), $tradein->getProductName($tradein->product_id), $tradein->imei_number, $tray->tray_name);

        return redirect()->back()->with(['success'=>'pdf/devicelabel-'. $tradein->barcode .'.pdf']);

    }

    public function generateNewLabel($barcode, $tradein_barcode, $manifacturer, $model, $imei, $location){
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

}
