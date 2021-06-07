<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Blog;
use App\Eloquent\Order;
use App\Eloquent\BuyingProduct;
use App\Eloquent\FAQ;
use App\Eloquent\Message;
use App\Eloquent\PromotionalDevices;
use App\Eloquent\SellingProduct;
use App\Services\KlaviyoEmail;
use App\Services\LabelService;
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
                    $popularDevices = PromotionalDevices::where('promo_type', 1)->first();
                    $popular = collect();
                    if($popularDevices !== null){
                        if($popularDevices->device_1 !==null){
                            $popular->push($popularDevices->getFirstDevice());
                        }
                        if($popularDevices->device_2 !==null){
                            $popular->push($popularDevices->getSecondDevice());
                        }
                        if($popularDevices->device_3 !==null){
                            $popular->push($popularDevices->getThirdDevice());
                        }
                        if($popularDevices->device_4 !==null){
                            $popular->push($popularDevices->getFourhtDevice());
                        }
                    }


                    return view('customer.home', ['products' => $products, 'popular' => $popular]);
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
        $popularDevices = PromotionalDevices::where('promo_type', 1)->first();
        $popular = collect();
        if($popularDevices !== null){
            if($popularDevices->device_1 !==null){
                $popular->push($popularDevices->getFirstDevice());
            }
            if($popularDevices->device_2 !==null){
                $popular->push($popularDevices->getSecondDevice());
            }
            if($popularDevices->device_3 !==null){
                $popular->push($popularDevices->getThirdDevice());
            }
            if($popularDevices->device_4 !==null){
                $popular->push($popularDevices->getFourhtDevice());
            }
        }
        

        return view('customer.home', ['products' => $products, 'popular' => $popular]);
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
        $all_news = Blog::where('cms_type', 0)->get()->take(4);
        $all_blogs = Blog::where('cms_type', 1)->get()->take(4);
        $all_howto = Blog::where('cms_type', 2)->get()->take(4);
        
        return view('customer.news', [
            'products'=>$products, 
            'blogs'=>$blogs, 
            'all_news' => $all_news, 
            'all_blogs' => $all_blogs, 
            'all_howto' => $all_howto
        ]);
    }

    public function showSingleNews($id){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);

        $blog = Blog::where('id', $id)->first();
        $other = Blog::all()->except($id)->take(3);
        $howto = Blog::where('cms_type',2)->where('id', '!=', $id)->get()->take(2);

        return view('customer.newsarticle', ['blog'=>$blog, 'products' => $products, 'blogs' => $other, 'howto' => $howto]);
    }

    public function showSupportAndServicePage(){
        // phase #1
        return redirect('/support/selling');

        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.support')->with('products', $products);
    }

    public function showSellingSupportPage($id = null){
        $question_id = null;
        if($id){
            $question_id = $id;
        }
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();
        $all_faq = FAQ::all();
        $faq = FAQ::all();

        $chunk = $faq->splice(0,ceil($faq->count() / 2));
        $first_faq = $faq;
        $second_faq = $chunk;

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.supportselling', [
                'products' => $products, 
                'faq' => $all_faq,
                'first_faq' => $first_faq, 
                'second_faq' => $second_faq,
                'question_id' => $question_id
            ]
        );
    }

    public function searchFAQSupport(Request $request){
        if(isset($request->term)){
            $searchterm = $request->term;
            $results = FAQ::where('question', 'LIKE', "%".strtolower($searchterm)."%")->get();
            return $results;
        }
    }

    public function showContactPage(){
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();
        $selected = isset(request()->selected) ? request()->selected : null;

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.contact', ['products' => $products, 'selected' => $selected]);
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

        $phones = PromotionalDevices::getDevice(1);
        $tablets = PromotionalDevices::getDevice(2);
        $watches = PromotionalDevices::getDevice(3);

        $products = $buyingProducts->merge($sellingProducts);
        return view('customer.footer-links.map', ['products' => $products, 'tablets' => $tablets, 'phones' => $phones, 'watches' => $watches]);
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
        $buyingProducts = BuyingProduct::all();
        $sellingProducts = SellingProduct::all();
        $products = $buyingProducts->merge($sellingProducts);

        return view('auth.passwords.reset', ['products'=>$products]);

    }

    /**
     * Sing up to the newsletter.
     */
    public function singUpNewsletter(Request $request){
        if(isset($request->email_address)){
            $email = $request->email_address;
            $klaviyo = new KlaviyoEmail();
            $klaviyo->subscribeToNewsletter($email);

            return response(200);
            //return redirect()->back()->with('success-newslettersignup', "Thanks for subscribing to our newsletter!");
        }
        return response(200);
    }

    public function sendMessage(Request $request){

        #dd($request->all());

        $title = "";
        if($request->title !== 'other'){
            $title = $request->title;
        }
        else{
            $title = $request->custom_title;
        }

        $firstName = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email_address;
        $telephone = $request->telephone;
        $ordernumber = $request->order_number;
        $message = $request->yourmessage;

        Message::create([
            'title'=>$title,
            'first_name'=>$firstName,
            'last_name'=>$lastname,
            'email'=>$email,
            'telephone'=>$telephone,
            'order_number'=>$ordernumber,
            'message'=>$message
        ]);

        return redirect()->back()->with(['message_success'=>'Your message has been sent.']);
    }


    public function downloadSDLabel(){
        $labelService = new LabelService();
        return $labelService->downloadSDLabel();
    }


    public function downloadTradeLabel(Request $request){

        $requestData = $request->all();

        $labelService = new LabelService();
        #dd($labelService->downloadTradeLabel($requestData));
        return $labelService->downloadTradeLabel($requestData);
    }
}
