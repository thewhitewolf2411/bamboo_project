<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Eloquent\PortalUsers;
use App\Eloquent\SalesLot;
use App\Eloquent\SalesLotContent;
use App\Eloquent\Tradein;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use Illuminate\Support\Facades\Auth;
use Session;

class SalesLotController extends Controller
{
    public function showSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.sales-lot.sales-lot', ['portalUser'=>$portalUser]);
    }

    public function showBuildingSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $boxes = Tray::where('tray_type', 'Bo')->where('status', 3)->get();
        $tradeins = array();

        foreach($boxes as $box){
            $boxcontent = TrayContent::where('tray_id', $box->id)->get();

            foreach($boxcontent as $bc){
                $tradein = Tradein::where('id', $bc->trade_in_id)->first();
                array_push($tradeins, $tradein);
            }
        }


        return view('portal.sales-lot.building-sales-lot', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins, 'boxes'=>$boxes]);
    }

    public function buildSalesLot(Request $request){

        $selectedBoxes = $request->selectedBoxes;
        $selectedTradeins = $request->selectedTradeIns;

        $boxcontent = "";
        if(is_array($selectedTradeins)){
            $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get()->groupBy('tray_id');
            foreach($boxcontent as $key=>$bc){
                if(is_array($selectedBoxes) && in_array($key, $selectedBoxes)){
                    $pos = array_search($key, $selectedBoxes);
                    unset($selectedBoxes[$pos]);
                }
            }
        }
        else{
            $boxcontent = array();
        }
        $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get(); //->groupBy('tray_id');
        $boxcontent2 = TrayContent::whereIn('tray_id', $selectedBoxes)->get(); //->groupBy('tray_id');

        $allItems = $boxcontent->merge($boxcontent2);
        $allItems = $allItems->groupBy('tray_id');

        $boxes = array();

        foreach($allItems as $key=>$item){
            $box = Tray::where('id', $key)->first();
            $box->total_cost = 0;
            $box->total_qty = count($allItems[$key]);
            array_push($boxes, $box);
        }

        $boxcontent = TrayContent::whereIn('trade_in_id', $selectedTradeins)->get();
        $boxcontent2 = TrayContent::whereIn('tray_id', $selectedBoxes)->get();
        $boxcontent = $boxcontent->toArray();
        $boxcontent2 = $boxcontent2->toArray();
        #dd($boxcontent, $boxcontent2);
        $allTradeins = array_merge($boxcontent, $boxcontent2);

        Session::put(['allTradeins'=>$allTradeins, 'allItems'=>$allItems, 'boxes'=>$boxes]);

        return response([$allTradeins, $allItems, $boxes], 200);
        
    }

    public function getBoxName($id){
        return Tray::where('id', $id)->first()->tray_name;
    }

    public function getBoxData(Request $request){
        #dd(Session::get('allItems'), $request->all());

        $tradeins = array();
        foreach(Session::get('allItems') as $key=>$item){
            if($key === intval($request->boxid)){
                foreach($item as $i){
                    $tradein = Tradein::where('id', $i->trade_in_id)->first();
                    array_push($tradeins, $tradein);
                }
            }
        }

        return response($tradeins, 200);
    }

    public function showCompletedSalesLotPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        $salesLots = SalesLot::all();

        return view('portal.sales-lot.completed-sales-lot', ['portalUser'=>$portalUser, 'salesLots'=>$salesLots]);
    }

    public function getSalesLotContent(Request $request){
        $salesLotContentBoxes = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('device_id', null)->get();
        $salesLotContentDevices = SalesLotContent::where('sales_lot_id', $request->saleslotid)->where('box_id', null)->get();

        $boxes = array();
        $devices = array();

        foreach($salesLotContentBoxes as $sLCB){
            $box = Tray::where('id', $sLCB->box_id)->first();

            if($box->trolley_id == null){
                $box->trolley_id = 'Box not placed in a bay.';
            }
            else{
                $box->trolley_id = $box->getTrolleyName($box->trolley_id);
            }
            array_push($boxes, $box);
        }

        foreach($salesLotContentDevices as $sLCD){
            $device = Tradein::where('id', $sLCD->device_id)->first();
            $device->product_name = $device->getProductName($device->product_id);
            $device->box_location = $device->getTrayName($device->id);
            $device->bay_location = $device->getBayName();
            array_push($devices, $device);
        }

        return response(['boxes'=>$boxes, 'devices'=>$devices], 200);
    }

    public function changeSalesLotState(Request $request){

        #dd($request->all());

        $salesLot = SalesLot::where('id', $request->saleslotid)->first();

        $salesLotStatus = $salesLot->sales_lot_status;

        if(intval($salesLotStatus) === intval($request->changestate)){
            return redirect()->back()->with('error', 'Lot no.' . $salesLot->id . ' is already marked as "' . $salesLot->getStatus(intval($request->changestate)) . '"');
        }

        if($salesLotStatus + 1 === intval($request->changestate)){
            $salesLot->sales_lot_status = $salesLot->sales_lot_status + 1;
            
            if(isset($request->customername)){
                $salesLot->sold_to = $request->customername;
            }

            if($request->changestate === '2'){
                $salesLot->date_sold = \Carbon\Carbon::now();
            }

            if($request->changestate === '4'){
                $salesLot->payment_date = \Carbon\Carbon::now();
            }

            $salesLot->save();

            return redirect()->back()->with('success', 'You have succesfully changed state of Lot no.' . $salesLot->id . ' to "' . $salesLot->getStatus($salesLot->sales_lot_status) . '"');
        }
        else{
            return redirect()->back()->with('error', 'You cannot change state of Lot no.' . $salesLot->id . ' to "' . $salesLot->getStatus(intval($request->changestate)) . '"');
        }

    }
}
