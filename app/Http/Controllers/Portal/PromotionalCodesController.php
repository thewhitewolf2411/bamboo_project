<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\PortalUsers;
use App\Eloquent\SellingProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\PromotionalCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PromotionalCodesController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }

    public function index(){
        $promocodes = PromotionalCode::all();
        return view('portal.promocodes.index', ['portalUser' => PortalUsers::find(Auth::user()->id), 'promocodes' => $promocodes]);
    }

    public function create(){
        $devices = SellingProduct::all();
        return view('portal.promocodes.create', ['portalUser' => PortalUsers::find(Auth::user()->id), 'devices' => $devices]);
    }

    public function savePromoCode(Request $request)
    {
        //dd($request->all());
        PromotionalCode::create([
            'type' => 1,
            'name' => $request->name,
            'apply_rules' => $request->apply_rules,
            'promotional_code' => $request->promotional_code,
            'expires_at' => Carbon::parse($request->expires_at),
            'value' => $request->value
        ]);

        return redirect('/portal/promocodes')->with('success', 'Promotional code created successfully.');
    }

    public function showEditPromoCode($id){
        if(isset($id)){
            $promocode = PromotionalCode::find($id);
            $devices = SellingProduct::all();
            return view('portal.promocodes.edit', [
                'portalUser' => PortalUsers::find(Auth::user()->id), 
                'promocode' => $promocode, 
                'devices' => $devices
            ]);
        }
    }

    public function updatePromoCode($id){
        if(isset($id)){
            $promocode = PromotionalCode::find($id);
            $promocode->type = 1;
            $promocode->name = request()->name;
            $promocode->apply_rules = request()->apply_rules;
            $promocode->promotional_code = request()->promotional_code;
            $promocode->expires_at = Carbon::parse(request()->expires_at);
            $promocode->value = request()->value;
            
            $promocode->save();
            return redirect('/portal/promocodes')->with('info', 'Promotional code updated successfully.');
        }
    }

    public function deletePromoCode($id){
        if(isset($id)){
            $promocode = PromotionalCode::find($id);
            $promocode->delete();
            return redirect('/portal/promocodes')->with('info', 'Promotional code deleted successfully.');
        }
    }
}
