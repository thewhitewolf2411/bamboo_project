<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\Category;
use App\Eloquent\BuyingProduct;
use App\Eloquent\SellingProduct;
use App\Eloquent\PortalUsers;
use App\Eloquent\Brand;
use App\Eloquent\Conditions;
use App\Eloquent\Network;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;
use App\Eloquent\Colour;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }

    //categories
    public function showCategories(){

        //if(!$this->checkAuthLevel(2)){return redirect('/');}

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.categories.categories')->with('categories', $categories)->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts, 'portalUser'=>$portalUser]);
    }

    public function showAddCategoryView(){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.add.category')->with('portalUser', $portalUser);
    }

    public function ShowEditCategoryView($id){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        $category = Category::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        #dd($category);
        return view('portal.categories.editcategory')->with(['portalUser'=>$portalUser, 'category'=>$category]);
    }

    public function editCategory(Request $request){

        $category = Category::where('id', $request->category_id)->first();

        $category->category_name=$request->category_name;
        $category->category_description = $request->wordbox_description;

        $fileNameToStore = "default_image";

        if($request->category_image){
            $filenameWithExt = $request->file('category_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('category_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('category_image')->storeAs('public/category_images',$fileNameToStore);
        }
        $category->category_image = $fileNameToStore;
        $category->save();

        return \redirect()->back()->with('success', 'You have succesfully edited category.');

    }

    public function deleteCategory($id){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        Category::where('id', $id)->delete();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return \redirect('/portal/categories')->with('portalUser', $portalUser);
    }

    public function showAddBrandsView($id = null){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($id !== null){
            $brand = Brand::where('id', $id)->first();
            return view('portal.add.brand')->with(['portalUser'=>$portalUser, 'brand'=>$brand]);
        }

        return view('portal.add.brand')->with('portalUser', $portalUser);
    }

    public function ShowEditBrandsView($id){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        Brand::where('id', $id)->get();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return view('portal.categories.editbrand')->with('portalUser', $portalUser);
    }

    public function deleteBrands($id){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        Brand::where('id', $id)->delete();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();
        return \redirect('/portal/settings/brands')->with('portalUser', $portalUser);
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
        //if(!$this->checkAuthLevel(3)){return redirect('/');}

        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.product')->with(['products' => $products, 'buyingProducts'=>$buyingProducts, 'sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);

    }

    public function showSellingProductsPage(){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $sellingProducts = SellingProduct::all();
        #$sellingProductInformation = ProductInformation::all();
        #dd($sellingProductInformation);

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.sellingproduct')->with(['sellingProducts'=>$sellingProducts,'portalUser'=>$portalUser]);
    }

    public function showBuyingProductsPage(){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $buyingProducts = BuyingProduct::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.product.buyingproduct')->with(['buyingProducts'=>$buyingProducts,'portalUser'=>$portalUser]);
    }

    public function showAddBuyingProductPage(){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();
        $networks = Network::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.buyingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser, 'networks'=>$networks]);
    }

    public function showAddSellingProductPage(){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}
        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();
        $networks = Network::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        
        return view('portal.add.sellingproduct')->with(['categories'=>$categories, 'brands'=>$brands, 'conditions'=>$conditions,'portalUser'=>$portalUser, 'networks'=>$networks]);
    }

    public function addBuyingProduct(Request $request){

        #dd($request);

        $product = new BuyingProduct();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
        $product->product_image = $fileNameToStore;

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

        $product->save();


        for($i=1; $i<=3; $i++){
            if(isset($request->{"memory-" . $i . "-new"}) && $request->{"memory-" . $i . "-new"} !== null){
                $sellingProductInformation = new BuyingProductInformation();
                $sellingProductInformation->product_id = $product->id;
                $sellingProductInformation->memory = $request->{"memory-" . $i . "-new"};
                $sellingProductInformation->excellent_working = $request->{"price" . $i . "-1-new"};
                $sellingProductInformation->good_working = $request->{"price" . $i . "-2-new"};
                $sellingProductInformation->poor_working = $request->{"price" . $i . "-3-new"};
                $sellingProductInformation->save();
            }
        }

        for($i=1; $i<=5; $i++){
            $productNetworks = new BuyingProductNetworks();
            $productNetworks->network_id = $i;
            $productNetworks->product_id = $product->id;
            $productNetworks->knockoff_price = $request->{"network_" . $i};
            $productNetworks->save();
        }
        
        $category = Category::where('id', $request->category)->first();
        $category->total_produts = $category->total_produts+1;
        $category->save();

        $brand = Brand::where('id', $request->brand)->first();
        $brand->total_produts = $brand->total_produts + 1;
        $brand->save();

        return \redirect('/portal/product/buying-products');
    }

    public function addSellingProduct(Request $request){

        #dd($request);

        $product = new SellingProduct();

        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;

        $filenameWithExt = $request->file('product_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

        $product->product_image = $fileNameToStore;

        $product->save();

        for($i=1; $i<=5; $i++){
            if(isset($request->{"memory-" . $i . "-new"}) && $request->{"memory-" . $i . "-new"} !== null){
                $sellingProductInformation = new ProductInformation();
                $sellingProductInformation->product_id = $product->id;
                $sellingProductInformation->memory = $request->{"memory-" . $i . "-new"};
                $sellingProductInformation->excellent_working = $request->{"price" . $i . "-1-new"};
                $sellingProductInformation->good_working = $request->{"price" . $i . "-2-new"};
                $sellingProductInformation->poor_working = $request->{"price" . $i . "-3-new"};
                $sellingProductInformation->damaged_working = $request->{"price" . $i . "-4-new"};
                $sellingProductInformation->faulty = $request->{"price" . $i . "-5-new"};
                $sellingProductInformation->save();
            }
        }

        for($i=1; $i<=5; $i++){
            $productNetworks = new ProductNetworks();
            $productNetworks->network_id = $i;
            $productNetworks->product_id = $product->id;
            $productNetworks->knockoff_price = $request->{"network_" . $i};
            $productNetworks->save();
        }

        for($i=1; $i<=10; $i++){
            if(isset($request->{"color_" . $i}) && $request->{"color_" . $i} !== null){
                $productColours = new Colour();
                $productColours->product_id = $product->id;
                $productColours->color_value = $request->{"color_" . $i};
                $productColours->save();
            }
        }
        

        return \redirect('/portal/product/selling-products')->with('success', 'You have succesfully added product.');
    }

    public function removeBuyingProduct($id){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}
        BuyingProduct::where('id', $id)->delete();

        return \redirect('/portal/product/buying-products');
    }

    public function removeSellingProduct($id){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}
        SellingProduct::where('id', $id)->delete();

        return \redirect('/portal/product/selling-products');
    }

    public function showEditBuyingProductPage($id){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}

        $product = BuyingProduct::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $categories = Category::all();
        $brands = Brand::all();
        $networks = BuyingProductNetworks::where('product_id', $id)->get();
        $productInformation = BuyingProductInformation::where('product_id', $id)->get();

        return view('portal.product.editbuyingproduct')->with(['product'=>$product, 'portalUser'=>$portalUser, 'categories'=>$categories, 'brands'=>$brands, 'networks'=>$networks, 'productInformation'=>$productInformation]);
    }

    public function showEditSellingProductPage($id){
        //if(!$this->checkAuthLevel(3)){return redirect('/');}

        $product = SellingProduct::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = Conditions::all();

        $sellingProductInformation = ProductInformation::where('product_id', $id)->get();
        $productNetworks = ProductNetworks::where('product_id', $id)->get();
        $colors = Colour::where('product_id', $id)->get();
        #dd($productNetworks);
        $avaliableNetworks = $productNetworks->pluck('network_id')->toArray();
        $newNetworks = Network::whereNotIn('id', $avaliableNetworks)->get();

        return view('portal.product.editsellingproduct', ['product'=>$product, 'portalUser'=>$portalUser, 'categories'=>$categories, 'brands'=>$brands, 'productinformation'=>$sellingProductInformation, 'productnetworks'=>$productNetworks, 'colors'=>$colors, 'newNetworks'=>$newNetworks]);
    }

    public function deleteSellingProductOption($id){
        $sellingProductInformation = ProductInformation::where('id', $id)->first();
        $sellingProductInformation->delete();
        return redirect()->back()->with('product_option_deleted', 'Product option deleted succesfully');
    }

    public function deleteSellingProductNetwork($id){
        $sellingProductNetwork = ProductNetworks::where('id', $id)->first();
        $sellingProductNetwork->delete();
        return redirect()->back()->with('product_option_deleted', 'Product network deleted succesfully');
    }

    public function saveEditedSellingProduct(Request $request){

        #dd($request->all());

        if(isset($request->color_new_1)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_1
            ]);
        }
        if(isset($request->color_new_2)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_2
            ]);
        }
        if(isset($request->color_new_3)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_3
            ]);
        }
        if(isset($request->color_new_4)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_4
            ]);
        }
        if(isset($request->color_new_5)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_5
            ]);
        }
        if(isset($request->color_new_6)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_6
            ]);
        }
        if(isset($request->color_new_7)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_7
            ]);
        }
        if(isset($request->color_new_8)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_8
            ]);
        }
        if(isset($request->color_new_9)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_9
            ]);
        }
        if(isset($request->color_new_10)){
            Colour::create([
                'product_id'=>$request->product_id,
                'color_value'=>$request->color_new_10
            ]);
        }

        for($i=0; $i<10; $i++){
            if(isset($request->{'color_old_id_' . $i})){
                if(isset($request->{'color_old_' . $i})){
                    $color = Colour::find($request->{'color_old_id_' . $i});
                    $color->color_value = $request->{'color_old_' . $i};
                    $color->save();
                }
                else{
                    $color = Colour::find($request->{'color_old_id_' . $i});
                    $color->delete();
                }
            }
        }


        $product = SellingProduct::where('id', $request->product_id)->first();
        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        if($request->has('product_image')){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            $product->product_image = $fileNameToStore;
        }

        if(isset($request->product_avalibility) && $request->product_avalibility === "on"){
            $product->avaliable_for_sell = true;
        }
        else{
            $product->avaliable_for_sell = false;
        }

        $product->save();

        $deviceInfo = array();

        $productInfo = ProductInformation::where('product_id', $request->product_id)->get();
        $networks = ProductNetworks::where('product_id', $request->product_id)->get();
        #dd(count($networks));
        foreach($productInfo as $info){
            if($request->{"memory_".$info->id} == null || $request->{"price1_".$info->id} == null || $request->{"price2_".$info->id} == null || $request->{"price3_".$info->id} == null || $request->{"price4_".$info->id} == null || $request->{"price5_".$info->id} == null){
                $info->delete();
            }
            else{
                if($request->{"memory_".$info->id} != $info->memory){
                    $info->memory = $request->{"memory_".$info->id};
                    $info->save();
                }
                if($request->{"price1_".$info->id} != $info->excellent_working){
                    $info->excellent_working = $request->{"price1_".$info->id};
                    $info->save();
                }
                if($request->{"price2_".$info->id} != $info->good_working){
                    $info->good_working = $request->{"price2_".$info->id};
                    $info->save();
                }
                if($request->{"price3_".$info->id} != $info->poor_working){
                    $info->poor_working = $request->{"price3_".$info->id};
                    $info->save();
                }
                if($request->{"price4_".$info->id} != $info->damaged_working){
                    $info->damaged_working = $request->{"price4_".$info->id};
                    $info->save();
                }
                if($request->{"price5_".$info->id} != $info->faulty){
                    $info->faulty = $request->{"price5_".$info->id};
                    $info->save();
                }
            }
        }

        if(isset($request->memory_new) && isset($request->price1_new) && isset($request->price2_new) && isset($request->price3_new) && isset($request->price4_new) && isset($request->price5_new)){
            $newInfo = new ProductInformation();
            $newInfo->product_id = $request->product_id;
            $newInfo->memory = $request->memory_new;
            $newInfo->excellent_working = $request->price1_new;
            $newInfo->good_working = $request->price2_new;
            $newInfo->poor_working = $request->price3_new;
            $newInfo->damaged_working = $request->price4_new;
            $newInfo->faulty = $request->price5_new;

            $newInfo->save();
        }

        if(count($networks) !== 0){
            $network = $networks[0];

            foreach($networks as $network){
                #dd($network);
                if($request->{"network_".$network->id} != $network->knockoff_price){
                    $network->knockoff_price = $request->{"network_".$network->id};
                    #dd($request->{"network_".$network->id});
                    $network->save();
                }
            }
        }

        if(isset($request->add_new_network_id)){
            ProductNetworks::create([
                'network_id'=>$request->add_new_network_id,
                'product_id'=>$request->product_id,
                'knockoff_price'=>$request->add_new_network_knockoffprice
            ]);
        }

        return redirect('/portal/product/selling-products')->with('product_edited', 'Product' . $product->product_name . 'was succesfully edited.');
    }

    public function saveEditedBuyingProduct(Request $request){

        #dd($request);

        $product = BuyingProduct::where('id', $request->product_id)->first();

        $product->product_name = $request->product_name;
        $product->product_description = $request->wordbox_description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;

        if(($request->file('product_image')) !== null){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            $product->product_image = $fileNameToStore;
        }


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

        $product->save();


        $sellingProductInformation = BuyingProductInformation::where('product_id', $request->product_id)->get();
        foreach($sellingProductInformation as $spi){
            if(isset($request->{"memory-" . $spi->id . "-new"}) && $request->{"memory-" . $spi->id . "-new"} !== null){
                $spi->product_id = $product->id;
                $spi->memory = $request->{"memory-" . $spi->id . "-new"};
                $spi->excellent_working = $request->{"price" . $spi->id . "-1-new"};
                $spi->good_working = $request->{"price" . $spi->id . "-2-new"};
                $spi->poor_working = $request->{"price" . $spi->id . "-3-new"};
                $spi->save();
            }

        }

        $networks = BuyingProductNetworks::where('product_id', $request->product_id)->get();
        foreach($networks as $network){
            
            if($request->{"network_".$network->id} != $network->knockoff_price){
                $network->knockoff_price = $request->{"network_".$network->id};
                $network->save();
            }
        }

        return redirect()->back()->with('product_edited', 'Product Was succesfully edited.');

    }

    
}
