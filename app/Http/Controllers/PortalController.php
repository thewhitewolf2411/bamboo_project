<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Category;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductData;
use App\Eloquent\Brand;
use App\Eloquent\PortalUsers;
use App\Eloquent\Feed;
use App\Eloquent\Conditions;
use App\Eloquent\Websites;
use App\Eloquent\Stores;
use App\Eloquent\TestingQuestions;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use App\Eloquent\Quarantine;
use App\Eloquent\Tray;
use App\Eloquent\Trolley;
use App\Eloquent\Box;
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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PortalController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function portal(){
        if(Auth::User()->type_of_user == 1 || Auth::User()->type_of_user == 2 || Auth::User()->type_of_user == 3){

            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();

            return view('portal')->with('portalUser', $portalUser);
        }
        else{
            return redirect('/');
        }
    }

    //customer care

    public function showCustomerCare(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.customer-care')->with('portalUser', $portalUser);
    }

    public function showTradeIn(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradeins = Tradein::where('job_state', null)->get();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-in')->with('tradeins', $tradeins)->with('portalUser', $portalUser);
    }

    public function showTradeInDetails($id){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.customer-care.trade-in-details')->with('tradein', $tradein)->with('portalUser', $portalUser);
    }

    public function PrintTradeInLabelBulk(Request $request){
        #dd($request);

        $html = "";

        $numberOfBulkPrints = $request->number_of_bulk_prints;
        if($numberOfBulkPrints == 10){
            $tradeins = Tradein::where('job_state', null)
                                ->take(10)
                                ->get();

        }
        elseif($numberOfBulkPrints === 20){
            $tradeins = Tradein::where('job_state', null)
                                ->take(20)
                                ->get();
        }
        elseif($numberOfBulkPrints === 50){
            $tradeins = Tradein::where('job_state', null)
            ->take(50)
            ->get();
        }
        elseif($numberOfBulkPrints === 100){
            $tradeins = Tradein::where('job_state', null)
            ->take(100)
            ->get();
        }
        elseif($numberOfBulkPrints === 500){
            $tradeins = Tradein::where('job_state', null)
            ->take(500)
            ->get();
        }
        else{
            return redirect()->back();
        }
        foreach($tradeins as $tradein){

            $user = User::where('id',$tradein->user_id)->first();
            $product = SellingProduct::where('id', $tradein->product_id);
            $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

            $ti = Tradein::where('id', $tradein->id)->first();
            $ti->job_state = 1;
            $ti->save();

            $html .= $this->generateTradeInHTMLBulk($barcode, $user, $product, $tradein);

        }

        #echo $html;
        #die();

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        $this->downloadBulk($filename);
    }

    public function PrintTradeInLabel(Request $request){

        $tradein = Tradein::where('id', $request->hidden_print_trade_pack_trade_in_id)->first();
        $user = User::where('id',$tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id);

        $tradein->job_state = 1;
        $tradein->save();

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');
        $this->generateTradeInHTML($barcode, $user, $product, $tradein);
    }

    public function generateTradeInHTMLBulk($barcode, $user, $product, $tradein){
        $html = "";
        $html .= "<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;} .page_break{page-break-after: always;}</style>";
        $html .= "<body>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<p>" . $user->first_name . " " . $user->last_name . "</p>";
        $html .= "<p>Bamboo Distribution Limited</p>";
        $html .= "<p>Unit 11, Io Centre</p>";
        $html .= "<p>Unit 11, Io Centre</p>";
        $html .= "<p>Waltham Abbey</p>";
        $html .= "<p>Essex</p>";
        $html .= "<p>En9 1as</p>";
        $html .= "<p>United Kingdom</p>";
        $html .= "<br><br>";
        $html .= "<p>Order#". $tradein->barcode . " Date: " . $tradein->created_at .  "</p>";
        $html .= "<p>Dear " . $user->first_name . " " . $user->last_name . ",</p>";
        $html .= "<p>Thank you very much for using Bamboo Recycle to recycle your mobile device(s). This package contains your TradePack which you can use to post your recycled device(s) back to Bamboo. Please follow the instructions below on how toreturn your recycled device(s) to Bamboo:</p>";
        $html .= "  <ol>
                        <li>Gather your recycled device(s) and remove any sim cards or memory cards from thedevice(s).</li>
                        <li>Place the device(s) into the Trade Pack that you received from Bamboo with this package. (Please rememberwe only require the handset, unless of course the device you're recycling is brand new and boxed.)</li>
                        <li>Next, seal the Trade Pack by folding over the sticky flap at the top.</li>
                        <li>Finally, you must then place the Freepost Label, found on the bottom left of this letter, onto the front of the TradePack then post your Trade Pack back to Bamboo!</li>
                    </ol> ";
        $html .= "<p>Once your recycled device(s) are received by Bamboo you will be sent an email confirming this. Your device(s) will thenbe tested to make sure they match the conditions that were set when placing the order. After each device has beensuccessfully tested you will receive a final email confirming payment for the device using the method that you selected.(Please note: Payment will be made on a per device basis.)<br>If you have any problems returning your device(s) please view the FAQs section on our website or contact us directly byemailing customersupport@bamboorecycle.com with your enquiry.</p>";
        $html .= "<p>Kind Regards,</p>";
        $html .= "<p>Bamboo Mobile</p>";
        $html .= "<h3>Freepost return address</h3>";
        $html .=    "<div class='page_break' style='clear:both; position:relative; display:flex;'>
                        <div style='width:190pt; height:150px;' >
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $tradein->barcode ."</p></div>
                        </div>
                        <div style='margin-left:200pt; margin-top:-150px; width:190pt; height:150px;'>
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $tradein->barcode ."</p></div>
                        </div>
                    </div></body>";
        #echo $html;
        #die();



        return $html;

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        $this->downloadBulk($filename);
    }

    public function generateTradeInHTML($barcode, $user, $product, $tradein){

        $html = "";
        $html .= "<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<p>" . $user->first_name . " " . $user->last_name . "</p>";
        $html .= "<p>Bamboo Distribution Limited</p>";
        $html .= "<p>Unit 11, Io Centre</p>";
        $html .= "<p>Unit 11, Io Centre</p>";
        $html .= "<p>Waltham Abbey</p>";
        $html .= "<p>Essex</p>";
        $html .= "<p>En9 1as</p>";
        $html .= "<p>United Kingdom</p>";
        $html .= "<br><br>";
        $html .= "<p>Order#". $tradein->barcode . " Date: " . $tradein->created_at .  "</p>";
        $html .= "<p>Dear " . $user->first_name . " " . $user->last_name . ",</p>";
        $html .= "<p>Thank you very much for using Bamboo Recycle to recycle your mobile device(s). This package contains your TradePack which you can use to post your recycled device(s) back to Bamboo. Please follow the instructions below on how toreturn your recycled device(s) to Bamboo:</p>";
        $html .= "  <ol>
                        <li>Gather your recycled device(s) and remove any sim cards or memory cards from thedevice(s).</li>
                        <li>Place the device(s) into the Trade Pack that you received from Bamboo with this package. (Please rememberwe only require the handset, unless of course the device you're recycling is brand new and boxed.)</li>
                        <li>Next, seal the Trade Pack by folding over the sticky flap at the top.</li>
                        <li>Finally, you must then place the Freepost Label, found on the bottom left of this letter, onto the front of the TradePack then post your Trade Pack back to Bamboo!</li>
                    </ol> ";
        $html .= "<p>Once your recycled device(s) are received by Bamboo you will be sent an email confirming this. Your device(s) will thenbe tested to make sure they match the conditions that were set when placing the order. After each device has beensuccessfully tested you will receive a final email confirming payment for the device using the method that you selected.(Please note: Payment will be made on a per device basis.)<br>If you have any problems returning your device(s) please view the FAQs section on our website or contact us directly byemailing customersupport@bamboorecycle.com with your enquiry.</p>";
        $html .= "<p>Kind Regards,</p>";
        $html .= "<p>Bamboo Mobile</p>";
        $html .= "<h3>Freepost return address</h3>";
        $html .=    "<div style='clear:both; position:relative; display:flex;'>
                        <div style='width:190pt; height:150px;' >
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $tradein->barcode ."</p></div>
                        </div>
                        <div style='margin-left:200pt; margin-top:-150px; width:190pt; height:150px;'>
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $tradein->barcode ."</p></div>
                        </div>
                    </div>";
        #echo $html;
        #die();

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
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

    public function showTradePack(){
        if(!$this->checkAuthLevel(1)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $tradeins = Tradein::whereIn('job_state', array(1,2,3,4,5))->get();
        return view('portal.customer-care.trade-pack')->with('portalUser', $portalUser)->with('tradeins', $tradeins);
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
        return view('portal.customer-care.seller')->with('portalUser', $portalUser);
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
        $category = Category::where('id', $id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.categories.editcategory')->with('portalUser', $portalUser);
    }

    public function deleteCategory($id){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        Category::where('id', $id)->delete();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return \redirect('/portal/categories')->with('portalUser', $portalUser);
    }

    public function showAddBrandsView(){
        if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.add.brand')->with('portalUser', $portalUser);
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
        return \redirect('/portal/categories')->with('portalUser', $portalUser);
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
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.sellingproduct')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);
    }

    public function showBuyingProductsPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.buyingproduct')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);
    }

    public function showAddBuyingProductPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.buyingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser]);
    }

    public function showAddSellingProductPage(){
        if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        
        return view('portal.add.sellingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser]);
    }

    public function addBuyingProduct(Request $request){

        $product = new BuyingProduct();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->product_network = $request->product_network;
        $product->product_memory = $request->product_memory;
        $product->product_colour = $request->product_color;
        $product->product_grade = $request->product_grade;
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
        $product->product_quantity = $request->product_quantity;
        $product->product_buying_price = $request->product_buying_price;

        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        $category = Category::where('id', $request->category)->first();
        $category->total_produts = $category->total_produts+1;
        $category->save();

        $brand = Brand::where('id', $request->brand)->first();
        $brand->total_produts = $brand->total_produts + 1;
        $brand->save();

        return \redirect('/portal/product/buying-products');
    }

    public function addSellingProduct(Request $request){
        $product = new SellingProduct();
        
        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->product_memory = $request->product_memory;
        $product->product_colour = $request->product_color;
        $product->product_network = $request->product_network;
        $product->product_grade_1 = $request->product_grade_1;
        $product->product_grade_2 = $request->product_grade_2;
        $product->product_grade_3 = $request->product_grade_3;
        $product->product_selling_price_1 = $request->product_selling_price_1;
        $product->product_selling_price_2 = $request->product_selling_price_2;
        $product->product_selling_price_3 = $request->product_selling_price_3;

        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        return \redirect('/portal/product/selling-products');
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

        return view('portal.quarantine.awaiting')->with('portalUser', $portalUser);
    }

    public function showQuarantineReturn(){
        if(!$this->checkAuthLevel(4)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.quarantine.return')->with('portalUser', $portalUser);
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

    //testing

    public function showTestingPage(){
        if(!$this->checkAuthLevel(5)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.testing.testing')->with('portalUser', $portalUser);
    }

    public function showReceiveTradeIn(){
        if(!$this->checkAuthLevel(5)){return redirect('/');}

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
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        
        $tradein = Tradein::where('barcode', $request->scanid)->first();

        if($tradein == null){

            return redirect()->back()->with('error', 'There is no such device');

        }

        if($tradein->job_state <5){
            return redirect('/portal/testing/receive');
        }
        else{
            $user_id = Auth::user()->id;
            $portalUser = PortalUsers::where('user_id', $user_id)->first();
            return view('portal.testing.testdevice')->with(['tradein'=>$tradein, 'portalUser'=>$portalUser]);
        }

    }

    public function receive(Request $request){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradeins = Tradein::where('barcode', $request->scanid)->get();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
       
        return view('portal.testing.order')->with('tradeins', $tradeins)->with('portalUser', $portalUser);
    }

    public function testItem($id){
        if(!$this->checkAuthLevel(5)){return redirect('/');}
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();


        $testingquestion = TestingQuestions::where('order_id', $tradein->id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        
        if($testingquestion !== null){
            return view('portal.testing.questions')->with(['tradein'=>$tradein, 'user'=>$user, 'product'=>$product, 'testingquestion'=>false, 'testingquestions'=>$testingquestion,'portalUser'=>$portalUser]);
        }
        else{
            return view('portal.testing.questions')->with(['tradein'=>$tradein, 'user'=>$user, 'product'=>$product, 'testingquestion'=>true,'portalUser'=>$portalUser]);
        }

        
    }

    public function setTradeInStatus(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $tradein->job_state = 3;

        $testingquestion = "";

        #dd(TestingQuestions::where('order_id', $tradein->id)->first());

        if(TestingQuestions::where('order_id', $tradein->id)->first() == null){
            $testingquestion = new TestingQuestions();
            $testingquestion->order_id = $tradein->id;
            $testingquestion->save();
        }
        else{
            $testingquestion = TestingQuestions::where('order_id', $tradein->id)->first();
        }


        $days = 14;
        $dayToCheck = Carbon::now();
        
        if($tradein->created_at->diff($dayToCheck)->days <= $days){
            $tradein->received = true;
            $tradein->proccessed_before = true;
            $tradein->older_than_14_days = false;
            $tradein->save();
    
            return redirect()->back();
        }
        else{
            $condition = $tradein->product_state;
            $offered_price = $tradein->ordered_price;
            $product_id = $tradein->product_id;

            $product = SellingProduct::where('id', $product_id)->first();

            if($condition == "New"){
                if($product->product_selling_price_1 >= $offered_price){
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = false;
                    $tradein->save();
            
                    return redirect()->back();
                }
                else{
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = true;
                    $tradein->save();
            
                    return redirect()->back();
                }
            }
            if($condition == "Good"){
                if($product->product_selling_price_2 >= $offered_price){
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = false;
                    $tradein->save();
            
                    return redirect()->back();
                }
                else{
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = true;
                    $tradein->save();
            
                    return redirect()->back();
                }
            }
            if($condition == "Faulty"){
                if($product->product_selling_price_1 >= $offered_price){
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = false;
                    $tradein->save();
            
                    return redirect()->back();
                }
                else{
                    $tradein->received = true;
                    $tradein->proccessed_before = true;
                    $tradein->older_than_14_days = true;
                    $tradein->save();
            
                    return redirect()->back();
                }
            }
            
        }

        


    }

    public function isDeviceMissing(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->missing == "present"){
            $tradein->device_missing = false;
        }
        else if($request->missing == "missing"){
            $tradein->device_missing = true;
        }

        if($tradein->device_missing){
            $tradein->marked_for_quarantine = true;
        }

        $tradein->save();
        return redirect()->back();
    }

    public function isDeviceCorrect(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->correct_device == "yes"){
            $tradein->device_correct = true;
        }
        else if($request->correct_device == "no"){
            $tradein->device_correct = false;
        }

        $tradein->save();
        return redirect()->back();
    }

    public function deviceImeiVisibility(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        if($request->visible_imei == "yes"){
            $tradein->visible_imei = true;
        }
        else{
            $tradein->visible_imei = false;
            $tradein->marked_as_risk = true;
        }

        $tradein->save();

        return redirect()->back();
    }

    public function checkimei(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $imei_number = $request->imei_number;

        $imei_number = 123456123456123;

        $url = 'https://gapi.checkmend.com/duediligence/' . 1 . '/' . $imei_number;

        $options_array  = false;
        $response_config_array  = false;

        $options['category']  = 0;
        $options['reason_data'] = false;
        $options['make_model'] 	  = true;
        $options['cdma_validate'] = true;

        if($options)
        {
            if(isset($options['test_mode']))
            {
                $options_array['testmode']	=  ($options['test_mode'] ? $options['test_mode'] : 0);
            }
            if(isset($options['category']))
            {
                $options_array['category'] =  ($options['category']);
            }

            if(isset($options['reason_data']))
            {
                $options_array['responseconfig']['reasondata'] = ($options['reason_data'] ? 'true' : 'false' );
            }
            if(isset($options['cdma_validate']))
            {
                $options_array['responseconfig']['cdmavalidate'] =  ($options['cdma_validate'] ? 'true' : 'false' );
            }
            if(isset($options['make_model']))
            {
                $options_array['responseconfig']['makemodel'] =  ($options['make_model'] ? 'true' : 'false' );
            }
        }

        $request_body = json_encode($options_array);

        $result =  $this->send_request($url, $request_body);

        $result = (json_decode($result['result_json']));

        $result_data = "";

        $result_status = $result->result;
        $result_data = $result->reasondata;

        if($result_status === "passed"){
            $tradein->marked_for_quarantine = false;
            $tradein->chekmend_passed = true;
        }
        else if($result_status === "failed"){
            $tradein->marked_as_risk = true;
            $tradein->marked_for_quarantine = true;
        }
        else if($result_status === "caution"){
            $tradein->marked_as_risk = true;
            $tradein->marked_for_quarantine = true;
        }


        $tradein->save();

        #('Imei_check_data', $result_data);

        return redirect()->back();

    }

    private function send_request($url, $request_body, $options = false){
        $ws = new browser_ckmd();

        // Login Details
        $username  			  = 545;
        $signature_hash = sha1("de8beafe711efb004f0d" . $request_body);

        // Create Authorisation header
        $authorisation_header = base64_encode(545 . ':' . $signature_hash);
        $content_length = strlen($request_body);

        $ws->connect();

        curl_setopt($ws->connection, CURLOPT_HTTPHEADER,  array('Authorization: Basic ' . $authorisation_header,'Accept: application/json','Content-type: application/json', 'Content-length:' .$content_length) 	);
        curl_setopt($ws->connection, CURLOPT_URL, $url);
        curl_setopt($ws->connection, CURLOPT_TIMEOUT, 5);
        curl_setopt($ws->connection, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ws->connection, CURLOPT_HEADER, false); // Do not return headers
        curl_setopt($ws->connection, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ws->connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ws->connection, CURLOPT_FOLLOWLOCATION, true);

        set_time_limit(20);

        $result['result_json']  = curl_exec($ws->connection);

        $ws->error_number  = curl_errno($ws->connection);
        $ws->error_message = curl_error($ws->connection);

        if($ws->error_number)
        {
            $result['error_number'] = $ws->error_number;
        }
        if($ws->error_message)
        {
            $result['error_message'] = $ws->error_message;
        }


        // Has to be last
        $ws->disconnect();

        return $result;
    }


    public function checkDeviceStatus(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $testingQuestions = new TestingQuestions();
        $testingQuestions->order_id = $tradein->id;

        if($request->fake_missing_parts === "true"){
            $testingQuestions->fake_missing_parts = true;
            $tradein->marked_for_quarantine = true;
        }
        else{
            $testingQuestions->fake_missing_parts = false;
        }

        if($request->device_fully_functional === "false"){
            $testingQuestions->device_fully_functional = false;
            $tradein->marked_for_quarantine = true;
        }
        else{
            $testingQuestions->device_fully_functional = true;
        }

        if($request->water_damage === "true"){
            $testingQuestions->signs_of_water_damage = true;
            $tradein->marked_for_quarantine = true;
        }
        else{
            $testingQuestions->signs_of_water_damage = false;
        }

        if($request->fimp_or_google_lock === "true"){
            $testingQuestions->FIMP_Google_lock = true;
            $tradein->marked_for_quarantine = true;
        }
        else{
            $testingQuestions->FIMP_Google_lock = false;
        }

        if($request->pin_lock === "true"){
            $testingQuestions->pin_lock = true;
            $tradein->marked_for_quarantine = true;
        }
        else{
            $testingQuestions->pin_lock = false;
        }

        $testingQuestions->cosmetic_condition = $request->device_cosmetic_connection;

        $testingQuestions->save();
        $tradein->save();

        return redirect()->back();
        
    }

    public function printNewLabel(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();

        $tradein->job_state = 4;


        $newBarcode = "";

        $sellingProduct = SellingProduct::where('id', $tradein->product_id)->first();
        $brands = Brand::all();

        if($tradein->marked_for_quarantine == true){
            $newBarcode .= "90";

            $quarantine = new Quarantine();


        }
        else{
            foreach($brands as $brand){
                if($sellingProduct->brand_id == $brand->id){
                    if($brand->id < 10){
                        $newBarcode .= $tradein->job_state . "0" . $brand->id;
                        $newBarcode .= mt_rand(10000, 99999);
                    }
                    else{
                        $newBarcode .= $tradein->job_state . $brand->id;
                        mt_rand(10000, 99999);
                    }
                }
            }
        }

        $tradein->barcode = $newBarcode;
        $tradein->save();



        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');

        $this->generateNewLabel($barcode, $sellingProduct, $tradein);

    }

    public function generateNewLabel($barcode,$product, $tradein){
        $html = "";
        $html .= "<style>body{display:flex; justify-content:center; align-items:center; height:100%; widht:100%;} p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<body>";
        $html .=    "<div style='clear:both; position:relative; display:flex; justify-content:center; align-items:center;'>
                        <div style='width:190pt; height:150px;' >
                            <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $tradein->barcode ."</p></div>
                        </div>
                    </div>";
        $html .= "</body>";
        #echo $html;
        #die();

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a6', 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function sendtotray(Request $request){
        $tradein = Tradein::where('id', $request->tradein_id)->first();
        
        $tradein->job_state = 5;
        $tradein->save();
        return redirect('/portal/testing/');
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

        return view('portal.payments.awaiting')->with('portalUser', $portalUser);
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
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            $products = BuyingProduct::all();
        }
        else if($export_feed_parameter == 2){
            $columns = Schema::getColumnListing('selling_products'); 
            //16
            $products = SellingProduct::all();
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P'];
        }
        
        $filename = "/feed_type_".$export_feed_parameter."[" . date("Y-m-d") ."_". date("h-i-s") . "].xlsx";

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        for($i=0; $i<count($datarows); $i++){
            $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);
        }

        foreach($products as $key=>$product){
            $product = array_values($product->toArray());
            
            for($i=0; $i<count($datarows); $i++){
                $sheet->setCellValue($datarows[$i] . ($key+2), $product[$i]);
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
            return redirect('/portal/feeds/export-import');
        }
    }

    public function feedsImport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $products = "";

        if($export_feed_parameter == 1){
            $products = BuyingProduct::all();
        }
        else if($export_feed_parameter == 2){
            $products = SellingProduct::all();
        }

        foreach($products as $product){
            $product->delete();
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

        unset($importeddata[0]);

        foreach($importeddata as $key=>$datarow){

            $message="";

            if($export_feed_parameter == 1){
                $product = new BuyingProduct();

                $product->product_name = $datarow[1];
                $product->product_image = $datarow[2];
                $product->product_description = $datarow[3];
                $product->category_id = $datarow[4];
                $product->brand_id = $datarow[5];
                $product->product_network = $datarow[6];
                $product->product_memory = $datarow[7];
                $product->product_colour = $datarow[8];
                $product->product_grade = $datarow[9];
                $product->product_dimensions = $datarow[10];
                $product->product_processor = $datarow[11];
                $product->product_weight = $datarow[12];
                $product->product_screen = $datarow[13];
                $product->product_system = $datarow[14];
                $product->product_connectivity = $datarow[15];
                $product->product_battery = $datarow[16];
                $product->product_signal = $datarow[17];
                $product->product_camera = $datarow[18];
                $product->product_camera_2 = $datarow[19];
                $product->product_sim = $datarow[20];
                $product->product_memory_slots = $datarow[21];
                $product->product_quantity = $datarow[22];
                $product->product_buying_price = $datarow[23];
    
                $product->save();
    
                $category = Category::where('id', $datarow[4])->get()[0];
                $category->total_produts = $category->total_produts+1;
                $category->save();
        
                $brand = Brand::where('id', $datarow[5])->get()[0];
                $brand->total_produts = $brand->total_produts + 1;
                $brand->save();

                $feed = new Feed();
                $feed->feed_type = "All buying devices";
                $feed->status = "Done";
                $feed->save();
            }
            else if($export_feed_parameter == 2){
                $product = new SellingProduct();
                
                $product->product_name = $datarow[1];
                $product->product_image = $datarow[2];
                $product->category_id = $datarow[3];
                $product->brand_id = $datarow[4];
                $product->product_memory = $datarow[5];
                $product->product_colour = $datarow[6];
                $product->product_network = $datarow[7];
                $product->product_grade_1 = $datarow[8];
                $product->product_grade_2 = $datarow[9];
                $product->product_grade_3 = $datarow[10];
                $product->product_selling_price_1 = $datarow[11];
                $product->product_selling_price_2 = $datarow[12];
                $product->product_selling_price_3 = $datarow[13];
    
                $product->save();
            }

        }

        return \redirect('/portal/feeds/export-import');
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
        if($request->customer_care == "on"){
            $portalUser->customer_care = true;
        }
        if($request->categories == "on"){
            $portalUser->categories = true;
        }
        if($request->product == "on"){
            $portalUser->product = true;
        }
        if($request->quarantine == "on"){
            $portalUser->quarantine = true;
        }
        if($request->testing == "on"){
            $portalUser->testing = true;
        }
        if($request->payments == "on"){
            $portalUser->payments = true;
        }
        if($request->reports == "on"){
            $portalUser->reports = true;
        }
        if($request->feeds == "on"){
            $portalUser->feeds = true;
        }
        if($request->users == "on"){
            $portalUser->users = true;
        }
        if($request->settings == "on"){
            $portalUser->settings = true;
        }
        if($request->cms == "on"){
            $portalUser->cms = true;
        }
        if($request->trays == "on"){
            $portalUser->trays = true;
        }
        if($request->trolleys == "on"){
            $portalUser->trolleys = true;
        }
        if($request->boxes == "boxes"){
            $portalUser->cms = true;
        }

        $portalUser->save();

        return \redirect('/portal/user');
    }

    public function searchUser(Request $request){
        $user = null;
        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        if($request->select_search_by_field == 1){
            $user = User::where('id', $request->searchname)->where($match)->get();
            $user = $user[0];
        }
        else if($request->select_search_by_field == 2){
            $user = User::where('first_name', $request->searchname)->where($match)->get();
            $user = $user[0];
        }
        return view('portal.users.adduser')->with('userdata', $user)->with('title', "Search result: ".$user->first_name);
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
        return redirect('/portal/settings/websites')->with('portalUser', $portalUser);
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

        $tray = new Tray();

        $tray->tray_name = $request->tray_name;

        $tray->save();

        return redirect('/portal/trays');
    }

    public function showTrayPage(Request $request){
        $trayid = $request->tray_id_scan;

        $tray = Tray::where('id', $trayid)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $trolleys = Trolley::all();

        return view('portal.trays.tray')->with(['portalUser'=>$portalUser, 'tray'=>$tray, 'trolleys'=>$trolleys]);
    }

    public function printTrayLabel($id){

        $barcode = DNS1D::getBarcodeHTML($id, 'C128');

        $this->generateTrayLabel($barcode, $id);
    }

    public function generateTrayLabel($barcode, $id){
        $html = "";
        $html .= "<style>body{display:flex; justify-content:center; align-items:center; height:100%; widht:100%;} p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<body>";
        $html .=    "<div style='clear:both; position:relative; display:flex; justify-content:center; align-items:center;'>
                        <div style='width:190pt; height:150px;' >
                            <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $id ."</p></div>
                        </div>
                    </div>";
        $html .= "</body>";
        #echo $html;
        #die();

        $filename = "labeltray-" . $id . ".pdf";
        PDF::loadHTML($html)->setPaper('a6', 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function addTrayToTrolley(Request $request){

        $tray = Tray::where('id', $request->tray_id)->first();

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



        return redirect()->back();
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
        $html = "";
        $html .= "<style>body{display:flex; justify-content:center; align-items:center; height:100%; widht:100%;} p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<body>";
        $html .=    "<div style='clear:both; position:relative; display:flex; justify-content:center; align-items:center;'>
                        <div style='width:190pt; height:150px;' >
                            <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcode ."</div><p>" .  $id ."</p></div>
                        </div>
                    </div>";
        $html .= "</body>";
        #echo $html;
        #die();

        $filename = "labeltrolley-" . $id . ".pdf";
        PDF::loadHTML($html)->setPaper('a6', 'landscape')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
        
    }

    public function addTrolley(Request $request){

        $trolley = new Trolley();

        $trolley->trolley_name = $request->trolley_name;
        $trolley->trolley_type = $request->trolley_type;

        $trolley->save();

        return redirect('/portal/trolleys');
    }

    //boxes

    public function showBoxesPage(){
        if(!$this->checkAuthLevel(14)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.boxes.boxes')->with('portalUser', $portalUser);
    }


    //Auth Level

    public function checkAuthLevel($data){
        $user = Auth::user();
        $userid = $user->id;
        $portaluser = PortalUsers::where('user_id', $userid)->first();

        switch($data){
            
            case 1:
                return $portaluser->customer_care;
            break;

            case 2:
                return $portaluser->categories;
            break;

            case 3:
                return $portaluser->product;
            break;

            case 4:
                return $portaluser->quarantine;
            break;

            case 5:
                return $portaluser->testing;
            break;

            case 6:
                return $portaluser->payments;
            break;

            case 7:
                return $portaluser->reports;
            break;

            case 8:
                return $portaluser->feeds;
            break;

            case 9:
                return $portaluser->users;
            break;

            case 10:
                return $portaluser->settings;
            break;

            case 11:
                return $portaluser->cms;
            break;

            case 12:
                return $portaluser->trays;
            break;

            case 13:
                return $portaluser->trolleys;
            break;

            case 14:
                return $portaluser->boxes;
            break;

            default:
                return true;
            break;
        }


    }


}

class browser_ckmd
{
    var $connection;

    function connect()
    {
        $this->connection = curl_init();
    }

    function disconnect()
    {
        curl_close($this->connection);
    }
}