<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function showPaymentPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.payments')->with('portalUser', $portalUser);
    }

    public function showPaymentAwaitingPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.awaiting');
    }

    public function showPaymentPendingPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.pending')->with('portalUser', $portalUser);
    }

    public function showPaymentCompletedPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.completed')->with('portalUser', $portalUser);
    }

    public function showPaymentReportsPage(){
        //if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.reports')->with('portalUser', $portalUser);
    }
}
