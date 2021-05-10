<?php

namespace App\Http\Controllers\Customer;

use App\Eloquent\AbandonedCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Eloquent\Category;
use App\User;
use App\Eloquent\Cart;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\Notification;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\SellingProduct;
use App\Eloquent\Tradein;
use App\Eloquent\Tradeout;
use App\Eloquent\Wishlist;
use App\Helpers\Dates;
use App\Services\KlaviyoEmail;
use App\Services\LabelService;
use App\Services\NotificationService;
use Auth;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Facades\Hash;
use DNS1D;
use Exception;
use PDF;

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

    /**
     * Remove item from cart.
     * @param string $parameter
     */
    public function removeFromCart($parameter){
        $cart = Cart::where('id', $parameter)->first();
        $cart->delete();
        return redirect('/cart')->with('success', 'We’ve successfully removed your device from the basket.');
    }

    /**
     * Delete item from abandoned cart.
     * @param string $id
     */
    public function removeFromAbandonedCart($id){
        $abandoned_cart = AbandonedCart::where('id', $id)->first();
        $abandoned_cart->delete();
        return redirect('/cart')->with('success', 'We’ve successfully removed your device from the basket.');
    }

    /**
     * Show basket
     */
    public function showCart(){

        if(Auth::user()){

            $olderCartItems = Cart::where('user_id', Auth::user()->id)->where('created_at', '<',\Carbon\Carbon::parse('-24 hours'))->get();
            foreach($olderCartItems as $oCI){
                $oCI->delete();
            }

            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            $products = SellingProduct::all();

            $price = 0;
            $sellPrice = 0;

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
                        $sellPrice += $items->price;
                    }
                }
            }

            return view('customer.cart')->with([
                    'cart'=>$cartItems,
                    'products'=>$products,
                    'fullprice'=>$price,
                    'sellPrice'=>$sellPrice,
                    'hasTradeIn'=>$hasTradeIn,
                    'hasTradeOut'=>$hasTradeOut,
            ]);

        }
        else{
            // show abandoned cart items
            $email = request()->session()->get('session_email', null);
            $abandoned_cart_items = null;
            $products = SellingProduct::all();
            $price = 0;
            $sellPrice = 0;
            $hasTradeIn = false;
            $hasTradeOut = false;

            if($email){
                $abandoned_cart_items = AbandonedCart::where('user_email', $email)->get();
    
                if($abandoned_cart_items !== null){
                    foreach($abandoned_cart_items as $items){
                        if($items->type === "tradeout"){
                            $price += $items->price;
                            $hasTradeOut = true;
                        }
                        if($items->type === "tradein"){
                            $hasTradeIn = true;
                            $sellPrice += $items->price;
                        }
                    }
                }
    
                
            }

            return view('customer.cart')->with([
                'cart'=>$abandoned_cart_items,
                'products'=>$products,
                'fullprice'=>$price,
                'sellPrice'=>$sellPrice,
                'hasTradeIn'=>$hasTradeIn,
                'hasTradeOut'=>$hasTradeOut,
            ]);
            

            //return \redirect()->back()->with('showLogin', true);
        }

    }

    /**
     * Show cart details.
     */
    public function showCartDetails(){
        if(Auth::user()){

            $olderCartItems = Cart::where('user_id', Auth::user()->id)->where('created_at', '<',\Carbon\Carbon::parse('-24 hours'))->get();
            foreach($olderCartItems as $oCI){
                $oCI->delete();
            }

            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            $products = SellingProduct::all();

            $price = 0;
            $sellPrice = 0;

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
                        $sellPrice += $items->price;
                    }
                }
            }

            return view('customer.cartdetails')->with([
                    'cart'=>$cartItems,
                    'products'=>$products,
                    'fullprice'=>$price,
                    'sellPrice'=>$sellPrice,
                    'hasTradeIn'=>$hasTradeIn,
                    'hasTradeOut'=>$hasTradeOut,
            ]);

        }
        else{
            // show abandoned cart items
            $email = request()->session()->get('session_email', null);
            if($email){
                $abandoned_cart_items = AbandonedCart::where('user_email', $email)->get();
                $products = SellingProduct::all();

                $price = 0;
                $sellPrice = 0;

                $hasTradeIn = false;
                $hasTradeOut = false;

                if($abandoned_cart_items !== null){
                    foreach($abandoned_cart_items as $items){
                        if($items->type === "tradeout"){
                            $price += $items->price;
                            $hasTradeOut = true;
                        }
                        if($items->type === "tradein"){
                            $hasTradeIn = true;
                            $sellPrice += $items->price;
                        }
                    }
                }

                return view('customer.cartdetails')->with([
                        'cart'=>$abandoned_cart_items,
                        'products'=>$products,
                        'fullprice'=>$price,
                        'sellPrice'=>$sellPrice,
                        'hasTradeIn'=>$hasTradeIn,
                        'hasTradeOut'=>$hasTradeOut,
                ]);
            }
            return \redirect()->back()->with('showLogin', true);
        }
    }


    /**
     * Complete registration using abandoned cart.
     */
    public function completeRegistration(Request $request){
        // validate email
        $this->validate($request, 
            [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]
        );
        // check birth date validity
        //$valid_date = Dates::checkBirthDate($request->all());
        //if(!$valid_date){
        //    return redirect()->back()->with('regerror','Invalid birth date');
        //}

        $data = $request->all();

        //dd('create user done, move items to real cart, call route for cart details with cart items to complete sale.');
        
        // create user
        $sub = 0;
        if(isset($data['sub'])){
            if($data['sub'] === 'true'){
                $sub = true;
            }
        }

        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Crypt::encrypt($data['password']);

        if(isset($data['birth_day']) && isset($data['birth_month']) && isset($data['birth_year'])){
            $user->birth_date = Carbon::parse($data['birth_day'].'.'.$data['birth_month'].'.'.$data['birth_year']);
        }

        $user->delivery_address = $data['delivery_address'];
        $user->billing_address = $data['billing_address'];
        // $user->contact_number = $data['contact_number'];

        if(isset($data['preferred-os'])){
            $user->preffered_os = $data['preferred-os'];
        }
        else{
            $user->preffered_os = null;
        }
        if(isset($data['current-phone'])){
            $user->current_phone = $data['current-phone'];
        }
        else{
            $user->current_phone = null;
        }
        $user->sub = $sub;

        $user->save();

        $klaviyoEmail = new KlaviyoEmail();
        $klaviyoEmail->AccountCreated($user);

        // send notification (register)
        if($user->sub){
            $notificationService = new NotificationService();
            $notificationService->send($user, 1);
        }
        Auth::login($user);

        // move items from abandoned basket
        $abandoned_cart_devices = AbandonedCart::where('user_email', $user->email)->get();
        foreach($abandoned_cart_devices as $device){

            Cart::create([
                'user_id'       => $user->id,
                'price'         => $device->price,
                'product_id'    => $device->product_id,
                'type'          => $device->type,
                'network'       => $device->network,
                'memory'        => $device->memory,
                'grade'         => $device->grade,
            ]);

            $device->delete();
        }
        
        request()->session()->forget('session_email');

        return redirect()->back()->with('success', 'Account successfully created. Enter remaining details to complete your sale.');
    }


    /**
     * Add product to wishlist.
     */
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

            $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            $userdata->password = Crypt::decrypt($userdata->password);
            $available_os = ['iOS', 'Android', 'Other'];
            $available_devices = SellingProduct::all();

            return view('customer.profile', [
                'userdata' => $userdata, 
                'tradeins' => $tradeins, 
                'tradeouts' => $tradeouts,
                'notifications' => $notifications,
                'os' => $available_os,
                'devices' => $available_devices
            ]);
#                ->with('userorders', $userorders);

        }
        else{
            return redirect('/');
        }

    }

    /**
     * Verify user login.
     */
    public function verify(Request $request){
        if(isset($request->email) && isset($request->pass)){
            if($request->email === Auth::user()->email && $request->pass === Crypt::decrypt(Auth::user()->password)){
                return response(200);
            }
            return response(500);
        }
        return response(404);
    }


    /**
     * Update user personal information.
     */
    public function updatePersonalInfo(Request $request){
        // validate data
        $validation_error_msg = [];
        //$required = ['first_name', 'last_name', 'birth_day', 'birth_month', 'birth_year', 'contact_number', 'delivery_address', 'billing_address', 'preffered_os'];
        $required = ['first_name', 'last_name', 'contact_number', 'delivery_address', 'billing_address', 'preffered_os'];
        foreach($required as $field){
            if(!isset($request->all()[$field])){
                array_push($validation_error_msg, 'Field ' . str_replace('_', ' ', ucfirst($field)) . " can't be empty. ");
            }
        }
        if(!empty($validation_error_msg)){
            return response(['status' => 'error', 'msg' => $validation_error_msg]);
        }
        try {
            $birth_date = Carbon::parse($request->birth_day.'.'.$request->birth_month.'.'.$request->birth_year);
        } catch (Exception $e) {
            return response(['status' => 'error', 'msg' => "Invalid birth date."]);
        }
        
        $user = User::find(Auth::user()->id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            // 'delivery_address' => $request->delivery_address,
            // 'billing_address' => $request->billing_address,
            'current_phone' => $request->current_phone,
            'preffered_os' => $request->preffered_os,
            'birth_date' => $birth_date
        ]);
        return response(['status' => 'success', 'msg' => 'Personal info successfully updated.']);
    }


    /**
     * Update user delivery/billing address.
     */
    public function updateAddress(Request $request){
        if(isset($request->type)){

            switch ($request->type) {
                case 'delivery':
                    $user = User::find(Auth::user()->id);
                    $user->update([
                        'delivery_address' => $request->address,
                    ]);
                    break;

                case 'billing':
                    $user = User::find(Auth::user()->id);
                    $user->update([
                        'billing_address' => $request->address,
                    ]);
                    break;

                default:
                    # code...
                    break;
            }
            
            return response(['status' => 'success', 'msg' => ucfirst($request->type).' address successfully updated.']);
        }
    }


    /**
     * Change user password.
     */
    public function changePass(Request $request){
        if(isset($request->email) && isset($request->old_pass) && isset($request->new_pass)){
            $correct_email = $request->email === Auth::user()->email;
            $correct_old_pass = $request->old_pass === Crypt::decrypt(Auth::user()->password);
            $same_pass = $request->new_pass === Crypt::decrypt(Auth::user()->password);
            if($correct_email && $correct_old_pass){
                if($same_pass){
                    return response("Your new password must be different from your previous password.", 203);
                }
                $user = Auth::user();
                $user->password = Crypt::encrypt($request->new_pass);
                $user->save();
                return response('', 200);
            } else {
                return response('Incorrect email/password.', 203);
            }
        } else {
            return response('Missing data.', 203);
        }
    }

    /**
     * Update communications preferences. 
     */
    public function updateCommunications(Request $request){
        if(isset($request->newsletter)){
            $newsletter_state = ($request->newsletter ==='yes') ? 1 : 0;
            Auth::user()->sub = $newsletter_state;
            Auth::user()->save();
        }
    }


    /**
     * View sale item details.
     */
    public function showOrderDetails($id){
        $tradein = Tradein::findOrFail($id);
        $notifications = Notification::where('user_id', Auth::user()->id)->where('tradein_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('customer.orderdetails', ['tradein' => $tradein, 'notifications' => $notifications]);
    }

    /**
     * Print tradein label.
     */
    public function printLabel(){
        if(isset(request()->tradein)){
            $tradein = Tradein::find(request()->tradein);
            if($tradein){
                return $this->printTradeinLabel($tradein);
            }
        }
    }

    /**
     * Accept faulty offfer.
     */
    public function acceptFaultyOffer($tradein_id){
        $tradein = Tradein::findOrFail($tradein_id);

        switch ($tradein->job_state) {
            // no imei
            case '6':
                // set notification as resolved
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 7)->first();
                $notification->resolved = true;
                $notification->save();

                // set state to test complete
                $tradein->job_state = '12';
                $tradein->save();

                return redirect()->back()->with('success', 'Faulty offer accepted. Device sent to awaiting payment.');
                break;
            
            // incorrect network
            case '15g':
                // set notification as resolved
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();

                // set state to test complete
                $tradein->job_state = '12';
                $tradein->save();

                return redirect()->back()->with('success', 'Faulty offer accepted. Device sent to awaiting payment.');
                break;

            // fmip
            case '15a':
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();

                // set state to test complete
                $tradein->job_state = '12';
                $tradein->save();

                return redirect()->back()->with('success', 'Faulty offer accepted. Device sent to awaiting payment.');
                break;

            // glock
            case '15b':
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();

                // set state to test complete
                $tradein->job_state = '12';
                $tradein->save();

                return redirect()->back()->with('success', 'Faulty offer accepted. Device sent to awaiting payment.');
                break;

            // downgrade after testing faults
            case '15e':
                // set notification as resolved
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();

                // set state to test complete
                $tradein->job_state = '12';
                $tradein->save();

                return redirect()->back()->with('success', 'Faulty offer accepted. Device sent to awaiting payment.');
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Send device to retesting.
     */
    public function sendToRetesting($tradein_id){
        $tradein = Tradein::findOrFail($tradein_id);
        switch ($tradein->job_state) {
            // fmip
            case '15a':
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();
                break;
            // glock
            case '15b':
                $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
                $notification->resolved = true;
                $notification->save();
                break;
            default:
                # code...
                break;
        }
        // send device to retesting
        $tradein->job_state = '13';
        $tradein->save();

        return redirect()->back()->with('success', 'Success. Device sent to retesting.');
    }


    /**
     * Return device to customer.
     */
    public function returnDevice($tradein_id){
        $tradein = Tradein::findOrFail($tradein_id);
        $notificationService = new NotificationService();

        $notification = Notification::where('tradein_id', $tradein->id)->where('type', 12)->first();
        $notification->resolved = true;
        $notification->save();

        // mark device send to customer
        $tradein->job_state = '19';
        $tradein->save();

        // send notification - mark for return
        $notificationService->sendMarkedToReturn($tradein->id);

        return redirect()->back()->with('success', 'Device marked for return.');
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
        $notificationService = new NotificationService();

        if(count($tradeins)>=1){
            foreach($tradeins as $tradein){
                $user_id = $tradein->user_id;
                $tradein_id = $tradein->barcode;
                $tradein->delete();
                 // send notification - order cancelled
                $notificationService->orderCancelled($tradein_id, $user_id);
            }
        }

        return redirect('/userprofile');
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

    /**
     * Add device missing PIN.
     */
    public function addDevicePIN(Request $request){
        if(isset($request->pin) && isset($request->tradein)){
            $tradein = Tradein::find($request->tradein);
            $tradein->pin_pattern_number = $request->pin;
            $tradein->job_state = '9';
            $tradein->save();
            return redirect()->back()->with('success', 'Device PIN added successfuly. Device sent to testing.');
        }
    }

    public function addDevicePattern(Request $request){
        if(isset($request->pattern) && isset($request->tradein)){
            $tradein = Tradein::find($request->tradein);
            $tradein->pin_pattern_number = $request->pattern;
            $tradein->job_state = '9';
            $tradein->save();
            return redirect()->back()->with('success', 'Device Pattern added successfuly. Device sent to testing.');
        }
    }


    /**
     * Print label from userprofile delivery details.
     */
    public function printTradeinLabel($tradein){

        $user = User::find($tradein->user_id);
        $name = $user->first_name . " " . $user->last_name;
        $address = $user->delivery_address;
        $barcode = $tradein->barcode;
        $created_at = $tradein->updated_at;
        $barcodeimage = DNS1D::getBarcodeHTML($barcode, 'C128');

        $delAdress = strtr($address, array(', '=>'<br>'));

        $html = "";
        $html .= "<style>p{margin:0; font-size:9pt;} li{font-size:9pt;} #barcode-container div{margin: auto;}</style>";
        $html .= "<img src='http://portal.dev.bamboorecycle.com/template/design/images/site_logo.jpg'>";
        $html .= "<p>" . $name . ",</p>";
        $html .= "<p>". $delAdress .",</p>";
        $html .= "<br><br>";
        $html .= "<p>Order#". $barcode . " Date: " . $created_at .  "</p>";
        $html .= "<p>Dear " . $name . ",</p>";
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
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
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
                                                <div id='barcode-container' style='border:1px solid black; padding:15px; text-align:center;'><div style='margin: 0 auto:'>". $barcodeimage ."</div><p>" .  $barcode ."</p></div>
                        </div>
                    </div>";
        #echo $html;
        #die();

        $filename = "labeltradeout-" . $barcode . ".pdf";
        PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save($filename);

        return response(['code'=>200, 'filename'=>$filename]);
    }


    public function getLabel($type){
        if(isset(request()->tradein)){
            $tradein = Tradein::find(request()->tradein);
            $labelService = new LabelService();

            switch ($type) {
                case 'free':
                    return $labelService->printFreePostageLabel($tradein);
                    # code...
                    break;
                case 'special':
                    return $labelService->printSpecialDeliveryLabel($tradein);
                    # code...
                    break;
                // case 'instructions':
                //     dd($labelService->printPackagingInstructions());
                //    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
