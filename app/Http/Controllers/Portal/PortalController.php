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
use App\Eloquent\Message;
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
        $this->middleware('checkAuth');
    }

    public function portal(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $newMessages = count(Message::where('seen', false)->get());

        return view('portal', ['portalUser'=>$portalUser, 'newMessages'=>$newMessages]);
    }


    function generateNewLabel($barcode, $tradein_barcode, $manifacturer, $model, $imei, $location){

    
    }

    public function seedDataPage(){

        $sellingProducts = SellingProduct::all();

        return view('portal.add.databaseseeder')->with(['sellingProducts'=>$sellingProducts]);


    }

    public function seedData(Request $request){
        #dd($request->{"sellingProductNumber-" . $sellingProduct->id});

        $sellingProducts = SellingProduct::all();

        foreach($sellingProducts as $sellingProduct){
            if($request->{"sellingProductNumber-" . $sellingProduct->id} !== null){
                $k = $request->{"sellingProductNumber-" . $sellingProduct->id};

                for($i = 0; $i<$k; $i++){

                    $tradeinbarcode = 10000000 + rand(100000, 9000000);
                    $productInformation = ProductInformation::where('product_id', $sellingProduct->id)->get();
                    $productNetwork = ProductNetworks::where('product_id', $sellingProduct->id)->get();
                    $networks = Network::all();
                    $inf = rand(0, count($productInformation)-1);
                    $net = rand(0, count($productNetwork)-1);

                    $state = rand(0, 4);
                    $stateString = "";
                    $statePrice = "";
                    switch($state){
                        case 0:
                            $stateString = "Excellent Working";
                            $statePrice = $productInformation[$inf]->excellent_working-$productNetwork[0]->knockoff_price;
                            break;
                        case 1:
                            $stateString = "Good Working";
                            $statePrice = $productInformation[$inf]->good_working-$productNetwork[1]->knockoff_price;
                            break;
                        case 2:
                            $stateString = "Poor Working";
                            $statePrice = $productInformation[$inf]->poor_working-$productNetwork[2]->knockoff_price;
                            break;
                        case 3:
                            $stateString = "Damaged Working";
                            $statePrice = $productInformation[$inf]->damaged_working-$productNetwork[3]->knockoff_price;
                            break;
                        case 4:
                            $stateString = "Faulty";
                            $statePrice = $productInformation[$inf]->faulty-$productNetwork[4]->knockoff_price;
                            break;
                        default:
                            $stateString = "Excellent Working";
                            $statePrice = $productInformation[$inf]->excellent_working-$productNetwork[5]->knockoff_price;
                            break;
                    }

                    $tradein = new Tradein();
                    $tradein->user_id = 2;
                    $tradein->barcode = $tradeinbarcode;
                    $tradein->barcode_original = $tradeinbarcode;
                    $tradein->product_id = $sellingProduct->id;
                    $tradein->order_price = $statePrice;
                    $tradein->job_state = 1;
                    $tradein->customer_grade = $stateString;
                    $tradein->customer_network = $productNetwork[$net]->getNetWorkName($productNetwork[$net]->network_id);
                    #dd($productInformation[$inf]);
                    $tradein->customer_memory=$productInformation[$inf]->memory;
                    $tradein->expiry_date = \Carbon\Carbon::parse("31-03-2021 00:00");

                    $tradein->save();
                }

            }

        }


        return redirect()->back();
    }
    
    public function getKlaviyoLogs(){
        $portalUser = PortalUsers::where('user_id', Auth::user()->id)->first();

        $file_path = storage_path('logs/klaviyo_logs.log');
        $data = [];

        if(File::exists($file_path)){
            $data = File::get($file_path);
        }

        return view('portal.logs.klaviyologs',['data' => $data, 'portalUser' => $portalUser]);
    }
}

