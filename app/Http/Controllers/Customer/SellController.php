<?php

namespace App\Http\Controllers\Customer;

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
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

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
        return view('sell.welcome')->with('products', $products);;
    }

    public function showSellWhy(){
        $products = BuyingProduct::all();
        return view('sell.why')->with('products', $products);
    }


    public function showSellShop(Request $request, $parameter){
        
        #dd($request->all(), $parameter);

        $brands = Brand::all();

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

        if($page == 1){
            $start = 1;
        }
        else{
            $start = $page * $number - $number;
        }

        $products = "";
        $numberofproducts = 0;

        $message = "";

        switch($parameter){
            case "mobile":
                if(isset($request->brand)){
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->where('brand_id', $request->brand)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }else{
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }
            case "tablets":
                if(isset($request->brand)){
                    $products = SellingProduct::where('category_id', 2)->where('id', '>=', $start)->where('brand_id', $request->brand)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 2)->get());
                    break;
                }else{
                    $products = SellingProduct::where('category_id', 2)->where('id', '>=', $start)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 2)->get());
                    break;
                }
            break;
            case "watches":
                if(isset($request->brand)){
                    $products = SellingProduct::where('category_id', 3)->where('id', '>=', $start)->where('brand_id', $request->brand)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 3)->get());
                    break;
                }else{
                    $products = SellingProduct::where('category_id', 3)->where('id', '>=', $start)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 3)->get());
                    break;
                }
            break;
            default:
                $products = SellingProduct::where('product_name', 'LIKE', '%'.$parameter.'%')->take($number)->get();
                $numberofproducts = count($products);
                break;
        }

        $numberofpages = $numberofproducts/$number;
        $numberofpages = ceil($numberofpages);
        $pages = array();

        for($i = 1; $i<=$numberofpages; $i++){
            array_push($pages, $i);
        }

        return view('sell.shop')->with(['products' => $products, 'pages'=>$pages, 'currentpage'=>$page, 'category'=>$parameter])->with(['brands'=>$brands]);
    }

    public function showSellItem($id){
        
        $product = SellingProduct::where('id', $id)->first();

        $sellingProductInformation = ProductInformation::where('product_id', $id)->get();
        $productNetworks = ProductNetworks::where('product_id', $id)->get();

        $products = SellingProduct::all();
        return view('sell.item')->with(['product'=>$product, 'products'=>$products, 'productInformation'=>$sellingProductInformation, 'networks'=>$productNetworks]);

    }
    
    public function searchAvalibleProducts(Request $request){

        $searchParameter = $request->search_argument;
        
        return redirect('/sell/shop/' . $searchParameter);
    }

    public function addSellItemToCart(Request $request){

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

    }

    public function sellItems(Request $request){

        if(Auth::user()){
            $labelstatus = $request->label_status;
            $items = array();

            //8
            $tradeinbarcode = 10000000 + rand(100000, 9000000);

            $cart = Cart::where('user_id', Auth::user()->id)->where('type', 'tradein')->get();

            $tradeinexp = null;

            $name = "";
            $price = "";

            $barcode = "";

            foreach($cart as $item){     
                if($item->type === 'tradein'){

                    $tradein = new Tradein();
                    $tradein->barcode = $tradeinbarcode;
                    $tradein->barcode_original = $tradeinbarcode;
                    $tradein->user_id = Auth::user()->id;
                    $tradein->product_id = $item->product_id;
                    $tradein->order_price = $item->price;
                    $tradein->job_state = 1;

                    $name = $item->getProductName($item->id);

                    $tradein->product_state = $item->grade;
                    $tradein->network = $item->network;
                    $tradein->memory = $item->memory;

                    if($labelstatus == "2"){
                        $tradein->job_state = 2;
                        $tradein->sent_themselves = true;
                    }

                    $tradein->save();
                    $tradeinexp = $tradein;

                    $item->delete();

                    $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
                    $event = new KlaviyoEvent(
                        array(
                            'event' => 'Item Sold',
                            'customer_properties' => array(
                                '$email' => Auth::user()->email,
                                '$name' => Auth::user()->first_name,
                                '$last_name' => Auth::user()->last_name,
                                '$birthdate' => Auth::user()->birthdate,
                                '$newsletter' => Auth::user()->email,
                                '$products' => $name,
                                '$price'=> $price
                            ),
                            'properties' => array(
                                'Item Sold' => True
                            )
                        )
                    );
            
                    $client->publicAPI->track( $event );  

                }
            }


            if($labelstatus == "2"){

                return redirect()->back()->with(['success'=>'Your sell has been completed. Please print this tradepack and follow the instrunctions.', 'barcode'=>$barcode, 'tradein'=>$tradein]);

                $user = Auth::user();
                $barcode = DNS1D::getBarcodeHTML($tradeinbarcode, 'C128');
                $this->generateTradeInHTML($barcode, $user, null, $tradeinexp);
            }
            
            return redirect()->back()->with('success', 'Your sell has been completed.');
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
    
            $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Item Bought',
                    'customer_properties' => array(
                        '$email' => Auth::user()->email,
                        '$name' => Auth::user()->first_name,
                        '$last_name' => Auth::user()->last_name,
                        '$birthdate' => Auth::user()->birthdate,
                        '$newsletter' => Auth::user()->email,
                        '$products' => $tradeout->getDeviceName($tradeout->product_id),
                        '$price'=> $request->price
                    ),
                    'properties' => array(
                        'Item Bought' => True
                    )
                )
            );
    
            $client->publicAPI->track( $event );  
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
}