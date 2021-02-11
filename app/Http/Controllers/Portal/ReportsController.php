<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showReportsPage(){
        //if(!$this->checkAuthLevel(7)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.reports')->with('portalUser', $portalUser);
    }
}
