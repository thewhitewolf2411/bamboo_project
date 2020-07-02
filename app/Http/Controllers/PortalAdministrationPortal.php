<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalAdministrationPortal extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function showAdminPortalSales(){
        return view('portal.administrationportal.sales');
    }

    public function showAdminPortalReportsAndStatistics(){
        return view('portal.administrationportal.reportsandstatistics');
    }

    public function showAdminPortalUserManagment(){
        return view('portal.administrationportal.usermanagment');
    }

    public function showAdminPortalTestingManagment(){
        return view('portal.administrationportal.testingmanagment');
    }

    public function showAdminPortalCustomerPayment(){
        return view('portal.administrationportal.customerpayment');
    }

    public function showAdminPortalManageManufacturer(){
        return view('portal.administrationportal.managemakemodel');
    }
}
