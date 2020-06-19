<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\User;

class AdminController extends Controller
{

    public function checkUser(){
        if(Auth::User()->type_of_user == 2 || Auth::User()->type_of_user == 3){
            return true;
        }
        else{
            return redirect('/');
        }
        
    }

    public function sales(){
        if($this->checkUser()){

            return view('admin.sales');
        }
    }

    public function customers(){
        if($this->checkUser()){
            $customers = User::where('type_of_user', 0)
            ->get();
            return view('admin.customers')->with('customers', $customers);
        }
    }

    public function products(){

        $allCategories = Category::all();

        if($this->checkUser()){
            return view('admin.products')->with('allCategories', $allCategories);
        }
    }

    public function search(){
        if($this->checkUser()){
            return view('admin.search');
        }
    }

    public function reports(){
        if($this->checkUser()){
            return view('admin.reports');
        }
    }

    public function options(){
        if($this->checkUser()){
            return view('admin.options');
        }
    }


    public function addCategoryPage(){
        if($this->checkUser()){
            return view('admin.add.addcategory');
        }
    }

    public function addProductPage($categoryid){
        if($this->checkUser()){
            return view('admin.add.addproduct')->with('categoryid', $categoryid);
        }
    }

    public function addCategory(Request $request){
        if($this->checkUser()){
            
            $category_name = $request->category_name;
            $category_description = $request->category_description;
            $category_image = "";
            if($request->hasFile('category_image')){
                $image = $request->file('category_image');

                $category_image = $category_name . '.' . $image->getClientOriginalExtension();
                $destination_path = public_path('/category_images');
                $image->move($destination_path, $category_image);

            }
            else{
                $category_image = "default_category_image.jpg";
            }

            $category = new Category();
            $category->category_name = $category_name;
            $category->category_description = $category_description;
            $category->category_image = $category_image;

            $category->save();

            return redirect('/admin/products');

        }
    }

    public function addProduct(Request $request){
        if($this->checkUser()){

            $product_image = "";
            if($request->hasFile('product_image')){
                $image = $request->file('product_image');

                $product_image = $product_name . '.' . $image->getClientOriginalExtension();
                $destination_path = public_path('/product_images');
                $image->move($destination_path, $category_image);

            }
            else{
                $product_image = "default_product_image.jpg";
            }

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->product_description = $request->product_description;
            $product->product_code_sku = $request->product_code_sku;
            $product->product_code_mpn = $request->product_code_mpn;
            $product->product_code_gtin = $request->product_code_gtin;
            $product->product_code_upc = $request->product_code_upc;
            $product->product_code_ean = $request->product_code_ean;
            $product->product_code_isbn = $request->product_code_isbn;
            $product->product_code_extension_1 = $request->product_extension_1;
            $product->product_code_extension_2 = $request->product_extension_2;
            $product->network = $request->network;
            $product->price_new = $request->price_new;
            $product->price_working_a = $request->price_working_a;
            $product->price_working_b = $request->price_working_b;
            $product->price_working_c = $request->price_working_c;
            $product->price_faulty = $request->price_faulty;
            $product->price_damaged = $request->price_damaged;
            $product->quantity = $request->quantity;
            $product->product_image = $product_image;

            $product->save();
            return redirect('/admin/products');

        }
    }

    public function showCategory($categoryid){

        if($this->checkUser()){

            $products = Product::where('category_id', $categoryid)
                        ->get();

            return view('admin.categoryproducts')
                        ->with('products', $products)
                        ->with('categoryid', $categoryid);
        }

    }
}
