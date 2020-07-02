<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class PortalWarehouseReceiptDispatch extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function DispachPortalTradePackDispach(){

        return view('portal.warehousereceiptanddispatchportal.tradepackdispatch');
    }

    public function DispachPortalDeliveryReciving(){
        return view('portal.warehousereceiptanddispatchportal.deliveryreceiving');
    }
}
