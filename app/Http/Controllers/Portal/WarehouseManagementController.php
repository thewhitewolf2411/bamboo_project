<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Eloquent\PortalUsers;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\Box;
use App\Eloquent\BoxContent;

class WarehouseManagementController extends Controller
{
    public function showWarehouseManagementPage(){

        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.warehouse-management', ['portalUser'=>$portalUser]);
    }

    public function showBoxManagementPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();
        $boxes = Box::all();

        return view('portal.warehouse.box-management', ['portalUser'=>$portalUser, 'boxes'=>$boxes]);
    }

    public function showBayOverviewPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.bay-overview', ['portalUser'=>$portalUser]);
    }

    public function showPickingDespatchPage(){
        $user = Auth::user();
        $portalUser = PortalUsers::where('user_id', $user->id)->first();

        return view('portal.warehouse.picking-despatch', ['portalUser'=>$portalUser]);
    }
}
