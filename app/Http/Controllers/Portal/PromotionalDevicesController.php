<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\SellingProduct;
use App\Eloquent\PromotionalDevices;

class PromotionalDevicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAuth');
    }

    public function index(){
        
        return view('portal.promodevices.index', ['portalUser' => PortalUsers::find(Auth::user()->id)]);

    }

    public function mainSite(){

        $devices = SellingProduct::all();
        $selectedDevices = PromotionalDevices::where('promo_type', 1)->first();

        return view('portal.promodevices.mainindex', ['portalUser' => PortalUsers::find(Auth::user()->id), 'devices'=>$devices, 'selectedDevices'=>$selectedDevices]);
    }

    public function mapSite(){

        $devices = SellingProduct::all();
        $selectedDevices = PromotionalDevices::where('promo_type', 2)->get();
        $selectedDevice = PromotionalDevices::find(1);

        return view('portal.promodevices.mapindex', ['portalUser' => PortalUsers::find(Auth::user()->id), 'devices'=>$devices, 'selectedDevices'=>$selectedDevices, 'selectedDevice'=>$selectedDevice]);
    }

    public function editPromoDevices(Request $request){
        $requestData = $request->all();

        $promotionalDevices = PromotionalDevices::where('promo_type', 1)->first();

        if($requestData['promo-option-1'] &&  $requestData['promo-option-1'] !== null){
            $promotionalDevices->device_1 = $requestData['promo-option-1'];
        }
        if($requestData['promo-option-2'] &&  $requestData['promo-option-2'] !== null){
            $promotionalDevices->device_2 = $requestData['promo-option-2'];
        }
        if($requestData['promo-option-3'] &&  $requestData['promo-option-3'] !== null){
            $promotionalDevices->device_3 = $requestData['promo-option-3'];
        }
        if($requestData['promo-option-4'] &&  $requestData['promo-option-4'] !== null){
            $promotionalDevices->device_4 = $requestData['promo-option-4'];
        }

        $promotionalDevices->save();

        return redirect()->back()->with('promo_success', 'Promotional devices succesfully added');
        
    }

    public function editMapPromoDevices(Request $request){
        $requestData = $request->all();

        for($i = 1; $i<=4; $i++){
            for($j = 1; $j<=3; $j++){
                if($requestData['promo-option-' . $i . '-' . $j]){
                    if($i === 1){
                        $promotionalDevices = PromotionalDevices::find(2);
                        if($j === 1){
                            $promotionalDevices->device_1 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 2){
                            $promotionalDevices->device_2 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 3){
                            $promotionalDevices->device_3 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        $promotionalDevices->save();
                    }
                    if($i === 2){
                        $promotionalDevices = PromotionalDevices::find(3);
                        if($j === 1){
                            $promotionalDevices->device_1 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 2){
                            $promotionalDevices->device_2 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 3){
                            $promotionalDevices->device_3 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        $promotionalDevices->save();
                    }
                    if($i === 3){
                        $promotionalDevices = PromotionalDevices::find(4);
                        if($j === 1){
                            $promotionalDevices->device_1 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 2){
                            $promotionalDevices->device_2 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 3){
                            $promotionalDevices->device_3 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        $promotionalDevices->save();
                    }
                    if($i === 4){
                        $promotionalDevices = PromotionalDevices::find(5);
                        if($j === 1){
                            $promotionalDevices->device_1 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 2){
                            $promotionalDevices->device_2 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        if($j === 3){
                            $promotionalDevices->device_3 = $requestData['promo-option-' . $i . '-' . $j];
                        }
                        $promotionalDevices->save();
                    }
                }
            }
        }


        return redirect()->back()->with('map_promo_success', 'Promotional devices succesfully added');
    }
}
