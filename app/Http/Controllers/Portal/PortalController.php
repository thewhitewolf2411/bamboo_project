<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Category;
use App\Eloquent\BuyingProduct;
use App\Eloquent\BuyingProductColours;
use App\Eloquent\BuyingProductInformation;
use App\Eloquent\BuyingProductNetworks;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductData;
use App\Eloquent\Brand;
use App\Eloquent\PortalUsers;
use App\Eloquent\Feed;
use App\Eloquent\Conditions;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use App\Eloquent\Quarantine;
use App\Eloquent\Tray;
use App\Eloquent\TrayContent;
use App\Eloquent\Trolley;
use App\Eloquent\TrolleyContent;
use App\Eloquent\Box;
use App\Eloquent\Colour;
use App\Eloquent\Network;
use App\Eloquent\ProductNetworks;
use App\Eloquent\Memory;
use App\Eloquent\ImeiResult;
use App\Eloquent\TestingFaults;
use App\User;
use Auth;
use Schema;
use DNS1D;
use DNS2D;
use PDF;
use Crypt;
use Carbon\Carbon;
use Session;
use Storage;
use File;
use Hash;
use DB;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

class PortalController extends Controller
{

    protected $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            abort_unless(auth()->check() && auth()->user()->type_of_user > 0, 403, "Forbidden.");
            return $next($request);
        });
    }

    public function portal(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal')->with('portalUser', $portalUser);
    }


    function generateNewLabel($barcode, $tradein_barcode, $manifacturer, $model, $imei, $location){

        $customPaper = array(0,0,141.90,283.80);

        $pdf = PDF::loadView('portal.labels.devicelabel', 
        array(
            'barcode'=>$barcode,
            'tradein_barcode'=>$tradein_barcode,
            'manifacturer'=>$manifacturer,
            'model'=>$model,
            'imei'=>$imei,
            'location'=>$location))
        ->setPaper($customPaper, 'landscape')
        ->save('pdf/devicelabel-'. $tradein_barcode .'.pdf');
    
    }
    

}

