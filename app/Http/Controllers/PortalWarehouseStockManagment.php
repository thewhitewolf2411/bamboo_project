<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalWarehouseStockManagment extends Controller
{
    public function StockPortalDeviceTestStockManagment(){
        return view('portal.warehousestockmanagmentportal.devicetesterstockmanagment');
    }

    public function StockPortalTrolleyManagment(){
        return view('portal.warehousestockmanagmentportal.trolleymanagment');
    }

    public function StockPortalTrayManagment(){
        return view('portal.warehousestockmanagmentportal.traymanagment');
    }

    public function StockPortalStockTransfer(){
        return view('portal.warehousestockmanagmentportal.stocktransfer');
    }

    public function StockPortalStockManagment(){
        return view('portal.warehousestockmanagmentportal.stockmanagment');
    }

    public function StockPortalQuarantineManagment(){
        return view('portal.warehousestockmanagmentportal.quarantinemanagment');
    }

    public function StockPortalSalesandDispach(){
        return view('portal.warehousestockmanagmentportal.salesanddispatch');
    }

    public function StockPortalDeviceManagment(){
        return view('portal.warehousestockmanagmentportal.devicemanagment');
    }
}
