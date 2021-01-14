<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DNS1D;
use DNS2D;
use PDF;
use File;
use App\Eloquent\PortalUsers;
use App\Eloquent\Box;

class BoxController extends Controller
{
    public function showBoxesPage(){
        //if(!$this->checkAuthLevel(14)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $boxes = Box::all();

        return view('portal.boxes.boxes')->with(['portalUser'=>$portalUser, 'boxes'=>$boxes ]);
    }

    public function showAddBoxPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.box')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
    }

    public function showBoxPage(Request $request){
        //if(!$this->checkAuthLevel(14)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $box = Box::where('box_name',$request->box_id_scan)->first();

        return view('portal.boxes.box')->with(['portalUser'=>$portalUser, 'box'=>$box ]);
    }

    public function addBox(Request $request){
        
        $boxes = Box::where('box_name', $request->box_name)->get();
        if(count($boxes)>=1){
            return redirect('/portal/boxes')->with('error', 'Box with name '.$request->box_name.' already exists.');
        }
        
        $box = new Box();
        if($request->brands == "Apple"){
            $box->manifacturer = "Apple";
        }
        elseif($request->brands == "Samsung"){
            $box->manifacturer = "Samsung";
        }
        elseif($request->brands == "Huawei"){
            $box->manifacturer = "Huawei";
        }
        else{
            $box->manifacturer = "Miscenalious";
        }
        $box->box_name = $request->box_name;
        $box->description = $request->box_description;

        $box->save();

        return redirect('/portal/boxes')->with('error', 'Box with name '.$request->box_name.' already exists.');
    }

    public function removeBox($parameter){
        $box = Box::where('id', $parameter)->first();

        $boxname = $box->box_name;

        $box->delete();
        

        return redirect('/portal/boxes')->with('success', 'Box with name '.$boxname.' was succesfully deleted.');
    }

    public function showAddDeviceToBoxPage($boxname){

        $box = Box::where('box_name', $boxname)->first();

        $box_mark = $this->get_string_between($box->box_name, '(', ')');
        $brand_id = substr($boxname, -4, 1);

        $tradeins = "";

        if($brand_id === "A"){
            $brand_id = 1;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    dd($tradein);
                }
            }
        }
        elseif($brand_id === "S"){
            $brand_id = 2;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    $tradeins->forget($key);
                }
            }
        }
        elseif($brand_id === "H"){
            $brand_id = 3;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    $tradeins->forget($key);
                }
            }
        }
        else{
            $brand_id = 4;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) <= 3){
                    $tradeins->forget($key);
                }
            }
        }
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.boxes.adddevice')->with(['avalibleDevices'=>$tradeins, 'portalUser'=>$portalUser]);
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
