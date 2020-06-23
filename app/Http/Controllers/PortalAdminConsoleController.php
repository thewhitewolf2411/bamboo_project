<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalAdminConsoleController extends Controller
{
    public function showAdminConsoleAddUser(){
        return view('portal.warehouseadministrationconsole.createuser');
    }

    public function showAdminConsoleUserManagment(){
        return view('portal.warehouseadministrationconsole.usermanagment');
    }

    public function showAdminConsoleReportsAndStatistics(){
        return view('portal.warehouseadministrationconsole.reportsandstatistics');
    }

    public function showAdminConsoleStuckDevices(){
        dd("Create user view");
    }

    public function showAdminConsoleOnlineUser(){
        dd("Create user view");
    }
}
