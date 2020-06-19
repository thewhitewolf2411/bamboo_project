<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\User;
use Auth;

class CustomerController extends Controller
{
    public function setPage($parameter){
        $page = "home";
        $categories = null;

        switch($parameter){
            case "home":
                $page="home";
            break;
            case "about":
                $page="about";
            break;
            case "how":
                $page="how";
            break;
            case "sell":
                $categories = $this->getAllCategories();
                $page="sell";
            break;
            case "faqs":
                $page="faqs";
            break;
            case "support":
                $page="support";
            break;
            case "contact":
                $page="contact";
            break;
            default:
                $page="home";
            break;
        }

        if($categories == null){
            return redirect('/')->with('page', $page);
        }
        else{
            return redirect('/')
                    ->with('page', $page)
                    ->with('categories', $categories);
        }
        
    }

    public function getAllCategories(){
        return Category::all();
    }

    public function customerCategoryView($category){
        $category_id = Category::where('category_name', $category)->pluck('id');
        $products = "";

        $category_id = $category_id[0];
        $products = Product::where('category_id', $category_id)->get();

        return view('customer.products')
                ->with('products', $products)
                ->with('category', $category);

    }
}
