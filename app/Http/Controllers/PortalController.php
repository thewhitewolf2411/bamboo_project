<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Category;
use App\Eloquent\Product;
use App\Eloquent\Brand;
use App\Eloquent\PortalUsers;
use App\User;
use Auth;

use Storage;

class PortalController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function portal(){
        if(Auth::User()->type_of_user == 1 || Auth::User()->type_of_user == 3){

            $portal_user = PortalUsers::where('user_id', Auth::User()->id)->first();

            return view('portal')->with('user_data', $portal_user);
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
        $brands = Brand::all();

        return view('portal.categories.categories')->with('categories', $categories)->with('products', $products)->with('brands', $brands);
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

        return view('portal.add.product')->with(['categories'=>$categories, 'brands'=>$brands]);
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
        $product->base_price = $request->product_price;



        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        return \redirect('/portal/product');

    }

    //quarantine

    public function showQuarantinePage(){
        return view('portal.quarantine.quarantine');
    }

    //testing

    public function showTestingPage(){
        return view('portal.testing.testing');
    }

    //payments

    public function showPaymentPage(){
        return view('portal.payments.payments');
    }

    //reports

    public function showReportsPage(){
        return view('portal.reports.reports');
    }

    //feeds

    public function showFeedsPage(){
        return view('portal.feeds.feeds');
    }

    //users

    public function showUsersPage(){

        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        $users = User::where($match)->get();

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
    //post metode
    public function addUser(Request $request){

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

    //cms

    public function showCmsPage(){
        return view('portal.cms.cms');
    }
}
