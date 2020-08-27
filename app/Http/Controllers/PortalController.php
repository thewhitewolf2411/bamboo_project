<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Category;
use App\Eloquent\Product;
use App\Eloquent\ProductData;
use App\Eloquent\Brand;
use App\Eloquent\PortalUsers;
use App\Eloquent\Feed;
use App\Eloquent\Conditions;
use App\Eloquent\Websites;
use App\Eloquent\TestingQuestions;
use App\User;
use Auth;
use Schema;

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
        return view('portal.customer-care.trade-in');
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
        $products = Product::all();

        return view('portal.categories.categories')->with('categories', $categories)->with('products', $products);
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

        return \redirect('/portal/categories');
    }

    //products

    public function showProductsPage(){

        $products = Product::all();

        return view('portal.product.product')->with('products', $products);

    }

    public function showAddProductView(){

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        return view('portal.add.product')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions]);
    }

    public function showEditProductPage($id){
        $product = Product::where('id', $id)->get();
        return view('portal.product.editproduct')->with('product', $product);
    }

    public function deleteProduct($id){
        
        Product::where('id', $id)->delete();
        return \redirect('/portal/product');
        
    }

    public function addProduct(Request $request){

        $product = new Product();

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
        $product->product_buying_price = $request->product_price_a_plus;
        $product->product_selling_price = $request->product_selling_price_a_plus;

        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        $productData = new ProductData();
        $productData->product_id = $product->id;
        $productData->buying_price = $request->product_buying_price;
        $productData->selling_price = $request->product_selling_price;

        $productData->save();

        #dd($request);

        $category = Category::where('id', $request->category)->get();
        dd($category);
        $category->total_produts = $category->total_produts+1;
        $category->save();

        $brand = Brand::where('id', $request->brand)->get();
        $brand->total_produts = $brand->total_produts + 1;
        $brand->save();

        return \redirect('/portal/product');

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
        dd($request);
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
        return view('portal.feeds.export-import')->with('categories', $categories);
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
        
        $filename = "/feed_type_".$export_feed_parameter."[" . date("Y-m-d") ."_". date("h-i-s") . "].xlsx";

        $columns = Schema::getColumnListing('products'); 
        $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC'];

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        for($i=0; $i<count($datarows); $i++){
            $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);
        }

        $products = null;

        if($export_feed_parameter == "0"){
            $products = Product::all();
        }
        else{
            $products = Product::where('category_id', $export_feed_parameter)->get();
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

        $products = Product::all();
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
            $product = new Product();

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
            $product->product_selling_price = $datarow[26];

            $product->save();

            $category = Category::where('id', $datarow[4])->get()[0];
            $category->total_produts = $category->total_produts+1;
            $category->save();
    
            $brand = Brand::where('id', $datarow[5])->get()[0];
            $brand->total_produts = $brand->total_produts + 1;
            $brand->save();
        }

        $feed = new Feed();
        $feed->feed_type = "All devices";
        $feed->status = "Done";
        $feed->save();

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

    public function showCategoryQuestionsPage($id){

        $categoryQuestions = TestingQuestions::where('category_id', $id)->get();
        return view('portal.settings.questions')->with('categoryQuestions', $categoryQuestions);
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
        return view('portal.settings.stores');
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
}
