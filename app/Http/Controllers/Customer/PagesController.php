<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Blog;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\Message;
use App\Eloquent\SellingProduct;
use App\Services\KlaviyoEmail;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()){
            $role = Auth::user()->type_of_user; 

            // Check user role
            switch ($role) {
                case 0:
                    $buyingProducts = BuyingProduct::all();
                    $sellingProducts = SellingProduct::all();
            
                    $products = $buyingProducts->merge($sellingProducts);
                    return view('welcome')->with('products', $products);
                    break;
                case 1:
                    return \redirect('/portal');
                    break; 
                case 2:
                    return \redirect('/portal');
                    break; 
                case 3:
                    return \redirect('/portal');
                    break; 
                }
        }

        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.home')->with('products', $products);
    }

    public function showHowitWorksPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.how')->with('products', $products);
    }

    public function showAboutPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.about')->with('products', $products);
    }

    public function showNewsPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $blogs = Blog::all()->sortByDesc('id');

        return view('customer.news', ['products'=>$products, 'blogs'=>$blogs]);
    }

    public function showSingleNews($id){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $blog = Blog::where('id', $id)->first();

        return view('customer.news', ['products'=>$products, 'blog'=>$blog]);
    }

    public function showSupportAndServicePage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.support')->with('products', $products);
    }

    public function showSellingSupportPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.supportselling')->with('products', $products);
    }

    public function showContactPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.contact')->with('products', $products);
    }


    public function admin(){
        if(Auth::User() || Auth::User()->type_of_user == 2 || Auth::User()->type_of_user == 3){

            $orders = Order::orderBy('id','desc')->take(10)->get();

            return view('admin')->with('last_orders', $orders);
        }
        else{
            return redirect('/');
        }
        
    }

    public function showEnvironmentPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.environment')->with('products', $products);
    }

    public function showCharityPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.charity')->with('products', $products);
    }

    public function showPrivacyPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.privacy')->with('products', $products);
    }

    public function showTermsPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.terms')->with('products', $products);
    }

    public function showMapPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.map')->with('products', $products);
    }

    public function showCookiesPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.cookies')->with('products', $products);
    }

    public function showSlaveryPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.slavery')->with('products', $products);
    }

    public function showCorporatePage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.corporate')->with('products', $products);
    }

    public function showReturnPolicyPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();
        $products = $buyingProducts->merge($sellingProducts);

        return view('customer.footer-links.returnpolicy')->with('products', $products);
        
    }

    public function showPaswordResetPage(){
        
        return view('auth.passwords.reset');

    }

    /**
     * Sing up to the newsletter.
     */
    public function singUpNewsletter(Request $request){
        if(isset($request->email)){
            $email = $request->email;
            $klaviyo = new KlaviyoEmail();
            $klaviyo->subscribeToNewsletter($email);

            return redirect()->back();
        }
    }

    public function sendMessage(Request $request){
        $firstName = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->emailadress;
        $telephone = $request->telephone;
        $ordernumber = $request->ordernumber;
        $message = $request->yourmessage;

        $newMessage = Message::create([
            'first_name'=>$firstName,
            'last_name'=>$lastname,
            'email'=>$email,
            'telephone'=>$telephone,
            'order_number'=>$ordernumber,
            'message'=>$message
        ]);

        return redirect()->back()->with(['message_success'=>'Your message has been sent.']);
    }

}
