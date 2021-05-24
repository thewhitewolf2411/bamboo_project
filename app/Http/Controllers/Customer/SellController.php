<?php

namespace App\Http\Controllers\Customer;

use App\Eloquent\AbandonedCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;
use App\Eloquent\Cart;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use App\Eloquent\Colour;
use App\Eloquent\Memory;
use App\Eloquent\Network;
use App\Eloquent\Brand;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;
use Storage;
use Session;
use DNS1D;
use DNS2D;
use PDF;
use App\Services\KlaviyoEmail;
use App\Services\ExpiryDate;
use App\Eloquent\AdditionalCosts;
use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\PromotionalCode;
use App\Eloquent\UserPromotionalCode;
use App\Services\NotificationService;
use App\Services\Sorting;
use App\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;

class SellController extends Controller
{

    protected $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(Auth::user()){
                $this->user = Auth::user();

                if($this->user->type_of_user > 0){
                    return redirect('/portal');
                }

            }
            return $next($request);
        });
    }

    public function showSellView(){


        $products = BuyingProduct::all();
        $brands = Brand::all();
        return view('sell.welcome', ['products'=>$products, 'recycleBasket'=>true , 'brands' => $brands]);
    }

    public function showSellWhy(){
        $products = BuyingProduct::all();
        return view('sell.why')->with(['products'=>$products, 'recycleBasket'=>true]);
    }


    public function showSellShop(Request $request, $parameter, $resultstype){
        $onlyTopResults = false;
        if($resultstype === 'topresults'){
            $onlyTopResults = true;
        }
        if($resultstype === 'all'){
            $onlyTopResults = false;
        }
        #dd($request->all(), $parameter);

        $brands = Brand::all();

        if(isset($request->page)){
            $page = $request->page;
        }
        else{
            $page = 1;
        }

        $products = "";
        $canSeeMore = false;

        switch($parameter){
            case "mobile":
                $sorting = new Sorting(null, 1);
                $products = $sorting->sortDevices();
                break;
            case "tablets":
                $sorting = new Sorting(null, 2);
                $products = $sorting->sortDevices();
                break;
            case "watches":
                $sorting = new Sorting(null, 3);
                $products = $sorting->sortDevices();
                break;
            default:
                break;
        }

        $page = isset($request->page) ? $request->page : 1;
        $perPage = 24;

        $path = url('/sell/shop/'.$parameter);
        if(!$onlyTopResults && !$canSeeMore){
            $path = null;
        } else {
            $path = null;
            //dd($onlyTopResults, $canSeeMore);
        }

        $paginated = new LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => $path]
        );
        
        return view('sell.shop', [
                'products' => $paginated, 
                //'pages'=>$pages, 
                'currentpage'=>$page, 
                'category'=>$parameter, 
                'recycleBasket'=>true, 
                'brands'=>$brands,
                'parameter' => $parameter,
                'topResults' => $onlyTopResults,
                'canSeeMore' => $canSeeMore
            ]
        );
    }

    /**
     * Show all devices by category and brand.
     */
    public function showBrandCategoryResults(Request $request, $category, $brand){
        
        $number = 0;
        $page = 1;
        $start = null;

        if(isset($request->number)){
            $number = $request->number;
        }
        else{
            $number = 24;
        }
        if(isset($request->page)){
            $page = $request->page;
        }
        else{
            $page = 1;
        }

        $start = ($page * $number) - $number;

        $products = "";
        $numberofproducts = 0;
        $canSeeMore = false;

        $message = "";
        $brandName = Brand::find($brand)->brand_name;

        switch($category){
            case "mobile":
                $sorting = new Sorting($brand, 1);
                $products = $sorting->sortDevices();
            break;
            case "tablets":
                $sorting = new Sorting($brand, 2);
                $products = $sorting->sortDevices();
            break;
            case "watches":
                $sorting = new Sorting($brand, 3);
                $products = $sorting->sortDevices();
            break;
            default:

            break;
        }

        $page = isset($request->page) ? $request->page : 1;
        $perPage = 24;

        $paginated = new LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => url('/sell/devices/' . $category . '/'.$brand)]
        );
        
        return view('sell.alldevicesbrand', [
                'products' => $paginated, 
                'currentpage'=>$page, 
                'recycleBasket'=>true,
                'brand'=>$brand,
                'brandname'=>$brandName,
                'category'=>$category,
            ]
        );
    }

    public function showSellItem($id){
        
        $product = SellingProduct::where('id', $id)->first();

        $sellingProductInformation = ProductInformation::where('product_id', $id)->get();
        $productNetworks = ProductNetworks::where('product_id', $id)->get();

        $products = SellingProduct::all();
        return view('sell.item', ['product'=>$product, 'products'=>$products, 'productInformation'=>$sellingProductInformation, 'networks'=>$productNetworks, 'recycleBasket'=>true]);

    }
    
    public function searchAvalibleProducts(Request $request){
        $searchParameter = $request->search_argument;

        if(isset($request->topresults)){
            $topresults = ($request->topresults === "true") ? true : false;
            if($topresults){
                return redirect('/sell/shop/' . $searchParameter . '/topresults');
            } 
            return redirect('/sell/shop/' . $searchParameter . '/all');
        } else {
            return redirect('/sell/shop/' . $searchParameter . '/all');
        }
    }


    /**
     * Search available devices for selling.
     * @param Request $request
     */
    public function searchAllSellDevices(Request $request){
        if(isset($request->term)){
            // avoid sql injection
            $trimmed = preg_replace("/[^A-Za-z0-9 ]/", '', $request->term);
            if($trimmed !== ""){
                $searchterm = $trimmed;
                $devices = SellingProduct::where('product_name', 'LIKE', "%{$searchterm}%")->get()->take(10);

                // if matching results
                if($devices->count() > 0){
                    return response($devices, 200);
                } else {
                    return response([], 200);
                }
            }
            
        }
    }

    /**
     * Return all devices by brand id.
     * @param string $brand_id
     */
    public function getDevicesByBrand($brand_id, $category_id){
        $devices = SellingProduct::where('brand_id', $brand_id)->where('category_id', $category_id)->take(4)->get();
        return response($devices, 200);
    }


    /**
     * Add item to cart / abandoned basked
     * @param Request $request
     */
    public function addSellItemToCart(Request $request){

        if(Auth::user()){
            $userid = Auth::user()->id;
            $productid = $request->productid;
            $grade = $request->grade;
            $network = $request->network;
            $memory = $request->memory;
            $price = $request->price;
            $type = $request->type;
    
            $cart = new Cart();
    
            $cart->user_id = $userid;
            $cart->price = $price;
            $cart->product_id = $productid;
            $cart->type = $type;
            $cart->network = $network;
            $cart->memory = $memory;
            $cart->grade = $grade;
            $cart->save();

            return redirect()->back()->with('productaddedtocart', true);
        } else {
            if($request->has('email')){

                $userExists = User::where('email', $request->email)->first();
                if($userExists){
                    return redirect()->back()->with('useralreadyexists', true);
                }

                $abandoned_cart = new AbandonedCart([
                    'user_email'    => $request->email,
                    'price'         => $request->price,
                    'product_id'    => $request->productid,
                    'type'          => $request->type,
                    'memory'        => $request->memory,
                    'grade'         => $request->grade,
                ]);

                if(!$request->session()->has('session_email')){
                    $request->session()->put('session_email', $request->email);
                }

                $abandoned_cart->save();
                return redirect()->back()->with('productaddedtocart', true);
            }
        }
        
        


    }

    public function sellItems(Request $request){

        if(Auth::user()){
            // get label status
            $labelstatus = $request->label_status;
            // tradein null by default
            $tradein = null;

            // if bank details present, store them
            if(isset($request->account_name) && isset($request->account_number) && isset($request->sort_code_1) && isset($request->sort_code_2) && isset($request->sort_code_3)){
                
                $bank_details = UserBankDetails::where('user_id', Auth::user()->id)->get();

                $data = $request->except('token');
                $validation_fails = [];
                if(strlen($data['account_name']) < 5){
                    array_push($validation_fails, 'Please enter valid account name.');
                }
                if(!is_numeric($data['account_number'])){
                    array_push($validation_fails, 'Account number must be numeric.');
        
                    if(strlen($data['account_number']) !== 8){
                        array_push($validation_fails, 'Account number must be 8 digits.');
                    }
                }
        
                if(!is_numeric($data['sort_code_1']) || !is_numeric($data['sort_code_2']) || !is_numeric($data['sort_code_3'])){
                    array_push($validation_fails, 'Sort code must be a number.');
                } else {
                    if((strlen($data['sort_code_1']) !== 2) || (strlen($data['sort_code_2']) !== 2) || (strlen($data['sort_code_3']) !== 2)){
                        array_push($validation_fails, 'Sort code must be 6 digits, 2 per field.');
                    }
                }
                
                if(empty($validation_fails)){
                    if($bank_details->isEmpty()){
        
                        // create new
                        UserBankDetails::create([
                            'user_id' => Auth::user()->id,
                            'account_name' => Crypt::encrypt($request->account_name),
                            'card_number' => Crypt::encrypt($request->account_number),
                            'sort_code' => Crypt::encrypt($request->sort_code_1 . $request->sort_code_2 . $request->sort_code_3)
                        ]);
                    }
                } else {
                    return redirect()->back()->with('bank_details_error', $validation_fails);
                }
            }

            //8
            // generate tradein barcode
            $tradeinbarcode = 10000000 + rand(000000, 9000000);

            $cart = Cart::where('user_id', Auth::user()->id)->where('type', 'tradein')->get();
            $tradeinexp = null;
            $name = "";
            $price = "";
            $barcode = "";

            while(count(Tradein::where('barcode_original', $tradeinbarcode)->get())>0){
                $tradeinbarcode = 10000000 + rand(000000, 9000000);
            }

            foreach($cart as $item){     
                if($item->type === 'tradein'){

                    $order_price = $item->price;
                    $hasPromotionalCode = false;
                    $promoCodeId = null;
                    if(isset($request->promotional_code)){
                        //dd('sellcontroller 498 [tradein order price] - calculate price with promotional code price evaluation todo');
                        $promotionalCode = PromotionalCode::where('promotional_code', $request->promotional_code)->first();
                        if($promotionalCode){
                            $hasPromotionalCode = true;
                            $promoCodeId = $promotionalCode->id;
                        }
                        $price = $item->price;
                        if(strlen($promotionalCode->value) === 1){
                            $perc = '0.0'.$promotionalCode->value;
                        }
                        if(strlen($promotionalCode->value) === 2){
                            $perc = '0.'.$promotionalCode->value;
                        }
                        if(strlen($promotionalCode->value) === 3){
                            $perc = 1;
                        }
                        $order_price = (float)$perc * $price + $price;
                    }

                    $expiryDate = new ExpiryDate();
                    $eD = $expiryDate->getExpiryDate();
                    $tradein = new Tradein();
                    $tradein->barcode = $tradeinbarcode;
                    $tradein->barcode_original = $tradeinbarcode;
                    $tradein->user_id = Auth::user()->id;
                    $tradein->product_id = $item->product_id;
                    // $tradein->order_price = $item->price;
                    $tradein->order_price = $order_price;
                    $tradein->job_state = 1;
                    if($labelstatus === '2'){
                        $tradein->trade_pack_send_by_customer = true;
                    } else {
                        $tradein->trade_pack_send_by_customer = false;
                    }
                    $tradein->expiry_date = $eD;

                    $name = $item->getProductName($item->id);

                    $tradein->customer_grade = $item->grade;
                    $tradein->customer_network = $item->network;
                    $tradein->customer_memory = $item->memory;

                    if($labelstatus == "2"){
                        $tradein->job_state = 2;

                        $tradein->trade_pack_send_by_customer = true;
                        $klaviyoEmail = new KlaviyoEmail();
                        $klaviyoEmail->ItemSoldPrintOwnLabel(Auth::user(), $tradein);
                    }
                    else{
                        $klaviyoEmail = new KlaviyoEmail();
                        $klaviyoEmail->ItemSoldTradePack(Auth::user(), $tradein);
                    }

                    #$additionalCosts = AdditionalCosts::first();
                    #$tradein->carriage_cost = $additionalCosts->carriage_costs;
                    #$tradein->admin_cost = $additionalCosts->administration_costs;

                    $tradein->save();
                    $tradeinexp = $tradein;

                    if($hasPromotionalCode){
                        UserPromotionalCode::create([
                            'user_id' => $tradein->user_id,
                            'promotional_code_id' => $promoCodeId,
                            'trade_in_id' => $tradein->id
                        ]);
                    }

                    if($labelstatus == "2"){
                        // send notification - own label
                        $notificationService = new NotificationService();
                        $notificationService->send(Auth::user(), 4, $tradein);
                    } else {
                        // send notification - trade pack
                        $notificationService = new NotificationService();
                        $notificationService->send(Auth::user(), 5, $tradein);
                    }

                    $item->delete();

                }
            }

            // redirect to basket to prevent error
            if(!$tradein){
                return redirect()->route('showcart');
            }

            if($labelstatus == "2"){

                return view('customer.confirmation')->with(['success'=>'Your sell has been completed. Please print this tradepack and follow the instrunctions.', 'barcode'=>$barcode, 'tradein'=>$tradein]);
                //return redirect()->back()->with(['success'=>'Your sell has been completed. Please print this tradepack and follow the instrunctions.', 'barcode'=>$barcode, 'tradein'=>$tradein]);

                $user = Auth::user();
                $barcode = DNS1D::getBarcodeHTML($tradeinbarcode, 'C128');
                $this->generateTradeInHTML($barcode, $user, null, $tradeinexp);
            }
            return view('customer.confirmation')->with(['success' => 'Your sell has been completed.', 'tradein' => $tradein]);
            //return redirect()->back()->with('success', 'Your sell has been completed.');
        }
        else{
            $showLogin = true;
            return redirect('/cart')->with('showLogin', $showLogin);
        }
      
    }

    public function buyItems(Request $request){

        $cart = Cart::where('user_id', Auth::user()->id)->where('type', 'tradeout')->get();

        foreach($cart as $item){
            $tradeout = new Tradeout();
            $tradeout->user_id = Auth::user()->id;
            $tradeout->product_id = $item->product_id;
            $tradeout->order_state = 0;
            $tradeout->save();

            $item->delete();
        }

        return redirect()->back()->with('success', 'Your shoping has been completed.');

    }

    public function generateTradeInHTML(Request $request){

        #dd($request->user['first_name']);
        #dd($request->all());

        $name = $request->user['first_name'] . " " . $request->user['last_name'];
        $address = $request->user['delivery_address'];
        $barcode = $request->tradein['barcode'];
        $created_at = $request->tradein['updated_at'];
        $barcodeimage = DNS1D::getBarcodeHTML($barcode, 'C128');

        $delAdress = strtr($address, array(', '=>'<br>'));

        $html = "";
        $html .= "<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<p>" . $name . ",</p>";
        $html .= "<p>". $delAdress .",</p>";
        $html .= "<br><br>";
        $html .= "<p>Order#". $barcode . " Date: " . $created_at .  "</p>";
        $html .= "<p>Dear " . $name . ",</p>";
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
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
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
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
                        </div>
                    </div>";
        #echo $html;
        #die();

        $filename = "labeltradeout-" . $barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        return response(['code'=>200, 'filename'=>$filename]);

        #$this->downloadFile($filename);
    }

    /**
     * Verify & apply promo code (if valid)
     */
    public function checkPromoCode(Request $request){
        if(isset($request->promo_code)){
            $code = $request->promo_code;
            $promotionalCode = PromotionalCode::where('promotional_code', $code)->first();
            if($promotionalCode){
                $applies_to = json_decode($promotionalCode->apply_rules, true);
                if(isset($applies_to['device_id'])){
                    $current_items = Cart::where('user_id', Auth::user()->id)->get();

                    // prevent promocode reuse
                    $userPromotionalCodes = UserPromotionalCode::where('user_id', Auth::user()->id)->get();
                    if($userPromotionalCodes){
                        $used_ids = $userPromotionalCodes->pluck('id')->toArray();
                        if(in_array($promotionalCode->id, $used_ids)){
                            $data = [
                                'message' => 'Promotional code "'.$promotionalCode->name.'" already used.', 
                                'pass' => false
                            ];
                            return response(['data' => $data ], 200);
                        }
                    }

                    // check apply rules (only for one device for now)
                    $device_ids = $current_items->pluck('product_id')->toArray();
                    if(in_array($applies_to['device_id'], $device_ids)){

                        $total = null;
                        $price = null;
                        foreach($current_items as $sell_item){
                            $price+= $sell_item->price;
                        }
                        if(strlen($promotionalCode->value) === 1){
                            $perc = '0.0'.$promotionalCode->value;
                        }
                        if(strlen($promotionalCode->value) === 2){
                            $perc = '0.'.$promotionalCode->value;
                        }
                        if(strlen($promotionalCode->value) === 3){
                            $perc = 1;
                        }
                        $total = (float)$perc * $price + $price;

                        $data = [
                            'message' => 'Promotional code "'.$promotionalCode->name.'" applied succesfully.', 
                            'pass' => true, 
                            'total' => $total,
                            'percentage' => (int)$promotionalCode->value.'%',
                            'total' => $total
                        ];
                        return response(['data' => $data ], 200);
                    }
                    $data = [
                        'message' => 'Promotional code not eligible for this tradein.', 
                        'pass' => false
                    ];
                    return response(['data' => $data ], 200);
                }
                $data = [
                    'message' => 'Promotional code not eligible for this tradein.', 
                    'pass' => false
                ];
                return response(['data' => $data], 200);
            } else {
                $data = [
                    'message' => 'Invalid promotional code.', 
                    'pass' => false
                ];
                return response(['data' => $data], 200);
            }
        }
    }
}
