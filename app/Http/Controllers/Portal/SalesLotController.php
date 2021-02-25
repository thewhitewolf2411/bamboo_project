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
        
        #dd($request->all());

        $selectedBoxes = $request->selectedBoxes;
        $selectedTradeins = $request->selectedTradeIns;

        #dd($selectedBoxes, $selectedTradeins);

        
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
