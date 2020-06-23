<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalWarehouseReceiptDispatch extends Controller
{
    public function DispachPortalTradePackDispach(){
        return view('portal.warehousereceiptanddispatchportal.tradepackdispatch');
    }

    public function DispachPortalDeliveryReciving(){
        return view('portal.warehousereceiptanddispatchportal.deliveryreceiving');
    }
}
