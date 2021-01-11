<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Eloquent\Websites;
use App\Eloquent\Stores;
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

    //customer care

    public function showCustomerCare(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.customer-care')->with('portalUser', $portalUser);
    }

    public function showTradeIn(Request $request){
        if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeins = null;
        $search = null;

        if($request->all() == null || $request->search == 0){
            $tradeins = Tradein::all()->where('job_state', 1)->groupBy('barcode');

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 1)->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.customer-care.trade-in')->with('tradeins', $tradeins)->with('portalUser', $portalUser)->with('search',$search);
    }

    public function showTradeInDetails($id){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradein = Tradein::where('barcode', $id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user = User::where('id', $tradein[0]->user_id)->first();

        

        $testingfaults = TestingFaults::where('tradein_id', $tradein[0]->id)->first();

        return view('portal.customer-care.trade-in-details')
            ->with([    'tradeins'=>$tradein,
                        'portalUser'=>$portalUser,
                        'user'=>$user,
                        'barcode'=>$id,
                        'testingfaults'=>$testingfaults 
                ]);
    }

    public function showMoreTradeInDetails($id){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user = User::where('id', $tradein->user_id)->first();
        return view('portal.customer-care.trade-in-product-details')->with('tradein', $tradein)->with('portalUser', $portalUser)->with('user', $user);
    }

    public function PrintTradeInLabelBulk(Request $request){

        $html = "";
        $barcodes = array();

        foreach($request->all() as $item){
            array_push($barcodes, $item);
        }

        $barcodes = array_slice($barcodes, 1);

        $tradeins = array();

        foreach($barcodes as $barcode){
            $tradein = Tradein::where('barcode', $barcode)->first();
            array_push($tradeins, $tradein);
        }

        foreach($barcodes as $barcode){
            $tiarr = Tradein::where('barcode', $barcode)->get();
            foreach($tiarr as $tradein){
                $tradein->job_state = 2;
                $tradein->save();
            }
        }

        foreach($tradeins as $tradein){

            $user = User::where('id',$tradein->user_id)->first();
            $product = SellingProduct::where('id', $tradein->product_id);
            $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

            $ti = Tradein::where('id', $tradein->id)->first();
            $ti->job_state = 2;
            $ti->save();

        }

        #echo $html;
        #die();

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        $this->downloadBulk($filename);
    }

    public function PrintTradeInLabel(Request $request){

        $tradeins = Tradein::where('barcode', $request->hidden_print_trade_pack_trade_in_id)->get();
        $user = User::where('id',$tradeins[0]->user_id)->first();
        $productIds = array();

        foreach($tradeins as $tradein){
            
            if($tradein->job_state < 2){
                $tradein->job_state = 2;
                $tradein->save();
            }

            array_push($productIds, $tradein->product_id);
        }

        $products = SellingProduct::whereIn('id', $productIds)->get();
        $tradein = Tradein::where('barcode',$request->hidden_print_trade_pack_trade_in_id)->first();

        $barcode = DNS1D::getBarcodeHTML($request->hidden_print_trade_pack_trade_in_id, 'C128');
        $delAdress = strtr($user->delivery_address, array(', '=>'<br>'));

        $pdf = PDF::loadView('portal.labels.tradeinlabel', array('user'=>$user, 'deladdress'=>$delAdress, 'tradein'=>$tradein, 'barcode'=>$barcode))->save('pdf/tradeinlabel-'. $request->hidden_print_trade_pack_trade_in_id .'.pdf');

        return redirect()->back()->with('success', 'pdf/tradeinlabel-'. $request->hidden_print_trade_pack_trade_in_id .'.pdf');
    
    }



    public function deleteTradeInFromSystem(Request $request){
        $tradein = Tradein::where('barcode', $request->delete_trade_in_id)->get();
        foreach($tradein as $ti){
            $ti->delete();
        }

        return redirect()->back();
    }

    public function deleteTradeIn($id){
        $tradein = Tradein::where('barcode', $id)->get();

        $barcode = $id;

        foreach($tradein as $ti){
            $ti->delete();
        }

        return redirect()->back()->with('success', 'You have succesfully deleted '. $barcode . ' from system.');
    }

    public function returnToTesting($id){
        $tradein = Tradein::where('id', $id)->first();

        if($tradein->proccessed_before){
            return redirect()->back()->with('error', 'This device was already tested second time.');
        }

        $tradein->job_state = 6;
        $tradein->save();

        return redirect()->back()->with('success', 'You have succesfully returned '. $tradein->barcode . ' to testing.');

    }

    public function showTradeOut(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradeouts = Tradeout::all();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-out')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser);
    }

    public function showTradeOutDetails($id){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradeout = Tradeout::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-out-details')->with('tradeout', $tradeout)->with('portalUser', $portalUser);
    }

    public function showDestroyDevice(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.destroy')->with('portalUser', $portalUser);
    }

    private function getOrderNumbersSorted($array){
        foreach($array as $key=>$item){
            $k = 0;

            foreach($item as $order){
                if($order->barcode !== $key){
                    $k++;
                }
            }

            if($k === count($item)){
                $array->forget($key);
            }

        }

        return $array;
    }

    public function showTradePack(Request $request){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $search = null;

        if($request->all() == null || $request->search == 0){
            #$tradeins = Tradein::all()->whereIn('job_state', [2,3])->groupBy('barcode_original');

            $tradeins = Tradein::where('job_state', 2)->get()->groupBy('barcode_original');
            #dd($tradeins);
            #$tradeins = $this->getOrderNumbersSorted($tradeins);

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 2)->get();
                #$tradeins = $this->getOrderNumbersSorted($tradeins->all());

                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();

                foreach($tradeins as $key=>$tradein){
                    if($tradein->getCategoryId($tradein->product_id) !== intval($request->search)){
                        $tradeins->forget($key);
                    }  
                }
                #dd($tradeins);

                $tradeins = $tradeins->groupBy('barcode_original');
            }
            else{

                $tradeins = Tradein::where('barcode', $request->search)->orWhere('barcode_original', $request->search)->where('job_state', 2)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode_original');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }

        return view('portal.customer-care.trade-pack')->with('portalUser', $portalUser)->with('tradeins', $tradeins)->with('title', 'Awaiting receipt')->with('search', $search);
    }

    public function setTradePackAsSent(Request $request){
        $tradein = Tradein::where('id', $request->set_trade_in_as_sent)->first();
        $tradein->job_state = 2;
        $tradein->save();
        return redirect()->back();
    }

    public function showSeller(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $users = User::where('type_of_user', 0)->get();

        return view('portal.customer-care.seller')->with(['portalUser'=>$portalUser, 'users'=>$users]);
    }

    public function showSellerDetails($id){

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $user = User::where('id', $id)->first();

        return view('portal.customer-care.sellerdetails')->with(['portalUser'=>$portalUser, 'user'=>$user]);
    }

    public function disableSellerAccount($id){
        $user = User::where('id', $id)->first();
        $user->account_disabled = true;
        $user->save();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully disabled.');
    }

    public function enableSellerAccount($id){
        $user = User::where('id', $id)->first();
        $user->account_disabled = false;
        $user->save();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully enabled.');
    }

    public function deleteUserAccount($id){
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->back()->with('success', 'Account id '. $user->id . ' has been succesfully deleted.');
    }

    public function createOrder(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.createorder')->with(['portalUser'=>$portalUser]);
    }

    public function markForReprint($id){
        $tradein = Tradein::where('id', $id)->first();
        $tradein->job_state = null;
        $tradein->save();

        return redirect()->back()->with('success', 'Tradein with id '. $tradein->id . ' has been sent to reprint.');
    }

    public function showOrderManagment(Request $request){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::all()->groupBy('barcode');

        if($request->all() == null || $request->search == 0){
            $tradeins = Tradein::all()->groupBy('barcode');

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::all();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    if($tradein->getCategoryId($tradein->product_id) != $request->search){
                        $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }

        return view('portal.customer-care.order-management')->with('portalUser', $portalUser)->with('tradeins', $tradeins)->with('title', 'Order Management')->with('search', $request->search);
    }

    public function sendDeviceBackToReceive($barcode){
        $tradein = Tradein::where('barcode', $barcode)->first();

        $tradein->job_state = 2;
        $tradein->received = 0;
        $tradein->device_missing = null;
        $tradein->device_correct = null;
        $tradein->chekmend_passed = null;
        $tradein->imei_number = null;
        $tradein->marked_as_risk = null;
        $tradein->marked_for_quarantine = null;
        $tradein->visible_imei = null;
        $tradein->bamboo_grade = null;
        $tradein->save();

        $trayContent = TrayContent::where('trade_in_id', $tradein->id)->first();
        $trayContent->delete();

        return redirect()->back();

    }

    public function sendDeviceBackToTest($barcode){
        $tradein = Tradein::where('barcode', $barcode)->first();

        $tradein->job_state = 4;
        $tradein->save();

        return redirect()->back();
    }

    public function cancelOrder($id){
        $tradein = Tradein::where('id', $id)->first();
        $tradein->delete();

        return redirect()->back();
    }

    //e-commerence

    public function showEcommerenceOrderManagement(Request $request){
        if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeouts = null;
        $search = null;

        if($request->all() == null || $request->search == 0){
            $tradeouts = Tradeout::all();

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 1)->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.ecommerence.order-management')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser)->with('search',$search);
    }

    public function setTradeoutAsSent(Request $request){
        $tradeout = Tradeout::where('id', $request->mark_as_complete_trade_out_id)->first();
        $tradeout->order_state = 1;
        $tradeout->save();

        return \redirect()->back()->with('success', 'Order '. $request->mark_as_complete_trade_out_id . ' was successfully sent.');
    }

    public function showEcommerenceCustomerAccounts(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $users = User::where('type_of_user', 0)->get();

        return view('portal.customer-care.seller')->with(['portalUser'=>$portalUser, 'users'=>$users]);
    }

    public function showEcommerenceOrderStatus(Request $request){
        if(!$this->checkAuthLevel(1)){return redirect('/');}

        $tradeouts = null;
        $search = null;

        if($request->all() == null || $request->search == 0){
            $tradeouts = Tradeout::all();

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            $search = null;
        }
        else{
            if($request->search <= 3){
                $tradeins = Tradein::where('job_state', 1)->get();
                $user_id = Auth::user()->id;
                $portalUser = PortalUsers::where('user_id', $user_id)->first();
    
                $search = $request->search;
    
                foreach($tradeins as $tradein){
                    print_r($tradein->getCategoryId($tradein->product_id) != $request->search);
                        if($tradein->getCategoryId($tradein->product_id) != $request->search){
                            $tradeins = $tradeins->except($tradein->id);
                    }
                }
    
                $tradeins = $tradeins->groupBy('barcode');
            }
            else{
                $tradeins = Tradein::where('barcode', $request->search)->get();
                if(count($tradeins) < 1){
                    return redirect()->back()->with('error', 'No Order with that barcode. Please try again.');
                }
                else{
                    $tradeins = $tradeins->groupBy('barcode');
                    $user_id = Auth::user()->id;
                    $portalUser = PortalUsers::where('user_id', $user_id)->first();
                }
            }

        }
        
        return view('portal.ecommerence.order-status')->with('tradeouts', $tradeouts)->with('portalUser', $portalUser)->with('search',$search);
    }

    public function showEcommerenceCreateOrder(){

    }

    //categories
    public function showCategories(){

        if(!$this->checkAuthLevel(2)){return redirect('/');}

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.categories.categories')->with('categories', $categories)->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts, 'portalUser'=>$portalUser]);
    }

    public function showAddCategoryView(){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.add.category')->with('portalUser', $portalUser);
    }

    public function ShowEditCategoryView($id){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        $category = Category::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        #dd($category);
        return view('portal.categories.editcategory')->with(['portalUser'=>$portalUser, 'category'=>$category]);
    }

    public function editCategory(Request $request){

        $category = Category::where('id', $request->category_id)->first();

        $category->category_name=$request->category_name;
        $category->category_description = $request->wordbox_description;

        $fileNameToStore = "default_image";

        if($request->category_image){
            $filenameWithExt = $request->file('category_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('category_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('category_image')->storeAs('public/category_images',$fileNameToStore);
        }
        $category->category_image = $fileNameToStore;
        $category->save();

        return \redirect()->back()->with('success', 'You have succesfully edited category.');

    }

    public function deleteCategory($id){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        Category::where('id', $id)->delete();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return \redirect('/portal/categories')->with('portalUser', $portalUser);
    }

    public function showAddBrandsView($id = null){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($id !== null){
            $brand = Brand::where('id', $id)->first();
            return view('portal.add.brand')->with(['portalUser'=>$portalUser, 'brand'=>$brand]);
        }

        return view('portal.add.brand')->with('portalUser', $portalUser);
    }

    public function editBrand(Request $request){

        $brand = Brand::where('id', $request->brand_id)->first();

        $brand->brand_name = $request->brand_name;

        $fileNameToStore = "default_brand_image.jpg";

        if($request->brand_image){
            $filenameWithExt = $request->file('brand_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('brand_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('brand_image')->storeAs('public/brand_image',$fileNameToStore);
        }

        $brand->brand_image = $fileNameToStore;
        $brand->save();

        return redirect()->back()->with('Success', 'You have succesfully edited manifacturer.');

    }

    public function ShowEditBrandsView($id){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        Brand::where('id', $id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.categories.editbrand')->with('portalUser', $portalUser);
    }

    public function deleteBrands($id){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        Brand::where('id', $id)->delete();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return \redirect('/portal/settings/brands')->with('portalUser', $portalUser);
    }

    public function addCategory(Request $request){

        $fileNameToStore = "default_category_image.jpg";

        if($request->category_image){
            $filenameWithExt = $request->file('category_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('category_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('category_image')->storeAs('public/category_images',$fileNameToStore);
        }
        

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->wordbox_description;
        $category->category_image = $fileNameToStore;
        $category->save();

        return \redirect('/portal/categories');

    }

    public function addBrand(Request $request){

        $filenameWithExt = $request->file('brand_image')->getClientOriginalName();
        
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('brand_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('brand_image')->storeAs('public/brand_images',$fileNameToStore);
        
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $fileNameToStore;
        $brand->save();

        return \redirect('/portal/settings/brands');
    }

    //products

    public function showProductsPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.product')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);

    }

    public function showSellingProductsPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $sellingProducts = SellingProduct::all();
        #$sellingProductInformation = ProductInformation::all();
        #dd($sellingProductInformation);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.sellingproduct')->with(['sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);
    }

    public function showBuyingProductsPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.buyingproduct')->with(['buyingProducts'=>$buyingProducts,'portalUser'=>$portalUser]);
    }

    public function showAddBuyingProductPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();
        $networks = Network::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.buyingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser, 'networks'=>$networks]);
    }

    public function showAddSellingProductPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();
        $networks = Network::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        
        return view('portal.add.sellingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser, 'networks'=>$networks]);
    }

    public function addBuyingProduct(Request $request){

        #dd($request);

        $product = new BuyingProduct();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
        $product->product_image = $fileNameToStore;

        $product->product_dimensions = $request->product_dimensions;
        $product->product_processor = $request->product_processor;
        $product->product_weight = $request->product_weight;
        $product->product_screen = $request->product_screen;
        $product->product_system = $request->product_system;
        $product->product_connectivity = $request->product_connectivity;
        $product->product_battery = $request->product_battery;
        $product->product_signal = $request->product_signal;
        $product->product_camera = $request->product_main_camera;
        $product->product_camera_2 = $request->product_secondary_camera;
        $product->product_sim = $request->product_sim;
        $product->product_memory_slots = $request->product_memory_slots;

        $product->save();


        for($i=1; $i<=3; $i++){
            if(isset($request->{"memory-" . $i . "-new"}) && $request->{"memory-" . $i . "-new"} !== null){
                $sellingProductInformation = new BuyingProductInformation();
                $sellingProductInformation->product_id = $product->id;
                $sellingProductInformation->memory = $request->{"memory-" . $i . "-new"};
                $sellingProductInformation->excellent_working = $request->{"price" . $i . "-1-new"};
                $sellingProductInformation->good_working = $request->{"price" . $i . "-2-new"};
                $sellingProductInformation->poor_working = $request->{"price" . $i . "-3-new"};
                $sellingProductInformation->save();
            }
        }

        for($i=1; $i<=5; $i++){
            $productNetworks = new BuyingProductNetworks();
            $productNetworks->network_id = $i;
            $productNetworks->product_id = $product->id;
            $productNetworks->knockoff_price = $request->{"network_" . $i};
            $productNetworks->save();
        }
        
        $category = Category::where('id', $request->category)->first();
        $category->total_produts = $category->total_produts+1;
        $category->save();

        $brand = Brand::where('id', $request->brand)->first();
        $brand->total_produts = $brand->total_produts + 1;
        $brand->save();

        return \redirect('/portal/product/buying-products');
    }

    public function addSellingProduct(Request $request){

        #dd($request);

        $product = new SellingProduct();

        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;

        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        for($i=1; $i<=5; $i++){
            if(isset($request->{"memory-" . $i . "-new"}) && $request->{"memory-" . $i . "-new"} !== null){
                $sellingProductInformation = new ProductInformation();
                $sellingProductInformation->product_id = $product->id;
                $sellingProductInformation->memory = $request->{"memory-" . $i . "-new"};
                $sellingProductInformation->excellent_working = $request->{"price" . $i . "-1-new"};
                $sellingProductInformation->good_working = $request->{"price" . $i . "-2-new"};
                $sellingProductInformation->poor_working = $request->{"price" . $i . "-3-new"};
                $sellingProductInformation->damaged_working = $request->{"price" . $i . "-4-new"};
                $sellingProductInformation->faulty = $request->{"price" . $i . "-5-new"};
                $sellingProductInformation->save();
            }
        }

        for($i=1; $i<=5; $i++){
            $productNetworks = new ProductNetworks();
            $productNetworks->network_id = $i;
            $productNetworks->product_id = $product->id;
            $productNetworks->knockoff_price = $request->{"network_" . $i};
            $productNetworks->save();
        }

        for($i=1; $i<=5; $i++){
            if(isset($request->{"color_" . $i}) && $request->{"color_" . $i} !== null){
                $productColours = new Colour();
                $productColours->product_id = $product->id;
                $productColours->color_value = $request->{"color_" . $i};
                $productColours->save();
            }
        }
        

        return \redirect('/portal/product/selling-products')->with('success', 'You have succesfully added product.');
    }

    public function removeBuyingProduct($id){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        BuyingProduct::where('id', $id)->delete();

        return \redirect('/portal/product/buying-products');
    }

    public function removeSellingProduct($id){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        SellingProduct::where('id', $id)->delete();

        return \redirect('/portal/product/selling-products');
    }

    public function showEditBuyingProductPage($id){
        if(!$this->checkAuthLevel(3)){return redirect('/');}

        $product = BuyingProduct::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $categories = Category::all();
        $brands = Brand::all();
        $networks = BuyingProductNetworks::where('product_id', $id)->get();
        $productInformation = BuyingProductInformation::where('product_id', $id)->get();

        return view('portal.product.editbuyingproduct')->with(['product'=>$product, 'portalUser'=>$portalUser, 'categories'=>$categories, 'brands'=>$brands, 'networks'=>$networks, 'productInformation'=>$productInformation]);
    }

    public function showEditSellingProductPage($id){
        if(!$this->checkAuthLevel(3)){return redirect('/');}

        $product = SellingProduct::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        $sellingProductInformation = ProductInformation::where('product_id', $id)->get();
        $productNetworks = ProductNetworks::where('product_id', $id)->get();
        $colors = Colour::where('product_id', $id)->get();
        #dd($productNetworks);

        return view('portal.product.editsellingproduct')->with(['product'=>$product, 'portalUser'=>$portalUser, 'categories'=>$categories, 'brands'=>$brands, 'productinformation'=>$sellingProductInformation, 'productnetworks'=>$productNetworks, 'colors'=>$colors]);
    }

    public function showSellingProductOption($id){
        $sellingProductInformation = ProductInformation::where('id', $id)->first();
        $sellingProductInformation->delete();
        return redirect()->back()->with('product_option_deleted', 'Product option deleted succesfully');
    }

    public function saveEditedSellingProduct(Request $request){
        #dd($request->all());

        $product = SellingProduct::where('id', $request->product_id)->first();
        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        if($request->has('product_image')){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            $product->product_image = $fileNameToStore;
        }
        $product->save();

        $deviceInfo = array();

        $productInfo = ProductInformation::where('product_id', $request->product_id)->get();
        $networks = ProductNetworks::where('product_id', $request->product_id)->get();

        foreach($productInfo as $info){
            if($request->{"memory_".$info->id} == null || $request->{"price1_".$info->id} == null || $request->{"price2_".$info->id} == null || $request->{"price3_".$info->id} == null || $request->{"price4_".$info->id} == null || $request->{"price5_".$info->id} == null){
                $info->delete();
            }
            else{
                if($request->{"memory_".$info->id} != $info->memory){
                    $info->memory = $request->{"memory_".$info->id};
                    $info->save();
                }
                if($request->{"price1_".$info->id} != $info->excellent_working){
                    $info->excellent_working = $request->{"price1_".$info->id};
                    $info->save();
                }
                if($request->{"price2_".$info->id} != $info->good_working){
                    $info->good_working = $request->{"price2_".$info->id};
                    $info->save();
                }
                if($request->{"price3_".$info->id} != $info->poor_working){
                    $info->poor_working = $request->{"price3_".$info->id};
                    $info->save();
                }
                if($request->{"price4_".$info->id} != $info->damaged_working){
                    $info->damaged_working = $request->{"price4_".$info->id};
                    $info->save();
                }
                if($request->{"price5_".$info->id} != $info->faulty){
                    $info->faulty = $request->{"price5_".$info->id};
                    $info->save();
                }
            }
        }

        $network = $networks[0];

        foreach($networks as $network){
            
            if($request->{"network_".$network->id} != $network->knockoff_price){
                $network->knockoff_price = $request->{"network_".$network->id};
                $network->save();
            }
        }

        return redirect()->back()->with('product_edited', 'Product Was succesfully edited.');
    }

    public function saveEditedBuyingProduct(Request $request){

        #dd($request);

        $product = BuyingProduct::where('id', $request->product_id)->first();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;

        if(($request->file('product_image')) !== null){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            $product->product_image = $fileNameToStore;
        }


        $product->product_dimensions = $request->product_dimensions;
        $product->product_processor = $request->product_processor;
        $product->product_weight = $request->product_weight;
        $product->product_screen = $request->product_screen;
        $product->product_system = $request->product_system;
        $product->product_connectivity = $request->product_connectivity;
        $product->product_battery = $request->product_battery;
        $product->product_signal = $request->product_signal;
        $product->product_camera = $request->product_main_camera;
        $product->product_camera_2 = $request->product_secondary_camera;
        $product->product_sim = $request->product_sim;
        $product->product_memory_slots = $request->product_memory_slots;

        $product->save();


        $sellingProductInformation = BuyingProductInformation::where('product_id', $request->product_id)->get();
        foreach($sellingProductInformation as $spi){
            if(isset($request->{"memory-" . $spi->id . "-new"}) && $request->{"memory-" . $spi->id . "-new"} !== null){
                $spi->product_id = $product->id;
                $spi->memory = $request->{"memory-" . $spi->id . "-new"};
                $spi->excellent_working = $request->{"price" . $spi->id . "-1-new"};
                $spi->good_working = $request->{"price" . $spi->id . "-2-new"};
                $spi->poor_working = $request->{"price" . $spi->id . "-3-new"};
                $spi->save();
            }

        }

        $networks = BuyingProductNetworks::where('product_id', $request->product_id)->get();
        foreach($networks as $network){
            
            if($request->{"network_".$network->id} != $network->knockoff_price){
                $network->knockoff_price = $request->{"network_".$network->id};
                $network->save();
            }
        }

        return redirect()->back()->with('product_edited', 'Product Was succesfully edited.');

    }

    //quarantine

    public function showQuarantinePage(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.quarantine')->with('portalUser', $portalUser);
    }

    public function showAwaitingResponse(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeinsQ = Tradein::where('marked_for_quarantine', true)->where('quarantine_status', null)->get();
        

        return view('portal.quarantine.awaiting')->with(['portalUser'=>$portalUser, 'tradeins'=>$tradeinsQ]);
    }

    public function showQuarantineReturn(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeinsQ = Tradein::where('marked_for_quarantine', true)->where('quarantine_status', 1)->get();

        return view('portal.quarantine.return')->with(['portalUser'=>$portalUser, 'tradeins'=>$tradeinsQ]);
    }

    public function showQuarantineRetest(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.retest')->with('portalUser', $portalUser);
    }

    public function showQuarantineStock(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.stock')->with('portalUser', $portalUser);
    }

    public function showQuarantineManual(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.manually')->with('portalUser', $portalUser);
    }

    public function markDeviceToReturn(Request $request){
        dd($request);
    }   

    public function markDeviceToRetest(Request $request){
        dd($request);
    }

    //testing

    public function showTestingPage(){
        if(!$this->checkAuthLevel(5)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.testing')->with('portalUser', $portalUser);
    }

    public function showReceiveTradeIn(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receive')->with('portalUser', $portalUser);
    }

    public function showFindTradeIn(){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.find')->with('portalUser', $portalUser);
    }

    public function find(Request $request){

        #dd($request);
        if(!$this->checkAuthLevel(5)){return redirect('/');}


        $barcode = $request->scanid;

        $tradein = Tradein::where('barcode', $request->scanid)->first();

        if($tradein == null){
            return redirect()->back()->with('error', 'There is no such device');
        }
        if($tradein->job_state < 3){
            return redirect()->back()->with('error', 'Device has not been received yet, or has been sent to quarantine.');
        }
        elseif($tradein->job_state == 5){
            return redirect()->back()->with('error', 'Device was already tested.');
        }
        elseif($tradein->job_state != 6 && $tradein->marked_for_quarantine){
            return redirect()->back()->with('error', 'Device was marked for quarantine on receiving and cannot be tested. If this device is in your tray, please remove it.');
        }
        else{
            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();
            $networks = Network::all();
            $productinformation = ProductInformation::where('product_id', $tradein->product_id)->get();
            $productColors = Colour::where('product_id', $tradein->product_id)->get();
            $sellingProduct = SellingProduct::all();

            return view('portal.testing.testdevice')->with(['tradein'=>$tradein, 'portalUser'=>$portalUser, 'networks'=>$networks, 'productinformation'=>$productinformation, 'productColors'=>$productColors, 'products'=>$sellingProduct]);
        }    


    }

    public function receive(Request $request){
        if(!$this->checkAuthLevel(5)){return redirect('/');}

        #dd($request->scanid);
        $tradeins = Tradein::where('barcode', $request->scanid)->where('job_state', 2)->get();

        if(count($tradeins)<1){
            return redirect()->back()->with('error', 'Trade pack despach has not been sent, or device was already received.');
        }

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
       
        return view('portal.testing.order')->with('tradeins', $tradeins)->with('portalUser', $portalUser);
    }

    public function testItem($id){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.present')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);

    }

    public function isDeviceMissing(Request $request){

        #dd($request);

        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $tradein->created_at);
        $now = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        $user = User::where('id', $tradein->user_id)->first();

        $diff_in_days = $now->diffInDays($from);

        $message = array();

        if($diff_in_days>=14){
            $tradein->marked_for_quarantine = true;
            $tradein->job_state = 9;
            $tradein->save();
            array_push($message, "This order has been identified by system as older than 14 days and has been marked for quarantine. Please confirm this.");
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device Older',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price,
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
        
        }

        if($request->missing == "present"){
            $tradein->device_missing = false;
            $tradein->received = true;
        }
        else if($request->missing == "missing"){
            $tradein->device_missing = true;
            $tradein->received = true;
            $tradein->marked_for_quarantine = true;
            $tradein->received = true;

            $filenameWithExt = $request->file('missing_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('missing_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('missing_image')->storeAs('public/missing_images',$fileNameToStore);

            $tradein->missing_image = $path;

            $tradein->job_state = 4;
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device Missing',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
            array_push($message, "This device has been found as missing from received order, and has been marked for quarantine. Please confirm this.");
        }

        $tradein->save();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }


        // if($tradein->marked_for_quarantine){
        //     return redirect('/portal/testing/receive/quarantine/' . $tradein->id)->with(['message'=>$message, 'mti'=>$mti]);
        // }
        // else{
            return redirect('/portal/testing/checkforimei/' . $tradein->id);
        //}

        
    }

    public function showCheckForImeiPage($id){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkimei')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function sendReceivingDeviceToQuarantine(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $quarantineTrays = "";
        $quarantineName = "";


        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RQ01%')->where('number_of_devices', "<" ,200)->first();
            $quarantineName = $quarantineTrays->tray_name;

            $user  = User::where('id', $tradein->user_id)->first();
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device sent to quarantine',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );
        }
        else{
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RM01%')->where('number_of_devices', "<" ,200)->first();
            $quarantineName = $quarantineTrays->tray_name;
            if($tradein->getBrandId($tradein->product_id) == 1){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RA01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;

            }
            if($tradein->getBrandId($tradein->product_id) == 2){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RS01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            if($tradein->getBrandId($tradein->product_id) == 3){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RH01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
        }

        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        $newBarcode = "90";
        $newBarcode .= mt_rand(10000, 99999);
        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }
        
        $tradein->save();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();

        $response = $this->generateNewLabel($barcode, $sellingProduct, $tradein);

        return view('portal.testing.totray')->with(['response'=>$response, 'barcode'=>$tradein->barcode, 'tray_name'=>$quarantineName, 'portalUser'=>$portalUser, 'tradein'=>$tradein, 'mti'=>$mti]);
    }

    public function showOlderOrderPage($id){
        $tradein = Tradein::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        return view('portal.testing.receiving.olderorder')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function deviceImeiVisibility(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->visible_imei == "yes"){
            $tradein->visible_imei = true;
        }
        else{
            $tradein->visible_imei = false;
            $tradein->marked_for_quarantine = true;
        }

        $tradein->save();
        if($tradein->marked_for_quarantine && $tradein->chekmend_passed){
            return redirect('/portal/testing/result/' . $tradein->id);
        }

        return redirect('/portal/testing/checkimei/' . $tradein->id);
    }

    public function showCheckImeiPage($id){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.receiving.checkmend')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function checkimei(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $imei_number = $request->imei_number;

        #dd($imei_number);

        if(strlen($imei_number)>15 || strlen($imei_number)<15){
            return redirect()->back()->with('error', 'Incorrect IMEI number. Must be 15 characters');
        }

        $url = 'https://clientapiv2.phonecheck.com/cloud/cloudDB/CheckEsn/';


        $ApiKey = "f06581b6-f4b3-4d40-a65e-6a39acf045fb";
        $username = "bamboo11";
        $devicetype = "Android";
        $carrier = "AT&T";
        
        $post = [
            'ApiKey' => $ApiKey,
            'Username' => $username,
            'IMEI' => $imei_number,
            'Devicetype' => $devicetype,
            'carrier' => $carrier,
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);

        $result = (json_decode($response));
        if($result->RawResponse->blackliststatus == "Yes"){
            $tradein->marked_for_quarantine = true;
            $tradein->chekmend_passed = false;
            $tradein->save();
        }


        $imeiResult = ImeiResult::where('tradein_id', $request->tradein_id)->first();

        if($imeiResult == null){
            $imeiResult = new ImeiResult();
        }

        $imeiResult->tradein_id = $request->tradein_id;
        $imeiResult->API =  $result->API;
        $imeiResult->remarks =  $result->Remarks;
        $imeiResult->model_name =  $result->RawResponse->modelname;
        $imeiResult->blackliststatus =  $result->RawResponse->blackliststatus;
        $imeiResult->greyliststatus =  $result->RawResponse->greyliststatus;

        $imeiResult->save();

        $tradein->imei_number = $imei_number;
        $tradein->save();

        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        #$this->showCheckImeiReultPage($tradein->barcode, $result);

        return redirect('/portal/testing/result/' . $tradein->id);

    }

    public function userCheckImei(Request $request){
        #dd($request);

        if($request->correct == "yes"){
            $tradein = Tradein::where('id', $request->tradein_id)->first();

            $tradein->marked_as_risk = false;
            $tradein->marked_for_quarantine = false;
            $tradein->chekmend_passed = true;
            $tradein->device_correct = true;
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
        else{
            $tradein = Tradein::where('id', $request->tradein_id)->first();
            $user  = User::where('id', $tradein->user_id)->first();
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Device failed IMEI check',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$name' => $user->first_name,
                        '$last_name' => $user->last_name,
                        '$birthdate' => $user->birthdate,
                        '$newsletter' => $user->email,
                        '$products' => $tradein->getProductName($tradein->product_id),
                        '$price'=> $tradein->order_price
                    ),
                    'properties' => array(
                        'Item Sold' => True
                    )
                )
            );

            $tradein->marked_as_risk = false;
            $tradein->marked_for_quarantine = true;
            $tradein->chekmend_passed = false;
            $tradein->device_correct = false;
            $tradein->save();
            return redirect('/portal/testing/result/' . $tradein->id);
        }
    }

    public function showReceivingResultPage($id){
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        #return view('portal.testing.receiving.checkmendresult')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);

        return view('portal.testing.receiving.resault')->with(['portalUser'=>$portalUser, 'tradein'=>$tradein, 'product'=>$product, 'user'=>$user]);
    }

    public function checkDeviceStatus(Request $request){

        #dd($request->all());

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();

        if($request->fimp_or_google_lock === "true" || $request->pin_locked === "true"){
            $tradein->marked_for_quarantine = true;

            if($request->fimp_or_google_lock === "true"){
                $tradein->fimp = true;
            }
            if($request->pin_lock === "true"){
                $tradein->pinlocked = true;
            }

            $tradein->save();
        }

        if($request->device_correct === "false"){
            $tradein->marked_for_quarantine = true;
            $tradein->device_correct = $request->select_correct_device;
            $tradein->save();
        }
        else{
            $tradein->marked_for_quarantine = false;
            $tradein->device_correct = null;
            $tradein->save();
        }

        if($tradein->job_state === 6){
            $tradein->proccessed_before = true;
            $tradein->save();
        }

        if($request->device_fully_functional === "false"){
            $tradein->marked_for_quarantine = true;

            $testingfaults = new TestingFaults();
            $testingfaults->tradein_id = $tradein->id;

            if($request->audio_tests === "true"){
                $testingfaults->audio_test = true;
            }
            if($request->front_microphone === "true"){
                $testingfaults->front_microphone = true;
            }
            if($request->headset_test === "true"){
                $testingfaults->headset_test = true;
            }
            if($request->loud_speaker_test === "true"){
                $testingfaults->loud_speaker_test = true;
            }
            if($request->microphone_playback_test === "true"){
                $testingfaults->microphone_playback_test = true;
            }
            if($request->buttons_test === "true"){
                $testingfaults->buttons_test = true;
            }
            if($request->sensor_test === "true"){
                $testingfaults->sensor_test = true;
            }
            if($request->camera_test === "true"){
                $testingfaults->camera_test = true;
            }
            if($request->glass_condition === "true"){
                $testingfaults->glass_condition = true;
            }
            if($request->vibration === "true"){
                $testingfaults->vibration = true;
            }
            if($request->original_colour === "true"){
                $testingfaults->original_colour = true;
            }
            if($request->battery_health === "true"){
                $testingfaults->battery_health = true;
            }
            if($request->nfc === "true"){
                $testingfaults->nfc = true;
            }
            if($request->no_power === "true"){
                $testingfaults->no_power = true;
            }
            if($request->fake_missing_parts === "true"){
                $testingfaults->fake_missing_parts = true;
            }

            $testingfaults->save();

        }

        $customergradeval = "";
        $bambogradeval = $request->bamboo_customer_grade;

        $old_customer_grade = $request->old_customer_grade;
        if($old_customer_grade == "Excellent Working"){
            $customergradeval = 5;
        }
        if($old_customer_grade == "Good Working"){
            $customergradeval = 4;
        }
        if($old_customer_grade == "Poor Working"){
            $customergradeval = 3;
        }
        if($old_customer_grade == "Damaged Working"){
            $customergradeval = 2;
        }
        if($old_customer_grade == "Faulty"){
            $customergradeval = 1;
        }

        if($bambogradeval < $customergradeval){
            $tradein->marked_for_quarantine = true;
        }


        if($request->correct_network == "false"){
            $correctNetworkName = $request->correct_network_value;
            $correctNetworkData = Network::where('network_name', $correctNetworkName)->first();

            $userNetworkName = $tradein->network;
            $userNetworkData = Network::where('network_name', $userNetworkName)->first();
            #dd($correctNetworkPrice = ProductNetworks::where('network_id', $correctNetworkData->id)->where('product_id', $tradein->product_id)->first());
            $correctNetworkPrice = ProductNetworks::where('network_id', $correctNetworkData->id)->where('product_id', $tradein->product_id)->first()->knockoff_price;
            $userNetworkPrice = ProductNetworks::where('network_id', $userNetworkData->id)->where('product_id', $tradein->product_id)->first()->knockoff_price;

            if($correctNetworkPrice > $userNetworkPrice){
                $tradein->marked_for_quarantine = true;
            }

            $tradein->correct_network = $correctNetworkName;
        }

        if($request->correct_memory == "false"){

            if($request->correct_memory_value>$tradein->memory){
                $tradein->correct_memory = $request->correct_memory_value;
            }
            else{
                $tradein->marked_for_quarantine = true;

                $tradein->correct_memory = $request->correct_memory_value;
            }

        }
        
        $tradein->job_state = 5;
        $tradein->bamboo_grade = $request->bamboo_final_grade;
        $tradein->save();

        $newBarcode = "";

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%TQ01%')->where('number_of_devices', "<" ,200)->first();
            $quarantineName = $quarantineTrays->tray_name;

            $tradein->job_state = 9;
            $tradein->save();
            $newBarcode .= "90";
            $newBarcode .= mt_rand(10000, 99999);
        }
        else{

            $newBarcode .= $tradein->job_state;
            $newBarcode .= mt_rand(10000, 99999);
            if($tradein->barcode == $tradein->barcode_original){
                $tradein->barcode = $newBarcode;
            }
            
            $tradein->save();

            $quarantineName ="";

            if($bambogradeval == 5){
                $quarantineTrays = Tray::where('tray_name', '%TM01-1-A%')->where('number_of_devices', "<" ,200)->first();
            }
            elseif($bambogradeval == 4){
                $quarantineTrays = Tray::where('tray_name', '%TM01-1-B%')->where('number_of_devices', "<" ,200)->first();
            }
            elseif($bambogradeval == 3){
                $quarantineTrays = Tray::where('tray_name', '%TM01-1-C%')->where('number_of_devices', "<" ,200)->first();
            }
            elseif($bambogradeval == 2){
                if($tradein->bamboo_grade == "WSI"){
                    $quarantineTrays = Tray::where('tray_name', '%TM01-1-WSI%')->where('number_of_devices', "<" ,200)->first();
                }
                if($tradein->bamboo_grade == "WSD"){
                    $quarantineTrays = Tray::where('tray_name', '%TM01-1-WSD%')->where('number_of_devices', "<" ,200)->first();
                }
            }
            elseif($bambogradeval == 1){
                $quarantineTrays = Tray::whereIn('tray_name', ['%TM01-1-NWSI%','%TM01-1-NWSD%','%TM01-1-CATASTROPHIC%'])->where('number_of_devices', "<" ,200)->first();
            }

            if($tradein->getBrandId($tradein->product_id) == 1){
                if($bambogradeval == 5){
                    $quarantineTrays = Tray::where('tray_name', 'TA01-1-A')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 4){
                    $quarantineTrays = Tray::where('tray_name', 'TA01-2-B+')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 3){
                    $quarantineTrays = Tray::where('tray_name', 'TA01-4-C')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 2){
                    if($tradein->bamboo_grade == "WSI"){
                        $quarantineTrays = Tray::where('tray_name', 'TA01-5-WSI')->where('number_of_devices', "<" ,200)->first();
                    }
                    if($tradein->bamboo_grade == "WSD"){
                        $quarantineTrays = Tray::where('tray_name', 'TA01-6-WSD')->where('number_of_devices', "<" ,200)->first();
                    }
                }
                elseif($bambogradeval == 1){
                    $quarantineTrays = Tray::whereIn('tray_name', ['TA02-1-NWSI','TA02-2-NWSD','TA02-3-CATASTROPHIC'])->where('number_of_devices', "<" ,200)->first();
                }
                $quarantineName = $quarantineTrays->tray_name;
            }

            if($tradein->getBrandId($tradein->product_id) == 2){
                if($bambogradeval == 5){
                    $quarantineTrays = Tray::where('tray_name', 'TS01-1-A')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 4){
                    $quarantineTrays = Tray::where('tray_name', 'TS01-2-B')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 3){
                    $quarantineTrays = Tray::where('tray_name', 'TS01-4-C')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 2){
                    if($tradein->bamboo_grade == "WSI"){
                        $quarantineTrays = Tray::where('tray_name', 'TS01-5-WSI')->where('number_of_devices', "<" ,200)->first();
                    }
                    if($tradein->bamboo_grade == "WSD"){
                        $quarantineTrays = Tray::where('tray_name', 'TS01-6-WSD')->where('number_of_devices', "<" ,200)->first();
                    }
                }
                elseif($bambogradeval == 1){
                    $quarantineTrays = Tray::whereIn('tray_name', ['TS02-1-NWSI','TS02-2-NWSD','TS02-3-CATASTROPHIC'])->where('number_of_devices', "<" ,200)->first();
                }
                
                $quarantineName = $quarantineTrays->tray_name;
            }

            if($tradein->getBrandId($tradein->product_id) == 3){
                if($bambogradeval == 5){
                    $quarantineTrays = Tray::where('tray_name', 'TH01-1-A')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 4){
                    $quarantineTrays = Tray::where('tray_name', 'TH01-2-B')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 3){
                    $quarantineTrays = Tray::where('tray_name', 'TH01-4-C')->where('number_of_devices', "<" ,200)->first();
                }
                elseif($bambogradeval == 2){
                    if($tradein->bamboo_grade == "WSI"){
                        $quarantineTrays = Tray::where('tray_name', 'TH01-5-WSI')->where('number_of_devices', "<" ,200)->first();
                    }
                    if($tradein->bamboo_grade == "WSD"){
                        $quarantineTrays = Tray::where('tray_name', 'TH01-6-WSD')->where('number_of_devices', "<" ,200)->first();
                    }
                }
                elseif($bambogradeval == 1){
                    $quarantineTrays = Tray::whereIn('tray_name', ['TH02-1-NWSI','TH02-2-NWSD','TH02-3-CATASTROPHIC'])->where('number_of_devices', "<" ,200)->first();
                }
                
                $quarantineName = $quarantineTrays->tray_name;
            }
        }

        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
        $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
        $oldTray->save();

        $oldTrayContent->delete();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        
        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $response = $this->generateNewLabel($barcode, SellingProduct::where('id', $tradein->id), $tradein);
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName, 'portalUser'=>$portalUser, 'testing'=>true, 'tradein'=>$tradein]);
        
    }

    public function printNewLabel(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }

        $tradein->job_state = 3;


        $newBarcode = "";

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();
        $brands = Brand::all();

        if($tradein->marked_for_quarantine == true){
            $newBarcode .= "90";
            $newBarcode .= mt_rand(10000, 99999);
        }
        else{
            foreach($brands as $brand){
                if($sellingProduct->brand_id == $brand->id){
                    if($brand->id < 10){
                        $newBarcode .= $tradein->job_state . "0" . $brand->id;
                        $newBarcode .= mt_rand(1000, 9999);
                    }
                    else{
                        $newBarcode .= $tradein->job_state . $brand->id;
                        mt_rand(1000, 9999);
                    }
                }
            }
        }

        if($tradein->barcode == $tradein->barcode_original){
            $tradein->barcode = $newBarcode;
        }
        
        $tradein->save();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $response = $this->generateNewLabel($barcode, $sellingProduct, $tradein);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($tradein->marked_for_quarantine == true){
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RQ01%')->where('number_of_devices', "<" ,200)->first();
            $quarantineName = $quarantineTrays->tray_name;
        }
        else{
            $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RM01%')->where('number_of_devices', "<" ,200)->first();
            $quarantineName = $quarantineTrays->tray_name;
            if($tradein->getBrandId($tradein->product_id) == 1){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RA01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;

            }
            if($tradein->getBrandId($tradein->product_id) == 2){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RS01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
            if($tradein->getBrandId($tradein->product_id) == 3){
                $quarantineTrays = Tray::where('tray_name', 'LIKE', '%RH01%')->where('number_of_devices', "<" ,200)->first();
                $quarantineName = $quarantineTrays->tray_name;
            }
        }

        
        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }


        $quarantineTrays->number_of_devices = $quarantineTrays->number_of_devices + 1;
        $quarantineTrays->save();

        $traycontent = new TrayContent();
        $traycontent->tray_id = $quarantineTrays->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        return view('portal.testing.totray')->with(['tray_name'=>$quarantineName,'response'=>$response,'barcode'=>$tradein->barcode, 'portalUser'=>$portalUser, 'tradein'=>$tradein,'testing'=>false, 'mti'=>$mti]);

    }


    public function sendtotray(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        
        $mti = false;

        if(count(Tradein::where('barcode', $tradein->barcode_original)->get())>1){
            $mti = true;
        }


        $tradein->job_state = 5;

        $user = User::where('id', $tradein->user_id)->first();

        $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
        $event = new KlaviyoEvent(
            array(
                'event' => 'Item received',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$name' => $user->first_name,
                    '$last_name' => $user->last_name,
                    '$birthdate' => $user->birthdate,
                    '$newsletter' => $user->email,
                    '$products' => $tradein->getProductName($tradein->id),
                    '$price'=> $tradein->order_price
                ),
                'properties' => array(
                    'Item Sold' => True
                )
            )
        );

        $client->publicAPI->track( $event );  

        $product = SellingProduct::where('id', $tradein->product_id)->first();
        $tray = null;

        if($tradein->marked_for_quarantine === true){
            $trays = Tray::where('trolley_id', 5)->get();
        }
        else{
            if($product->brand_id === 1){
                $trays = Tray::where('trolley_id', 1)->get();
            }
            elseif($product->brand_id === 2){
                $trays = Tray::where('trolley_id', 2)->get();
            }
            elseif($product->brand_id === 3){
                $trays = Tray::where('trolley_id', 3)->get();
            }
            else{
                $trays = Tray::where('trolley_id', 4)->get();
            }
        }

        foreach($trays as $tr){
            if($tr->number_of_devices < $tr->max_number_of_devices){
                $tray = $tr;
                break;
            }
        }

        $oldTrayContent = TrayContent::where('trade_in_id', $tradein->id)->first();

        if($oldTrayContent !== null){
            $oldTray = Tray::where('id', $oldTrayContent->tray_id)->first();
            $oldTray->number_of_devices = $oldTray->number_of_devices - 1;
            $oldTray->save();
            $oldTrayContent->delete();
        }

        $traycontent = new TrayContent();
        $traycontent->tray_id = $tray->id;
        $traycontent->trade_in_id = $tradein->id;
        $traycontent->save();

        $tray->number_of_devices = count(TrayContent::where('tray_id', $tray->id)->get());

        $tray->save();

        $tradein->save();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.totray')->with(['tray_name'=>$tray->tray_name, 'portalUser'=>$portalUser,'testing'=>true, 'mti'=>$mti]);
    }
    
    //payments

    public function showPaymentPage(){
        if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.payments')->with('portalUser', $portalUser);
    }

    public function showPaymentAwaitingPage(){
        if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.awaiting');
    }

    public function showPaymentPendingPage(){
        if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.pending')->with('portalUser', $portalUser);
    }

    public function showPaymentCompletedPage(){
        if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.completed')->with('portalUser', $portalUser);
    }

    public function showPaymentReportsPage(){
        if(!$this->checkAuthLevel(6)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.payments.reports')->with('portalUser', $portalUser);
    }

    //reports

    public function showReportsPage(){
        if(!$this->checkAuthLevel(7)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.reports.reports')->with('portalUser', $portalUser);
    }

    //feeds

    public function showFeedsPage(){
        if(!$this->checkAuthLevel(8)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.feeds')->with('portalUser', $portalUser);
    }

    public function showExportImportPage(){
        if(!$this->checkAuthLevel(8)){return redirect('/');}
        $categories = Category::all();
        $brands = Brand::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.export-import')->with(['categories'=>$categories, 'brands'=>$brands, 'portalUser'=>$portalUser]);
    }

    public function showFeedsSummaryPage(){
        if(!$this->checkAuthLevel(8)){return redirect('/');}
        $feeds = Feed::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.summary')->with('feeds', $feeds)->with('portalUser', $portalUser);
    }

    public function showFeedsExternalPage(){
        if(!$this->checkAuthLevel(8)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.external')->with('portalUser', $portalUser);
    }

    public function feedsExport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $columns = "";
        $datarows = "";
        $products = "";

        if($export_feed_parameter == 1){
            $columns = Schema::getColumnListing('buying_products');
            //28 
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', 'AA'];
            $products = BuyingProduct::all();
        }
        else if($export_feed_parameter == 2){
            $columns = Schema::getColumnListing('selling_products'); 
            #dd($columns);
            $products = SellingProduct::all();
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','R'];
        }
        
        $filename = "/feed_type_".$export_feed_parameter." " . date("Y-m-d") ."_". date("h-i-s") . ".xlsx";

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        #dd($datarows);
        if($export_feed_parameter == 1){
            for($i=0; $i<count($datarows); $i++){
                #dd($datarows);
                $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);
            }
            foreach($products as $key=>$product){
                $product = array_values($product->toArray());
                
                for($i=0; $i<count($product); $i++){
                    $sheet->setCellValue($datarows[$i] . ($key+2), $product[$i]);
                }
            }
        }
        else{
            $k = 2;
            for($i=0; $i<count($columns)-3; $i++){
                #dd($datarows);
                $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);
                $sheet->setCellValue('L1', 'created_at');
                $sheet->setCellValue('M1', 'updated_at');
                $sheet->setCellValue('N1', 'product_network');
                $sheet->setCellValue('O1', 'product_network_price');
                $sheet->setCellValue('P1', 'product_available_colours');

                $sheet->setCellValue('F1', 'product_memory');
                $sheet->setCellValue('G1', 'excellent_working');
                $sheet->setCellValue('H1', 'good_working');
                $sheet->setCellValue('I1', 'poor_working');
                $sheet->setCellValue('J1', 'damaged_working');
                $sheet->setCellValue('K1', 'faulty');
            }
            foreach($products as $key=>$product){
                $product = array_values($product->toArray());
                $productInformation = ProductInformation::where('product_id', $product[0])->get();
                $productNetworks = ProductNetworks::where('product_id', $product[0])->get();
                $productColor = Colour::where('product_id', $product[0])->get();

                $sheet->setCellValue('B' . $k, $product[1]);
                $sheet->setCellValue('C' . $k, $product[2]);
                $sheet->setCellValue('D' . $k, $product[3]);
                $sheet->setCellValue('E' . $k, $product[4]);
                $sheet->setCellValue('L' . $k, $product[6]);
                $sheet->setCellValue('M' . $k, $product[7]);

                $i=$k;
                foreach($productInformation as $productInfo){
                    $sheet->setCellValue('F'.$i, $productInfo->memory);
                    $sheet->setCellValue('G'.$i, $productInfo->excellent_working);
                    $sheet->setCellValue('H'.$i, $productInfo->good_working);
                    $sheet->setCellValue('I'.$i, $productInfo->poor_working);
                    $sheet->setCellValue('J'.$i, $productInfo->damaged_working);
                    $sheet->setCellValue('K'.$i, $productInfo->faulty);
                    $i++;
                }

                $i=$k;
                foreach($productNetworks as $network){
                    $sheet->setCellValue('N'.$i, $network->getNetWorkName($network->network_id));
                    $sheet->setCellValue('O'.$i, $network->knockoff_price);
                    $i++;
                }

                $i=$k;
                foreach($productColor as $color){
                    $sheet->setCellValue('P'.$i, $color->color_value);
                    $i++;
                }
            

                if(count($productNetworks) >= count($productColor)){
                    $k += count($productNetworks) + 1;
                }
                else{
                    $k += count($productColor) + 1;
                }
            }
        }




        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . "/" . $filename);
        
        $this->downloadFile(public_path() . "/" . $filename);
        

    }

    public function downloadBulk($file){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

            // if file is downloaded delete all created files from the sistem
            File::delete($file);
        }
    }

    public function downloadFile($file){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            // if file is downloaded delete all created files from the sistem
            File::delete($file);
            return \redirect()->back()->with('success','You have succesfully exported products.');
        }
    }

    public function downloadSingleFile(Request $request){

        return response(['code'=>200, 'filename'=>$request->file . ".pdf"]);

    }


    public function feedsImport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $products = "";
        $productInformation = "";

        # export feed parameters:
        # 1. - Sales products (SellingProduct model)
        # 2. - Recycle products (BuyingProduct model)

        if($export_feed_parameter == 1){
            DB::table('buying_products')->truncate();
            DB::table('buying_products_colours')->truncate();
            DB::table('buying_product_information')->truncate();
            DB::table('buying_product_network')->truncate();
        }
        else if($export_feed_parameter == 2){
            DB::table('selling_products')->truncate();
            DB::table('product_information')->truncate();
            DB::table('product_networks')->truncate();
            DB::table('colours')->truncate();
        }

        $inputFileName = $request->file('imported_csv')->getClientOriginalName();
        $inputFileType = 'Xlsx';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(true);

        $worksheetData = $reader->listWorksheetInfo($request->file('imported_csv'));
        $worksheetData = $worksheetData[0];

        $sheetName = $worksheetData['worksheetName'];
        $reader->setLoadSheetsOnly($sheetName);
        $spreadsheet = $reader->load($request->file('imported_csv'));
        $worksheet = $spreadsheet->getActiveSheet();

        $importeddata = $worksheet->toArray();

        #dd($importeddata, $networks);

        $file_header = $importeddata[0];

        if($importeddata[0][0]==='id'){
            unset($importeddata[0]);
        }
        $importeddata = array_values($importeddata);

        if($export_feed_parameter == 1){

            // check if there are enoguh fields
            if(count($file_header) < 28){
                return \redirect()->back()->with('error','Error - check your import file.');
            }

            $networks = Network::all();

            $emptyrows = array();

            $k = count($importeddata[0]);

            foreach($importeddata as $key=>$row){

                if($row[1] !== null){

                    $product = new BuyingProduct();
                    $product->product_name = $row[1];
                    $product->product_image = 'default_image';
                    $product->category_id = $row[3];
                    $product->brand_id = $row[4];
                    $product->product_description = $row[5];

                    
                    if($row[15] !== null){
                        $product->product_dimensions = $row[15];
                    }
                    if($row[16] !== null){
                        $product->product_processor = $row[16];
                    }
                    if($row[17] !== null){
                        $product->product_weight = $row[17];
                    }
                    if($row[18] !== null){
                        $product->product_screen = $row[18];
                    }
                    if($row[19] !== null){
                        $product->product_system = $row[19];
                    }
                    if($row[20] !== null){
                        $product->product_connectivity = $row[20];
                    }
                    if($row[21] !== null){
                        $product->product_battery = $row[21];
                    }
                    if($row[22] !== null){
                        $product->product_signal = $row[22];
                    }
                    if($row[23] !== null){
                        $product->product_camera = $row[23];
                    }
                    if($row[24] !== null){
                        $product->product_camera_2 = $row[24];
                    }
                    if($row[25] !== null){
                        $product->product_sim = $row[25];
                    }
                    if($row[26] !== null){
                        $product->product_memory_slots = $row[26];
                    }

                    $product->save();
                }

                if($importeddata[$key][6] !== null){
                    $buyingProductInformation = new BuyingProductInformation();
                    $buyingProductInformation->product_id = $product->id;
                    $buyingProductInformation->memory = $importeddata[$key][6];
                    $buyingProductInformation->excellent_working = $importeddata[$key][7];
                    $buyingProductInformation->good_working = $importeddata[$key][8];
                    $buyingProductInformation->poor_working = $importeddata[$key][9];
                    $buyingProductInformation->save();
                }

                foreach($networks as $network){
                    if($importeddata[$key][12] !== null && $network->network_name == $importeddata[$key][12]){
                        $productNetworks = new BuyingProductNetworks();
                        $productNetworks->network_id = $network->id;
                        $productNetworks->product_id = $product->id;
                        $productNetworks->knockoff_price = $importeddata[$key][13];
                        $productNetworks->save();
                    }
                }   

                $feed = new Feed();
                $feed->feed_type = "All buying devices";
                $feed->status = "Done";
                $feed->save();
            }
        }
        else if($export_feed_parameter == 2){

            // required fields for importing Recycle products
            $required_product_fields = ['product_name', 'product_image', 'category_id', 'brand_id'];
            // if memory, then these required
            $required_product_info_fields = ['product_memory', 'customer_grade_price_1', 'customer_grade_price_2', 'customer_grade_price_3', 'customer_grade_price_4', 'customer_grade_price_5'];

            // if network id, then these are required
            $required_product_network_fields = ['product_network', 'product_network_price', 'product_avalible_colours'];

            $missing_header_fields = [];

            // check product required fields
            foreach($required_product_fields as $f){
                if(!in_array($f, $file_header)){
                    array_push($missing_header_fields, $f);
                }
            }

            // check product info header fields
            foreach($required_product_info_fields as $pi){
                if(!in_array($pi, $file_header)){
                    array_push($missing_header_fields, $pi);
                }
            }

            // check product network header fields
            foreach($required_product_network_fields as $pnf){
                if(!in_array($pnf, $file_header)){
                    array_push($missing_header_fields, $pnf);
                }
            }


            if(count($missing_header_fields) > 0){
                return \redirect()->back()->with('error','Error - check your import file. Missing fields: ' . implode(', ', $missing_header_fields));
            }



            $networks = Network::all();

            $emptyrows = array();

            $k = count($importeddata[0]);
            
            // messages to display after failed/skipped imports
            $export_log = [];

            foreach($importeddata as $key=>$row){
                
                if($row[1] !== null){
                    $valid_product = false;
                    // validate selling product data
                    if(isset($row[1]) && isset($row[3]) && isset($row[4])){
                        $valid_product = true;
                    }
                    if($valid_product){
                        $sellingProduct = new SellingProduct();
                        $sellingProduct->product_name = $row[1];
                        $sellingProduct->product_image = 'default_image';
                        $sellingProduct->category_id = $row[3];
                        $sellingProduct->brand_id = $row[4];
                        $sellingProduct->save();   
                    } else {
                        $missing = [];
                        if(!isset($row[1])) { array_push($missing, $file_header[1]); }
                        if(!isset($row[3])) { array_push($missing, $file_header[3]); }
                        if(!isset($row[4])) { array_push($missing, $file_header[4]); }
    
                        if(count($missing) < 2){
                            array_push($export_log, "Missing Selling Product " .  $missing[0]);
                        } else {
                            array_push($export_log, "Missing Selling Product: " . implode(', ', $missing));
                        }
                    }
                } 

                // check if product info data is valid
                $valid_product_info = false;
                if(isset($row[5]) && isset($row[6]) && isset($row[7]) && isset($row[8]) && isset($row[9]) && isset($row[10])){
                    $valid_product_info = true;
                }

                // if memory is present, store product information
                if($importeddata[$key][5] !== null){
                    if($valid_product_info){
                        $sellingProductInformation = new ProductInformation();
                        $sellingProductInformation->product_id = $sellingProduct->id;
                        $sellingProductInformation->memory = $importeddata[$key][5];
                        $sellingProductInformation->excellent_working = $importeddata[$key][6];
                        $sellingProductInformation->good_working = $importeddata[$key][7];
                        $sellingProductInformation->poor_working = $importeddata[$key][8];
                        $sellingProductInformation->damaged_working = $importeddata[$key][9];
                        $sellingProductInformation->faulty = $importeddata[$key][10];
                        $sellingProductInformation->save();
                    } else {
                        $missing = [];
                        if(!isset($row[5])) { array_push($missing, $file_header[5]); }
                        if(!isset($row[6])) { array_push($missing, $file_header[6]); }
                        if(!isset($row[7])) { array_push($missing, $file_header[7]); }
                        if(!isset($row[8])) { array_push($missing, $file_header[8]); }
                        if(!isset($row[9])) { array_push($missing, $file_header[9]); }
                        if(!isset($row[10])) { array_push($missing, $file_header[10]); }

    
                        if(count($missing) < 2){
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] info: " .  $missing[0]);
                        } else {
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] info: " . implode(', ', $missing));
                        }
                    }
                }

                foreach($networks as $network){

                    // if network is present and valid, add product network
                    if($importeddata[$key][13] !== null && $network->network_name == $importeddata[$key][13]){

                        // check if product network info is valid
                        $valid_network_info = false;
                        if(isset($row[14])){
                            $valid_network_info = true;
                        }

                        if($valid_network_info){
                            $productNetworks = new ProductNetworks();
                            $productNetworks->network_id = $network->id;
                            $productNetworks->product_id = $sellingProduct->id;
                            $productNetworks->knockoff_price = $importeddata[$key][14];
                            $productNetworks->save();
                        } else {
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] network [" . $network->network_name . "] info: " . $file_header[14]);
                        }

                        
                    }
                }

                // check if product color info is valid
                if($importeddata[$key][15] !== null){

                    $productColours = new Colour();
                    $productColours->product_id = $sellingProduct->id;
                    $productColours->color_value = $importeddata[$key][15];
                    $productColours->save(); 
                    
                }


            }

            if(!empty($export_log)){
                array_push($export_log, 'You have succesfully imported products.');
                return \redirect()->back()->with('failed-info', $export_log);
            }
     
        }
        else{
            return \redirect()->back()->with('error','Something went wrong, please try again.');
        }
        return \redirect()->back()->with('success','You have succesfully imported products.');
    }

    //users

    public function showUsersPage(){
        if(!$this->checkAuthLevel(9)){return redirect('/');}

        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        $users = User::where('type_of_user', 1)->orWhere('type_of_user', 2)->orWhere('type_of_user', 3)->get();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.users')->with('users', $users)->with('portalUser', $portalUser);
    }

    public function showAddUserPage(){
        if(!$this->checkAuthLevel(9)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('title', 'Add User')->with('portalUser', $portalUser);
    }

    public function editUser($id){
        if(!$this->checkAuthLevel(9)){return redirect('/');}
        $userdata = User::where('id', $id)->get();
        $userdata = $userdata[0];

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('userdata', $userdata)->with('title', 'Edit User '.$userdata->first_name)->with('portalUser', $portalUser);
    }

    public function deleteUser($id){
        if(!$this->checkAuthLevel(9)){return redirect('/');}
        User::where('id', $id)->delete();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return \redirect()->back();
    }

    public function addUser(Request $request){

        #dd($request->all());

        if($request->password !== $request->confirm_password){
            return \redirect('/portal/user/add')->with('error', "Password mismach.");
        }
        
        if(count(User::where('email', $request->email)->get())>0){
            return \redirect('/portal/user/add')->with('error', "User Exists.");
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($request->password);
        $user->birthdate = "01.08.2020";
        $user->current_phone = 0;
        $user->preffered_os = 'none';
        $user->sub = 0;
        $user->delivery_address = "none";
        $user->billing_address = "none";
        $user->contact_number = "none";
        $user->bamboo_credit = 0;
        $user->username = $request->username;
        $user->worker_email = "customersupport@bamboorecycle.com";
        $user->type_of_user = 1;
        $user->account_disabled = 0;

        $user->save();

        $portalUser = new PortalUsers();
        $portalUser->user_id = $user->id;
        if($request->recycle == "on"){
            $portalUser->recycle = true;
        }
        if($request->trade_pack_despatch == "on"){
            $portalUser->trade_pack_despatch = true;
        }
        if($request->awaiting_receipt == "on"){
            $portalUser->awaiting_receipt = true;
        }
        if($request->receiving == "on"){
            $portalUser->receiving = true;
        }
        if($request->device_testing == "on"){
            $portalUser->device_testing = true;
        }
        if($request->trolley_managment == "on"){
            $portalUser->trolley_management = true;
        }
        if($request->trays_managment == "on"){
            $portalUser->trays_managment = true;
        }
        if($request->box_managment == "on"){
            $portalUser->box_management = true;
        }
        if($request->quarantine_managment == "on"){
            $portalUser->quarantine_managment = true;
        }
        if($request->warehouse_management == "on"){
            $portalUser->warehouse_management = true;
        }
        if($request->customer_care == "on"){
            $portalUser->customer_care = true;
        }
        if($request->order_management == "on"){
            $portalUser->order_management = true;
        }
        if($request->create_order == "on"){
            $portalUser->create_order = true;
        }
        if($request->customer_accounts == "on"){
            $portalUser->customer_accounts = true;
        }
        if($request->administration == "on"){
            $portalUser->administration = true;
        }
        if($request->salvage_models == "on"){
            $portalUser->salvage_models = true;
        }
        if($request->sales_models == "on"){
            $portalUser->sales_models = true;
        }
        if($request->feeds == "on"){
            $portalUser->feeds = true;
        }
        if($request->users == "on"){
            $portalUser->users = true;
        }
        if($request->reports == "on"){
            $portalUser->reports = true;
        }
        if($request->cms == "on"){
            $portalUser->cms = true;
        }
        if($request->settings == "on"){
            $portalUser->settings = true;
        }
        if($request->payments == "on"){
            $portalUser->payments = true;
        }
        if($request->payments_awaiting_assignment == "on"){
            $portalUser->payments_awaiting_assignment = true;
        }
        if($request->pending_payments == "on"){
            $portalUser->pending_payments = true;
        }
        if($request->completed_payment == "on"){
            $portalUser->completed_payment = true;
        }
        if($request->payment_report == "on"){
            $portalUser->payment_report = true;
        }


        $portalUser->save();

        return \redirect('/portal/user');
    }

    public function searchUser(Request $request){
        $user = null;
        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        if($request->select_search_by_field == 1){
            $user = User::where('id', $request->searchname)->where($match)->first();
            #dd($user);
            if($user != null){
                $user = $user[0];
            }
            else{
                return \redirect()->back()->with('error', "User not found. Please check your search parameters.");
            }
            
        }
        else if($request->select_search_by_field == 2){
            $user = User::where('first_name', $request->searchname)->where($match)->first();
            if($user != null){
                $user = $user[0];
            }
            else{
                return \redirect()->back()->with('error', "User not found. Please check your search parameters.");
            }
        }

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('userdata', $user)->with('title', "Search result: ".$user->first_name)->with('portalUser', $portalUser);
    }

    //settings

    public function showSettingsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.settings')->with('portalUser', $portalUser);
    }

    public function showSettingsProductOptionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.product-options')->with('portalUser', $portalUser);
    }

    public function showSettingsConditionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $conditions = Conditions::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.conditions')->with('conditions', $conditions)->with('portalUser', $portalUser);
    }

    public function showSellingColourPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $colours = Colour::all();
        #dd($colours);
        return view('portal.settings.productoptions.colour')->with(['portalUser'=>$portalUser, 'colours'=>$colours]);

    }

    public function showSellingNetworksPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $networks = Network::all();
        #dd($networks);

        return view('portal.settings.productoptions.networks')->with(['portalUser'=>$portalUser, 'networks'=>$networks]);

    }

    public function showSellingMemoryPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $memories = Memory::all();

        return view('portal.settings.productoptions.memory')->with(['portalUser'=>$portalUser, 'memories'=>$memories]);
    }

    public function addColourPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.colour')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
    }

    public function addNetworkPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.network')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
        
    }

    public function addMemoryPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.memory')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
    }

    public function addColour(Request $request){
        $color = new Colour();

        $color->brand_id = $request->brand_id;
        $color->color_value = $request->color_value;

        $color->save();
        return redirect()->back()->with('success', 'You have succesfully added the color.');
    }

    public function addNetwork(Request $request){
        $network = new Network();

        $network->brand_id = $request->brand_id;
        $network->network_value = $request->network_value;

        $network->save();
        return redirect()->back()->with('success', 'You have succesfully added the network.');
    }

    public function addMemory(Request $request){
        $memory = new Memory();

        $memory->brand_id = $request->brand_id;
        $memory->memory_value = $request->memory_value;

        $memory->save();
        return redirect()->back()->with('success', 'You have succesfully added the memory.');
    }

    public function showSettingsAddConditionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.condition')->with('portalUser', $portalUser);
    }

    public function addCondition(Request $request){
        

        $condition = new Conditions();
        $condition->name = $request->condition_name;
        $condition->alias = $request->condition_alias;
        $condition->importance = $request->condition_importance;

        $condition->save();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return redirect('/portal/settings/conditions');
    }

    public function showSettingsTestingQuestionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $categories = Category::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.testing-questions')->with('categories', $categories)->with('portalUser', $portalUser);
    }

    public function showCategoryQuestionsPage($productId, $id){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        dd($productid, $id);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        
        return view('portal.settings.questions')->with('portalUser', $portalUser);
    }

    public function showCategoryAddQuestionPage($id){
        $brandid = $id;
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.question')->with('brandid', $brandid)->with('portalUser', $portalUser);
    }

    public function showSettingsWebsitesPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $websites = Websites::all();
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.websites')->with('websites', $websites)->with('portalUser', $portalUser);
    }

    public function showAddWebsitePage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.website')->with('portalUser', $portalUser);
    }

    public function addWebsite(Request $request){
        $website = new Websites();
        $website->website_name = $request->website_name;
        $website->website_address = $request->website_address;

        $filenameWithExt = $request->file('website_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('website_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('website_image')->storeAs('public/website_images',$fileNameToStore);

        $website->website_image = $fileNameToStore;
        $website->save();
        return redirect('/portal/settings/websites');
    }

    public function deleteWebsite($id){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $website = Websites::where('id', $id);
        $website->delete();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return redirect('/portal/settings/websites')->with('portalUser', $portalUser);
    }

    public function showSettingsStoresPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $stores = Stores::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.stores')->with('stores', $stores)->with('portalUser', $portalUser);
    }

    public function showAddStorePage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.store')->with('portalUser', $portalUser);
    }

    public function addStore(Request $request){
        $store = new Stores();
        $store->store_name = $request->store_name;
        $store->store_address = $request->store_address;

        $filenameWithExt = $request->file('store_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('store_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('store_image')->storeAs('public/store_images',$fileNameToStore);

        $store->store_image = $fileNameToStore;
        $store->save();
        return redirect('/portal/settings/stores');
    }

    public function deleteStore($id){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $store = Stores::where('id', $id);
        $store->delete();
        return redirect('/portal/settings/stores');
    }

    public function showSettingsPaymentsOptionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.payment-options')->with('portalUser', $portalUser);
    }

    public function showSettingsDeliveryOptionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.delivery-options')->with('portalUser', $portalUser);
    }

    public function showSettingsCheckoutOptionsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.checkout-options')->with('portalUser', $portalUser);
    }

    public function showSettingsPromotionalCodesPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.promotional-codes')->with('portalUser', $portalUser);
    }

    public function showSettingsBrandsPage(){
        if(!$this->checkAuthLevel(10)){return redirect('/');}
        $brands = Brand::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.brands')->with('brands', $brands)->with('portalUser', $portalUser);
    }

    //cms

    public function showCmsPage(){
        if(!$this->checkAuthLevel(11)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.cms.cms')->with('portalUser', $portalUser);
    }

    //trays

    public function showTraysPage(){
        if(!$this->checkAuthLevel(12)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trays = Tray::all();

        return view('portal.trays.trays')->with(['portalUser'=>$portalUser, 'trays'=>$trays]);
    }

    public function showAddTrayPage(){
        if(!$this->checkAuthLevel(12)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        return view('portal.add.tray')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function addTray(Request $request){

        $trays = Tray::where('tray_name', $request->tray_name)->get();

        if(count($trays)>=1){
            return redirect('/portal/trays')->with('error', 'Tray with name '.$request->tray_name.' already exists.');
        }

        $tray = new Tray();

        $tray->tray_name = $request->tray_name;

        $tray->save();

        return redirect('/portal/trays')->with('success', 'You have succesfully created a tray '.$request->tray_name.'.');
    }

    public function showTrayPage(Request $request){
        $trayid = $request->tray_id_scan;

        $tray = Tray::where('id', $trayid)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        $trayContent = TrayContent::where('tray_id', $tray->id)->get();

        $tradeins = array();

        foreach($trayContent as $tc){
            $tradein = Tradein::where('id', $tc->trade_in_id)->first();
            array_push($tradeins, $tradein);
        }

        return view('portal.trays.tray')->with(['portalUser'=>$portalUser, 'tray'=>$tray, 'trolleys'=>$trolleys, 'trayContetnt'=>$trayContent, 'tradeins'=>$tradeins]);
    }

    public function printTrayLabel($id){

        $traybarcode = $id;
     
        $barcode = DNS1D::getBarcodeHTML($traybarcode, 'C128');

        $this->generateTrayLabel($barcode, $traybarcode);
    }

    public function generateTrayLabel($barcode, $id){

        $html = "<style>body > div:nth-child(1) > div:nth-child(2) {
            margin: auto;
            }</style>";
        $html .= "<div style='text-align:center; margin:0 auto;'><p style='margin:auto;'>". $barcode ."<br>" .  $id ."</p></div>";


        #echo $html;
        #die();

        $brandLet = substr($id, 1, 1);
        $brand = "";

        if($brandLet === "A"){
            $brand = "Apple";
        }
        if($brandLet === "S"){
            $brand = "Samsung";
        }
        if($brandLet === "H"){
            $brand = "Huaweii";
        }
        if($brandLet === "M"){
            $brand = "Miscellaneous";
        }
        if($brandLet === "Q"){
            $brand = "Quarantine";
        }

        $filename = "label-" . $id . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.tray', array('barcode'=>$barcode, 'id'=>$id, 'brand'=>$brand))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function addTrayToTrolley(Request $request){

        $tray = Tray::where('id', $request->tray_id)->first();
        $trolley = "";

        if($tray->trolley_id == null){
            $tray->trolley_id = $request->trolley_select;

            $tray->save();
    
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays +=1 ;
            $trolley->save();
        }
        else{
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays -=1 ;
            $trolley->save();

            $tray->trolley_id = $request->trolley_select;

            $trolley = Trolley::where('id', $tray->trolley_id)->first();
            $trolley->number_of_trays +=1 ;
            $trolley->save();

            $tray->save();
        }



        return redirect()->back()->with('success', 'You have assigned this tray to trolley '. $trolley->trolley_name);
    }

    public function deleteTray($id){
        $tray = Tray::where('id', $id)->first();
        if($tray->trolley_id != null){
            $traycontent = TrayContent::where('tray_id', $id)->get();
            $trolley = Trolley::where('id', $tray->trolley_id)->first();
    
            foreach($traycontent as $trayitem){
                $tradein = Tradein::where('id', $trayitem->trade_in_id)->first();
                $tradein->delete();
            }

            $trolley->number_of_trays = $trolley->number_of_trays-1;
            $trolley->save();
        }

        $trayname = $tray->tray_name;

        $tray->delete();

        return redirect()->back()->with('success', 'You have succesfully deleted the tray with name '.$trayname);

    }

    //trolleys

    public function showTrolleysPage(){
        if(!$this->checkAuthLevel(13)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        return view('portal.trolleys.trolleys')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function showAddTrolleyPage(){
        if(!$this->checkAuthLevel(12)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        return view('portal.add.trolley')->with(['portalUser'=>$portalUser, 'trolleys'=>$trolleys]);
    }

    public function showTrolleyPage(Request $request){

        $trolleyid = $request->trolley_id_scan;

        $trolley = Trolley::where('id', $trolleyid)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleyTrays = Tray::where('trolley_id', $trolleyid)->get();


        return view('portal.trolleys.trolley')->with(['portalUser'=>$portalUser, 'trolley'=>$trolley, 'trolleyTrays'=>$trolleyTrays]);
    }

    public function printTrolleyLabel($id){

        $barcode = DNS1D::getBarcodeHTML($id, 'C128');

        $this->generateTrolleyLabel($barcode, $id);
    }

    public function generateTrolleyLabel($barcode, $id){
        

        $filename = "labeltrolley-" . $id . ".pdf";
        $customPaper = array(0,0,141.90,283.80);
        PDF::loadView('portal.labels.trolley', array('barcode'=>$barcode, 'id'=>$id))->setPaper($customPaper, 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function addTrolley(Request $request){

        $trolley = new Trolley();

        $trolley->trolley_name = $request->trolley_name;
        $trolley->trolley_type = $request->trolley_type;

        $trolley->save();

        return redirect('/portal/trolleys');
    }

    public function deleteTrolley($id){
        $trolley = Trolley::where('id', $id)->first();
        $trays = Tray::where('trolley_id', $id)->get();
        
        foreach($trays as $tray){
            $traycontent = TrayContent::where('tray_id', $id)->get();
    
            foreach($traycontent as $trayitem){
                $tradein = Tradein::where('id', $trayitem->trade_in_id)->first();
                $tradein->delete();
            }

            $tray->delete();
        }

        $trolley->delete();

        return redirect()->back()->with('success', 'You have succesfully deleted the trolley and it\'s content.');
    }

    //boxes

    public function showBoxesPage(){
        if(!$this->checkAuthLevel(14)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $boxes = Box::all();

        return view('portal.boxes.boxes')->with(['portalUser'=>$portalUser, 'boxes'=>$boxes ]);
    }

    public function showAddBoxPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.box')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
    }

    public function showBoxPage(Request $request){
        if(!$this->checkAuthLevel(14)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $box = Box::where('box_name',$request->box_id_scan)->first();

        return view('portal.boxes.box')->with(['portalUser'=>$portalUser, 'box'=>$box ]);
    }

    public function addBox(Request $request){
        
        $boxes = Box::where('box_name', $request->box_name)->get();
        if(count($boxes)>=1){
            return redirect('/portal/boxes')->with('error', 'Box with name '.$request->box_name.' already exists.');
        }
        
        $box = new Box();
        if($request->brands == "Apple"){
            $box->manifacturer = "Apple";
        }
        elseif($request->brands == "Samsung"){
            $box->manifacturer = "Samsung";
        }
        elseif($request->brands == "Huawei"){
            $box->manifacturer = "Huawei";
        }
        else{
            $box->manifacturer = "Miscenalious";
        }
        $box->box_name = $request->box_name;
        $box->description = $request->box_description;

        $box->save();

        return redirect('/portal/boxes')->with('error', 'Box with name '.$request->box_name.' already exists.');
    }

    public function removeBox($parameter){
        $box = Box::where('id', $parameter)->first();

        $boxname = $box->box_name;

        $box->delete();
        

        return redirect('/portal/boxes')->with('success', 'Box with name '.$boxname.' was succesfully deleted.');
    }

    public function showAddDeviceToBoxPage($boxname){

        $box = Box::where('box_name', $boxname)->first();

        $box_mark = $this->get_string_between($box->box_name, '(', ')');
        $brand_id = substr($boxname, -4, 1);

        $tradeins = "";

        if($brand_id === "A"){
            $brand_id = 1;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    dd($tradein);
                }
            }
        }
        elseif($brand_id === "S"){
            $brand_id = 2;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    $tradeins->forget($key);
                }
            }
        }
        elseif($brand_id === "H"){
            $brand_id = 3;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) != $brand_id){
                    $tradeins->forget($key);
                }
            }
        }
        else{
            $brand_id = 4;
            $tradeins = Tradein::where('bamboo_grade', $box_mark)->where('marked_for_quarantine', false)->where('received', true)->get();
            foreach($tradeins as $key => $tradein){
                if($tradein->getBrandId($tradein->product_id) <= 3){
                    $tradeins->forget($key);
                }
            }
        }
        
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.boxes.adddevice')->with(['avalibleDevices'=>$tradeins, 'portalUser'=>$portalUser]);
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    //Auth Level

    public function checkAuthLevel($data){
       
        return true;

    }


    function generateNewLabel($tradein_barcode, $manifacturer, $model, $imei, $location){

        $pdf = PDF::loadView('portal.labels.devicelabel', 
        array(
            'tradein_barcode'=>$tradein_barcode,
            'manifacturer'=>$manifacturer,
            'model'=>$model,
            'imei'=>$imei,
            'location'=>$location))
        ->save('pdf/devicelabel-'. $tradein_barcode .'.pdf');
    
    }
    

}

