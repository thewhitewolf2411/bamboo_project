<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;

class CmsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showCmsPage(){
        //if(!$this->checkAuthLevel(11)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.cms.cms')->with('portalUser', $portalUser);
    }
}
