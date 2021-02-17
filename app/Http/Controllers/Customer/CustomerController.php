<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Eloquent\Category;
use App\User;
use App\Eloquent\Cart;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\SellingProduct;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use App\Eloquent\Wishlist;
use Auth;
use Carbon\Carbon;
use Crypt;


class CustomerController extends Controller
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

    public function setPage($parameter){
        $page = "home";
        $categories = null;
        $showLogin = false;

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
            case "news":
                $page="news";
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
            case "account":
                if(Auth::user()){
                    return redirect('/userprofile');
                }
                else{
                    $showLogin = true;
                }
            break;
            case "wishlist":
                if(Auth::user()){
                    return redirect('/userprofile/wishlist');
                }
                else{
                    $showLogin = true;
                }
            break;
            default:
                $page="home";
            break;
        }

        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        if($categories == null){
            return redirect('/')->with('page', $page)->with('products', $products)->with('showLogin', $showLogin);
        }
        else{
            return redirect('/')
                    ->with('page', $page)
                    ->with('categories', $categories)
                    ->with('products', $products)
                    ->with('showLogin', $showLogin);
        }
        
    }

    public function getAllCategories(){
        return Category::all();
    }

    public function customerCategoryView($category){
        $category_id = Category::where('category_name', $category)->pluck('id');
        $products = "";

        $category_id = $category_id[0];
        $products = BuyingProduct::where('category_id', $category_id)->get();

        return view('customer.products')
                ->with('products', $products)
                ->with('category', $category);

    }

    public function showProduct($product_id){
        
        $product = BuyingProduct::where('id', $product_id)->get();
        $product = $product[0];

        return view('customer.product')->with('product', $product);
    }

    public function addProductToCart(Request $request){

        #dd($request);

        if(Auth::User()){
            $userid = Auth::user()->id;
            $productid = $request->productid;
            $grade = $request->grade;
            $network = $request->network;
            $memory = $request->memory;
            $price = $request->price;
            $type = "tradeout";
    
            $cart = new Cart();
    
            $cart->user_id = $userid;
            $cart->price = $price;
            $cart->product_id = $productid;
            $cart->type = $type;
            $cart->network = $network;
            $cart->memory = $memory;
            $cart->grade = $grade;
            $cart->save();
    
            return redirect('/shop/item/'.$request->productid)->with('productaddedtocart', true);
        }
        else{
            return redirect('/');
        }
        
    }

    public function removeFromCart($parameter){

        $cart = Cart::where('id', $parameter)->first();

        $cart->delete();

        return redirect('/cart');

    }

    public function showCart(){

        if(Auth::user()){

            $olderCartItems = Cart::where('user_id', Auth::user()->id)->where('created_at', '<',\Carbon\Carbon::parse('-24 hours'))->get();
            foreach($olderCartItems as $oCI){
                $oCI->delete();
            }

            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            $products = SellingProduct::all();

            $price = 0;

            $hasTradeIn = false;
            $hasTradeOut = false;

            if($cartItems !== null){
                foreach($cartItems as $items){
                    if($items->type === "tradeout"){
                        $price += $items->price;
                        $hasTradeOut = true;
                    }
                    if($items->type === "tradein"){
                        $hasTradeIn = true;
                    }
                }
            }

            return view('customer.cart')->with([
                    'cart'=>$cartItems,
                    'products'=>$products,
                    'fullprice'=>$price,
                    'hasTradeIn'=>$hasTradeIn,
                    'hasTradeOut'=>$hasTradeOut,
            ]);

        }
        else{
            return \redirect()->back()->with('showLogin', true);
        }

    }

    public function addProductToWishList(Request $request){


        $userid = Auth::user()->id;

        $wishlist = new Wishlist();
        $wishlist->user_id = $userid;
        $wishlist->product_id = $request->productid;

        $wishlist->save();

        return redirect()->back();

    }

    public function showProfile(){

        if(Auth::user()){
            //get current user data
            $userdata = Auth::user();
            #$userorders = Order::where('user_id', $userdata->id)->get();

            $tradeins = Tradein::where('user_id', $userdata->id)->get();
            $tradeouts = Tradeout::where('user_id', $userdata->id)->get();

            #dd($tradeins, $tradeouts);
            $notifications = collect([
                ['id' => 1, 'text'=>'We can’t access your phone, please provide us with your PIN number', 'state' => 'alert'],
                ['id'=>2, 'text'=>'We received your device after 14 days. A new offer has been sent', 'state' => 'alert-solved'],
                ['id'=>3, 'text'=>'Status update: Testing. Great news, we are currently testing your device', 'state' => 'info'],
                ['id'=>4, 'text'=>'Status update: Trade Pack Received. Woohoo! We have received your pack, it will now be passed onto our testing team', 'state' => 'info'],
                ['id'=>5, 'text'=>'Status update: Trade Pack Dispaatched. Keep an eye out, your trade pack is on its way to you', 'state' => 'info'],
                ['id'=>6, 'text'=>'Status update: Order placed. Woohoo! Your order has been placed, a Trade Pack will be sent out to you shortly', 'state' => 'info']
            ]);

            $userdata->password = Crypt::decrypt($userdata->password);

            return view('customer.profile', [
                'userdata' => $userdata, 
                'tradeins' => $tradeins, 
                'tradeouts' => $tradeouts,
                'notifications' => $notifications
            ]);
#                ->with('userorders', $userorders);

        }
        else{
            return redirect('/');
        }

    }

    public function showOrderDetails($order){

        #dd($order);

        $tradein = Tradein::where('barcode', $order)->get();
        dd($tradein);

        return view('customer.orderdetails')->with(['tradein'=>$tradein, 'barcode'=>$order]);
    }

    public function showWishlist(){

        if(!Auth::user()){
            return redirect()->back()->with('showLogin', true);
        }

        $userid = Auth::user()->id;
        $userName = Auth::user()->first_name;

        $userWishlist = Wishlist::where('user_id', $userid)->get();

        $mobilePhones = array();
        $tablets = array();
        $smartwatches = array();
        $rest = array();

        foreach($userWishlist as $wishlistItem){
            $sellingProduct = BuyingProduct::where('id', $wishlistItem->product_id)->first();
            if($sellingProduct->category_id === 1){
                array_push($mobilePhones, $sellingProduct);
            }
            if($sellingProduct->category_id === 2){
                array_push($tablets, $sellingProduct);
            }
            if($sellingProduct->category_id === 3){
                array_push($smartwatches, $sellingProduct);
            }
            if($sellingProduct->category_id === 4){
                array_push($rest, $sellingProduct);
            }
        }
        

        return view('customer.wishlist')->with(['userName'=>$userName, 'mobilePhones'=>$mobilePhones, 'tablets'=>$tablets,
                                                'smartwatches'=>$smartwatches, 'rest'=>$rest
        ]);
    }

    public function deleteOrder($orderid){
        $tradeins = Tradein::where('barcode', $orderid)->get();

        if(count($tradeins)>=1){
            foreach($tradeins as $tradein){
                $tradein->delete();
            }
        }

        return redirect()->back();
    }

    public function changeName(Request $request){
        $user = Auth::user();
        #dd($request->all(), $user);

        $changed = false;
        $chagedData = [];

        if($user->first_name != $request->name){
            $user->first_name = $request->name;
            $changed = true;
            array_push($chagedData, 'First name was succesfully changed');
        }
        if($user->last_name != $request->lastname){
            $user->last_name = $request->lastname;
            $changed = true;
            array_push($chagedData, 'Last name was succesfully changed');
        }
        if($user->delivery_address != $request->delivery_address){
            $user->delivery_address = $request->delivery_address;
            $changed = true;
            array_push($chagedData, 'Delivery address was succesfully changed');
        }
        if($user->billing_address != $request->billing_address){
            $user->billing_address = $request->billing_address;
            $changed = true;
            array_push($chagedData, 'Billing address was succesfully changed');
        }
        if($user->contact_number != $request->contact_number){
            $user->contact_number = $request->contact_number;
            $changed = true;
            array_push($chagedData, 'Contact number was succesfully changed');
        }
        if($user->email != $request->email){
            $user->email = $request->email;
            $changed = true;
            array_push($chagedData, 'Email was succesfully changed');
        }
        if(Crypt::decrypt($user->password) != $request->password){
            $user->password = Crypt::encrypt($request->password);
            $changed = true;
            array_push($chagedData, 'Password was succesfully changed');
        }

        $sub = null;

        if($user->sub == true && $request->sub == "true"){
            //do nothing
        }
        elseif($user->sub == false && $request->sub == "false"){
            //do nothing
        }
        else{
            if($request->sub == "true"){
                $sub = true;
                $changed = true;
                array_push($chagedData, 'Your subsription was succesfully changed.');
            }
            else{
                $sub = false;
                $changed = true;
                array_push($chagedData, 'Your subsription was succesfully changed.');
            }

            $user->sub = $sub;
        }
        if($changed){
            $user->save();
            return redirect()->back()->with('success', $chagedData);
        }
        else{
            return redirect()->back()->with('error', 'Nothing was changed. Please try again.');
        }
    }


    /**
     * Change bank account details.
     */
    public function changeAccountDetails(Request $request){
        $bank_details = UserBankDetails::where('user_id', Auth::user()->id)->get();

        $data = $request->except('token');
        $validation_fails = [];
        if(strlen($data['account_name']) < 5){
            array_push($validation_fails, 'Please enter valid account name.');
        }
        if(!is_numeric($data['account_number'])){
            array_push($validation_fails, 'Account number must be numeric.');

            if(strlen($data['account_number']) !== 8){
                array_push($validation_fails, 'Account number must be 8 digits.');
            }
        }

        if(!is_numeric($data['sort_code_1']) || !is_numeric($data['sort_code_2']) || !is_numeric($data['sort_code_3'])){
            array_push($validation_fails, 'Sort code must be a number.');
        } else {
            if((strlen($data['sort_code_1']) !== 2) || (strlen($data['sort_code_2']) !== 2) || (strlen($data['sort_code_3']) !== 2)){
                array_push($validation_fails, 'Sort code must be 6 digits, 2 per field.');
            }
        }
        
        if(empty($validation_fails)){
            if($bank_details->isEmpty()){

                // create new
                UserBankDetails::create([
                    'user_id' => Auth::user()->id,
                    'account_name' => Crypt::encrypt($request->account_name),
                    'card_number' => Crypt::encrypt($request->account_number),
                    'sort_code' => Crypt::encrypt($request->sort_code_1 . $request->sort_code_2 . $request->sort_code_3)
                ]);
                
                return redirect()->back()->with('account_success', 'Payment details added successfully.');

            } else {
                $userbankdetails = UserBankDetails::where('user_id', Auth::user()->id)->first();
                if($userbankdetails){

                    // update user bank details
                    $userbankdetails->update([
                        'user_id' => Auth::user()->id,
                        'account_name' => Crypt::encrypt($request->account_name),
                        'card_number' => Crypt::encrypt($request->account_number),
                        'sort_code' => Crypt::encrypt($request->sort_code_1 . $request->sort_code_2 . $request->sort_code_3)
                    ]);

                    // change payment batch devices state for ability to create FP batch
                    $tradein_ids = Tradein::where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
                    if($tradein_ids){
                        $payment_batch_devices = PaymentBatchDevice::whereIn('tradein_id', $tradein_ids)->where('payment_state', 2)->get();
                        if($payment_batch_devices->count() > 0){
                            // update bank_details_updated and bank_details_updated_order columns, so that FP batch can be created

                            foreach($payment_batch_devices as $payment_batch_device){
                                // check type (ignore FC batch types)
                                $payment_batch_device->bank_details_updated = true;
                                $payment_batch_device->bank_details_update_order = 1;
                                $payment_batch_device->bank_details_updated_at = Carbon::now();
                                $payment_batch_device->save();            
                            }
                        }
                    }
                    
                    return redirect()->back()->with('account_success', 'Payment details updated successfully.');
                }
                // update (maybe)
            }
        } else {
            return redirect()->back()->with('account_fails', $validation_fails);
        }
        
    }
}
