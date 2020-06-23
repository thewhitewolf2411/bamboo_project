<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalPhoneTesting extends Controller
{
    public function TestingPortalDeviceTesting(){
        return view('portal.phonetestingportal.devicetesting');
    }

    public function TestingPortalBoxManagment(){
        return view('portal.phonetestingportal.boxmanagment');
    }
}
