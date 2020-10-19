<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Session;
use DNS1D;
use DNS2D;
use PDF;

class SellController extends Controller
{
    public function showSellView(){

        $products = BuyingProduct::all();
        return view('sell.welcome')->with('products', $products);;
    }

    public function showSellWhy(){
        $products = BuyingProduct::all();
        return view('sell.why')->with('products', $products);
    }


    public function showSellShop(Request $request, $parameter){
        
        #dd($request->all());

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

        #dd($start);


        $products = "";
        $numberofproducts = 0;
        #dd($parameter);

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
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->where('brand_id', $request->brand)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }else{
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }
            break;
            case "watches":
                if(isset($request->brand)){
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->where('brand_id', $request->brand)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }else{
                    $products = SellingProduct::where('category_id', 1)->where('id', '>=', $start)->take($number)->get();
                    $numberofproducts = count(SellingProduct::where('category_id', 1)->get());
                    break;
                }
            break;
            default:
            break;
        }

        $numberofpages = $numberofproducts/$number;
        $numberofpages = ceil($numberofpages);
        $pages = array();

        for($i = 1; $i<=$numberofpages; $i++){
            array_push($pages, $i);
        }

        #dd($products);

        return view('sell.shop')->with(['products' => $products, 'pages'=>$pages, 'currentpage'=>$page, 'category'=>$parameter])->with(['brands'=>$brands]);
    }

    public function showSellItem($id){
        
        $product = SellingProduct::where('id', $id)->first();

        #dd($product);

        $colors = Colour::where('brand_id', $product->brand_id)->get();
        $memories = Memory::where('brand_id', $product->brand_id)->get();
        $networks = Network::where('brand_id', $product->brand_id)->get();

        $products = SellingProduct::all();
        return view('sell.item')->with(['product'=>$product, 'products'=>$products, 'colors'=>$colors, 'memories'=>$memories, 'networks'=>$networks]);

    }
    
    public function searchAvalibleProducts(Request $request){
        dd($request);
    }

    public function addSellItemToCart(Request $request){

        #dd($request->all());

        $grade = SellingProduct::where('id', $request->productid)->first();
        $gradename = "";

        #dd($request->all());

        if($grade->customer_grade_price_1 == $request->grade){
            $grade = $grade->customer_grade_price_1;
            $gradename = "Excellent working";
        }
        else if($grade->customer_grade_price_2 == $request->grade){
            $grade = $grade->customer_grade_price_2;
            $gradename = "Good working";
        }
        else if($grade->customer_grade_price_3 == $request->grade){
            $grade = $grade->customer_grade_price_3;
            $gradename = "Poor working";
        }
        else if($grade->customer_grade_price_4 == $request->grade){
            $grade = $grade->customer_grade_price_4;
            $gradename = "Damaged working";
        }
        else if($grade->customer_grade_price_5 == $request->grade){
            $grade = $grade->customer_grade_price_5;
            $gradename = "Faulty";
        }

        #dd($grade);

        $product = SellingProduct::where('id',$request->productid)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        
        $cart->add($grade, $product, $request->type, $request->network, $request->color, $request->memory, $gradename);

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('productaddedtocart', true);

    }

    public function sellItems(Request $request){

        #dd($request->all());

        if(Auth::user()){
            $labelstatus = $request->label_status;
            $data = $request->all();
            $data = array_values($data);
            $data = array_slice($data, 1);
            $data = array_slice($data, 0, -1);


            $items = array();

            //8
            $tradeinbarcode = 10000000 + rand(100000, 9000000);

            foreach($data as $dataitem){
                $item = array();
                array_push($item, $dataitem);
                array_push($items, $item);
            }
           
            $items = array_chunk($data, 6);

            $tradeinexp = null;

            foreach($items as $item){     
                if($item[0] == 'tradein'){
                    $tradein = new Tradein();
                    $tradein->barcode = $tradeinbarcode;
                    $tradein->user_id = Auth::user()->id;
                    $tradein->product_id = json_decode($item[1])->id;
                    $tradein->order_price = $item[2];
                    $tradein->color = $item[4];
                    $tradein->network = $item[3];
                    $tradein->memory = $item[5];

                    if(json_decode($item[1])->customer_grade_price_1 == $item[2]){
                        $tradein->product_state = "Excellent working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_2 == $item[2]){
                        $tradein->product_state = "Good working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_3 == $item[2]){
                        $tradein->product_state = "Poor working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_4 == $item[2]){
                        $tradein->product_state = "Damaged working";
                    }
                    elseif(json_decode($item[1])->customer_grade_price_5 == $item[2]){
                        $tradein->product_state = "Faulty";
                    }

                    if($labelstatus == "2"){
                        $tradein->job_state = 2;
                    }

                    $tradein->save();
                    $tradeinexp = $tradein;
                }
                else if($item[0] == 'tradeout'){
                    $tradeout = new Tradeout();
                    $tradeout->user_id = Auth::user()->id;
                    $tradeout->product_id = json_decode($item[1])->id;
                    $tradeout->order_state = 0;
                    $tradeout->save();
                }
            }

            Session::forget('cart');
            Session::forget('type');

            if($labelstatus == "2"){

                $user = Auth::user();
                $barcode = DNS1D::getBarcodeHTML($tradeinbarcode, 'C128');
                $this->generateTradeInHTML($barcode, $user, null, $tradeinexp);
            }
            
            return redirect('/');
        }
        else{
            $showLogin = true;
            return redirect('/cart')->with('showLogin', $showLogin);
        }
      
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
}
