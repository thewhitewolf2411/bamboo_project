<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalCustomerCare extends Controller
{
    public function CarePortalAddOrder(){
        return view('portal.customercareportal.createorder');
    }

    public function CarePortalSearchOrder(){
        return view('portal.customercareportal.ordermanagment');
    }
}
