<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Tradein;
use App\Services\Reports;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showReportsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.reports')->with('portalUser', $portalUser);
    }


    public function showReportsOverviewPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::all();

        return view('portal.reports.overview', ['portalUser'=>$portalUser, 'tradeins'=>$tradeins]);
    }

    public function showReportsStockPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.stock', ['portalUser'=>$portalUser]);
    }

    public function showReportsReceivingPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.receiving', ['portalUser'=>$portalUser]);
    }

    public function showReportsTestingPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.testing', ['portalUser'=>$portalUser]);
    }

    public function showReportsAwaitingPaymentPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.awaiting-payment', ['portalUser'=>$portalUser]);
    }

    public function showReportsRecycleCustomerReturnsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.recycle-customer-returns', ['portalUser'=>$portalUser]);
    }

    public function showReportsFinanceRecycleReportsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.finance-recycle-reports', ['portalUser'=>$portalUser]);
    }


    public function generateOverviewReport(){
        
        $reports = new Reports();

        $file = $reports->overviewReport();
        #dd($file);

        return response($file, 200);

    }

    public function generateStockReport(){
        $reports = new Reports();

        $file = $reports->stockReport();
        #dd($file);

        return response($file, 200);
    }

    public function generateReceivingReport(){
        $reports = new Reports();

        $file = $reports->receivingReport();
        #dd($file);

        return response($file, 200);
    }

    public function generateTestingReport(){
        $reports = new Reports();

        $file = $reports->testingReport();

        return response($file, 200);
    }

}
