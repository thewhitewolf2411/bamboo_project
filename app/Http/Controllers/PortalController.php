<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Category;
use App\Eloquent\Product;
use App\Eloquent\Brand;

use Storage;

class PortalController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //customer care

    public function showCustomerCare(){
        return view('portal.customer-care');
    }

    public function showTradeIn(){

    }

    public function showDestroyDevice(){

    }

    public function showTradePack(){

    }

    public function showSeller(){

    }

    //categories
    public function showCategories(){

        $categories = Category::all();
        $products = Product::all();
        $brands = Brand::all();

        return view('portal.categories')->with('categories', $categories)->with('products', $products)->with('brands', $brands);
    }

    public function showAddCategoryView(){
        return view('portal.add.category');
    }

    public function ShowEditCategoryView($id){

    }

    public function deleteCategory($id){

    }

    public function showAddBrandsView(){
        return view('portal.add.brand');
    }

    public function ShowEditBrandsView($id){

    }

    public function deleteBrands($id){

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

        return view('portal.product')->with('products', $products);

    }

    public function showAddProductView(){

        $categories = Category::all();
        $brands = Brand::all();

        return view('portal.add.product')->with(['categories'=>$categories, 'brands'=>$brands]);
    }

    public function showEditProductPage($id){
        
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

    //testing

    //payments

    //reports

    //feeds

    //users

    //settings

    //cms
}
