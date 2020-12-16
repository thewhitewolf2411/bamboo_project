<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\BuyingProductColours;
use App\Eloquent\BuyingProductInformation;
use App\Eloquent\BuyingProductNetworks;
use App\Eloquent\ProductData;
use App\Eloquent\Brand;


class ShopController extends Controller
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

    /* Note on products
    
    Mobile devices are product_category id = 1
    Tablets are product_category id = 2
    Accessories are product_category id = 3
    Watches are product_categry id = 4
    
    */

    public function showShopView(){
        $products = BuyingProduct::all();
        $latestProducts = BuyingProduct::orderBy('id', 'desc')->take(3)->get();
        return view ('shop.welcome')->with('products', $products)->with('latestProducts', $latestProducts);
    }

    public function showLetView(){
        $products = BuyingProduct::all();
        return view ('shop.let')->with('products', $products);
    }

    public function showWhyView(){
        $products = BuyingProduct::all();
        return view ('shop.why')->with('products', $products);
    }

    public function showShop($category){
        $title="";
        $data = "";
        $appleData = null;
        $samsungData = null;
        $brands = null;

        switch($category){
            case "latest":
                $title = "Shop Latest Offers";
            break;
            case "mobile":
                $data = BuyingProduct::get();
                $appleData = BuyingProduct::where('category_id', 1)->where('brand_id', 1)->limit(4)->get();
                $samsungData = BuyingProduct::where('category_id', 1)->where('brand_id', 2)->limit(4)->get();
                $brands = Brand::get();
                $title = "Shop Mobile Phones";
            break;
            case "tablets":
                $title = "Shop Tablets";
            break;
            case "accesories":
                $title = "Shop Accessories";
            break;
            case "watches":
                $title = "Shop Watches";
            break;
            case "compare":
                $title = "Compare Models";
            break;
        }

        $products = BuyingProduct::all();
        return view('shop.products')->with('products', $products)->with('title', $title)->with('data', $data)->with('appleData', $appleData)->with('samsungData', $samsungData)->with('brands', $brands);
    }

    public function showItem($id){

        $product = BuyingProduct::where('id', $id)->first();
        $sellingProductInformation = BuyingProductInformation::where('product_id', $id)->get();
        #dd($sellingProductInformation);
        $productNetworks = BuyingProductNetworks::where('product_id', $id)->get();

        $products = BuyingProduct::all();
        return view('shop.item')->with(['product'=>$product, 'products'=>$products, 'productInformation'=>$sellingProductInformation, 'networks'=>$productNetworks]);

    }

    public function showAllItems(Request $request){

        $sortData = "";

        $products = BuyingProduct::all();

        return view('shop.shop')->with("sortData", $sortData)->with('products', $products);
    }

    //Post metode za shop
    public function choosePhone(Request $request){
        dd($request);
    }
}
