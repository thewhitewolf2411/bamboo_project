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
use App\User;
use Auth;
use Schema;
use DNS1D;
use DNS2D;
use PDF;

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
        return view('portal.customer-care.customer-care');
    }

    public function showTradeIn(){
        $tradeins = Tradein::all();
        return view('portal.customer-care.trade-in')->with('tradeins', $tradeins);
    }

    public function showTradeInDetails($id){
        $tradein = Tradein::where('id', $id)->first();
        return view('portal.customer-care.trade-in-details')->with('tradein', $tradein);
    }

    public function PrintTradeInLabel(Request $request){

        $tradein = Tradein::where('id', $request->hidden_print_trade_pack_trade_in_id)->first();
        $user = User::where('id',$tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id);

        $barcode = DNS1D::getBarcodeHTML($tradein->barcode, 'C128');
        $this->generateTradeInHTML($barcode, $user, $product, $tradein);
    }

    public function generateTradeInHTML($barcode, $user, $product, $tradein){
        $html = "";
        $html .= "<style>p{margin:0;}</style>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<br><br>";
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
        $html .= "<p>Dear" . $user->first_name . " " . $user->last_name . ",</p>";
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
        $html .=    "<div style='display:flex; justify-content: space-between;'><div style='width:30%;'>
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div style='border:1px solid black; padding:15px;'>". $barcode ."</div>
                                                </div>
                                                <div style='width:30%;'>
                                                <p>FREEPOST 555880PR</p>
                                                <p>Bamboo Recycle (9100)</p>
                                                <p>C/O Bamboo Distribution Ltd</p>
                                                <p>Unit 1, I.O Centre</p>
                                                <p>Lea Road</p>
                                                <p>Waltham Abbey</p>
                                                <p>Hertfordshire</p>
                                                <p>EN9 1AS</p>
                                                <div style='border:1px solid black; padding:15px;'>". $barcode ."</div>
                                                </div>
                    </div>";
                    #echo $html;
                    #dd();

        $filename = "labeltradeout-" . $tradein->barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        $this->downloadFile($filename);
    }

    public function showTradeOut(){
        $tradeouts = Tradeout::all();
        return view('portal.customer-care.trade-out')->with('tradeouts', $tradeouts);
    }

    public function showTradeOutDetails($id){
        $tradeout = Tradeout::where('id', $id)->first();
        return view('portal.customer-care.trade-out-details')->with('tradeout', $tradeout);
    }

    public function showDestroyDevice(){
        return view('portal.customer-care.destroy');
    }

    public function showTradePack(){
        return view('portal.customer-care.trade-pack');
    }

    public function showSeller(){
        return view('portal.customer-care.seller');
    }

    //categories
    public function showCategories(){

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        return view('portal.categories.categories')->with('categories', $categories)->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts]);
    }

    public function showAddCategoryView(){
        return view('portal.add.category');
    }

    public function ShowEditCategoryView($id){
        $category = Category::where('id', $id)->get();
        return view('portal.categories.editcategory');
    }

    public function deleteCategory($id){
        Category::where('id', $id)->delete();
        return \redirect('/portal/categories');
    }

    public function showAddBrandsView(){
        return view('portal.add.brand');
    }

    public function ShowEditBrandsView($id){
        Brand::where('id', $id)->get();
        return view('portal.categories.editbrand');
    }

    public function deleteBrands($id){
        Brand::where('id', $id)->delete();
        return \redirect('/portal/categories');
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

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        return view('portal.product.product')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts]);

    }

    public function showSellingProductsPage(){
        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        return view('portal.product.sellingproduct')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts]);
    }

    public function showBuyingProductsPage(){
        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        return view('portal.product.buyingproduct')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts]);
    }

    public function showAddBuyingProductPage(){

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        return view('portal.add.buyingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions]);
    }

    public function showAddSellingProductPage(){
        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();
        
        return view('portal.add.sellingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions]);
    }

    public function addBuyingProduct(Request $request){

        $product = new BuyingProduct();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->product_code_name = $request->productCode;
        $product->product_code_value = $request->productcodevalue;
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
        BuyingProduct::where('id', $id)->delete();
        return \redirect('/portal/product/buying-products');
    }

    public function removeSellingProduct($id){
        SellingProduct::where('id', $id)->delete();
        return \redirect('/portal/product/selling-products');
    }

    //quarantine

    public function showQuarantinePage(){
        return view('portal.quarantine.quarantine');
    }

    public function showAwaitingResponse(){
        return view('portal.quarantine.awaiting');
    }

    public function showQuarantineReturn(){
        return view('portal.quarantine.return');
    }

    public function showQuarantineRetest(){
        return view('portal.quarantine.retest');
    }

    public function showQuarantineStock(){
        return view('portal.quarantine.stock');
    }

    public function showQuarantineManual(){
        return view('portal.quarantine.manually');
    }

    //testing

    public function showTestingPage(){
        return view('portal.testing.testing');
    }

    public function showReceiveTradeIn(){
        return view('portal.testing.receive');
    }

    public function showFindTradeIn(){
        return view('portal.testing.find');
    }

    public function find(Request $request){
        dd($request);
    }

    public function receive(Request $request){
        $tradeins = Tradein::where('barcode', $request->scanid)->get();
        return view('portal.testing.order')->with('tradeins', $tradeins);
    }

    public function testItem($id){
        $tradein = Tradein::where('id', $id)->first();
        $user  = User::where('id', $tradein->user_id)->first();
        $product = SellingProduct::where('id', $tradein->product_id)->first();
        

        return view('portal.testing.questions')->with(['tradein'=>$tradein, 'user'=>$user, 'product'=>$product]);
    }

    public function setTradeInStatus(Request $request){

        $tradein = Tradein::where('id', $request->tradein_id)->first();
        $tradein->received = true;
        $tradein->save();

        return redirect()->back();
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

        $url = 'https://gapi.checkmend.com/duediligence/' . 1 . '/' . $imei_number;

        $options_array  = false;
        $response_config_array  = false;

        $options['category']  = 1;
        $options['reason_data'] = true;
        $options['make_model'] 	  = true;
        $options['cdma_validate'] = false;

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

        dd($result);


    }

    private function send_request($url, $request_body, $options = false){
			$ws = new browser_ckmd();

			// Login Details
			$username  			  = 49;
			$signature_hash = sha1("0bc72ef89eac143151bd" . $request_body);
			$password   		  = $signature_hash;

			// Create Authorisation header
		  $authorisation_header = base64_encode(49 . ':' . $signature_hash);
			$content_length = strlen($request_body);

			$ws->connect();

			curl_setopt($ws->connection, CURLOPT_POST, false); // dont perform an normal post
			curl_setopt($ws->connection, CURLOPT_HTTPHEADER,  array('Authorization: Basic ' . $authorisation_header,'Accept: application/json','Content-type: application/json', 'Content-length:' .$content_length) 	);
			curl_setopt($ws->connection, CURLOPT_HTTPAUTH,  CURLAUTH_BASIC	);
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


    //payments

    public function showPaymentPage(){
        return view('portal.payments.payments');
    }

    public function showPaymentAwaitingPage(){
        return view('portal.payments.awaiting');
    }

    public function showPaymentPendingPage(){
        return view('portal.payments.pending');
    }

    public function showPaymentCompletedPage(){
        return view('portal.payments.completed');
    }

    public function showPaymentReportsPage(){
        return view('portal.payments.reports');
    }

    //reports

    public function showReportsPage(){
        return view('portal.reports.reports');
    }

    //feeds

    public function showFeedsPage(){
        return view('portal.feeds.feeds');
    }

    public function showExportImportPage(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('portal.feeds.export-import')->with(['categories'=>$categories, 'brands'=>$brands]);
    }

    public function showFeedsSummaryPage(){
        $feeds = Feed::all();
        return view('portal.feeds.summary')->with('feeds', $feeds);
    }

    public function showFeedsExternalPage(){
        return view('portal.feeds.external');
    }

    public function feedsExport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $columns = "";
        $datarows = "";
        $products = "";

        if($export_feed_parameter == 1){
            $columns = Schema::getColumnListing('buying_products');
            //28 
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB'];
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
                $product->product_code_name = $datarow[6];
                $product->product_code_value = $datarow[7];
                $product->product_network = $datarow[8];
                $product->product_memory = $datarow[9];
                $product->product_colour = $datarow[10];
                $product->product_grade = $datarow[11];
                $product->product_dimensions = $datarow[12];
                $product->product_processor = $datarow[13];
                $product->product_weight = $datarow[14];
                $product->product_screen = $datarow[15];
                $product->product_system = $datarow[16];
                $product->product_connectivity = $datarow[17];
                $product->product_battery = $datarow[18];
                $product->product_signal = $datarow[19];
                $product->product_camera = $datarow[20];
                $product->product_camera_2 = $datarow[21];
                $product->product_sim = $datarow[22];
                $product->product_memory_slots = $datarow[23];
                $product->product_quantity = $datarow[24];
                $product->product_buying_price = $datarow[25];
    
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

        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        $users = User::where('type_of_user', 1)->orWhere('type_of_user', 2)->orWhere('type_of_user', 3)->get();

        return view('portal.users.users')->with('users', $users);
    }

    public function showAddUserPage(){
        return view('portal.users.adduser')->with('title', 'Add User');
    }

    public function editUser($id){
        $userdata = User::where('id', $id)->get();
        $userdata = $userdata[0];
        return view('portal.users.adduser')->with('userdata', $userdata)->with('title', 'Edit User '.$userdata->first_name);
    }

    public function deleteUser($id){
        User::where('id', $id)->delete();
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
        $user->password = Hash::make($request->password);
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
        return view('portal.settings.settings');
    }

    public function showSettingsProductOptionsPage(){
        return view('portal.settings.product-options');
    }

    public function showSettingsConditionsPage(){
        $conditions = Conditions::all();
        return view('portal.settings.conditions')->with('conditions', $conditions);
    }

    public function showSettingsAddConditionsPage(){
        return view('portal.add.condition');
    }

    public function addCondition(Request $request){

        $condition = new Conditions();
        $condition->name = $request->condition_name;
        $condition->alias = $request->condition_alias;
        $condition->importance = $request->condition_importance;

        $condition->save();

        return redirect('/portal/settings/conditions');
    }

    public function showSettingsTestingQuestionsPage(){
        $categories = Category::all();
        return view('portal.settings.testing-questions')->with('categories', $categories);
    }

    public function showCategoryQuestionsPage($productId, $id){

        dd($productid, $id);
        
        return view('portal.settings.questions');
    }

    public function showCategoryAddQuestionPage($id){
        $brandid = $id;
        return view('portal.add.question')->with('brandid', $brandid);
    }

    public function showSettingsWebsitesPage(){
        $websites = Websites::all();
        return view('portal.settings.websites')->with('websites', $websites);
    }

    public function showAddWebsitePage(){
        return view('portal.add.website');
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
        $website = Websites::where('id', $id);
        $website->delete();
        return redirect('/portal/settings/websites');
    }

    public function showSettingsStoresPage(){
        $stores = Stores::all();
        return view('portal.settings.stores')->with('stores', $stores);
    }

    public function showAddStorePage(){
        return view('portal.add.store');
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
        $store = Stores::where('id', $id);
        $store->delete();
        return redirect('/portal/settings/stores');
    }

    public function showSettingsPaymentsOptionsPage(){
        return view('portal.settings.payment-options');
    }

    public function showSettingsDeliveryOptionsPage(){
        return view('portal.settings.delivery-options');
    }

    public function showSettingsCheckoutOptionsPage(){
        return view('portal.settings.checkout-options');
    }

    public function showSettingsPromotionalCodesPage(){
        return view('portal.settings.promotional-codes');
    }

    public function showSettingsBrandsPage(){
        $brands = Brand::all();
        return view('portal.settings.brands')->with('brands', $brands);
    }

    //cms

    public function showCmsPage(){
        return view('portal.cms.cms');
    }

    //trays

    public function showTraysPage(){
        return view('portal.trays.trays');
    }

    //boxes

    public function showBoxesPage(){
        return view('portal.boxes.boxes');
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