<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;
use App\Eloquent\Colour;
use App\Eloquent\Network;
use App\Eloquent\Brand;
use App\Eloquent\AdditionalCosts;
use App\Eloquent\NonWorkingDays;
use App\Eloquent\Clients;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showSettingsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.settings')->with('portalUser', $portalUser);
    }

    public function showSettingsProductOptionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.product-options')->with('portalUser', $portalUser);
    }

    public function showSettingsConditionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}
        $conditions = Conditions::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.conditions')->with('conditions', $conditions)->with('portalUser', $portalUser);
    }

    public function showSellingColourPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $colours = Colour::all();
        #dd($colours);
        return view('portal.settings.productoptions.colour')->with(['portalUser'=>$portalUser, 'colours'=>$colours]);

    }

    public function showSellingNetworksPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $networks = Network::all();
        #dd($networks);

        return view('portal.settings.productoptions.networks')->with(['portalUser'=>$portalUser, 'networks'=>$networks]);

    }

    public function addColourPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.colour')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
    }

    public function addNetworkPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $brands = Brand::all();

        return view('portal.add.network')->with(['portalUser'=>$portalUser, 'brands'=>$brands]);
        
    }

    public function addColour(Request $request){
        $color = new Colour();

        $color->brand_id = $request->brand_id;
        $color->color_value = $request->color_value;

        $color->save();
        return redirect()->back()->with('success', 'You have succesfully added the color.');
    }

    public function addNetwork(Request $request){
        $network = new Network();

        $network->brand_id = $request->brand_id;
        $network->network_value = $request->network_value;

        $network->save();
        return redirect()->back()->with('success', 'You have succesfully added the network.');
    }

    public function showEditBrandsView($id = null){
        //if(!$this->checkAuthLevel(2)){return redirect('/');}
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        if($id !== null){
            $brand = Brand::where('id', $id)->first();
            return view('portal.add.brand')->with(['portalUser'=>$portalUser, 'brand'=>$brand]);
        }

        return view('portal.add.brand')->with('portalUser', $portalUser);
    }

    public function editBrand(Request $request){

        #dd($request->all());

        $brand = Brand::where('id', $request->brand_id)->first();

        $brand->brand_name = $request->brand_name;

        if($request->brand_image){
            $filenameWithExt = $request->file('brand_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('brand_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('brand_image')->storeAs('public/brand_images',$fileNameToStore);
        }

        $brand->brand_image = $fileNameToStore;
        $brand->save();

        return redirect('portal/settings/brands')->with('Success', 'You have succesfully edited manifacturer.');

    }

    public function showSettingsAddConditionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.condition')->with('portalUser', $portalUser);
    }

    public function addCondition(Request $request){
        

        $condition = new Conditions();
        $condition->name = $request->condition_name;
        $condition->alias = $request->condition_alias;
        $condition->importance = $request->condition_importance;

        $condition->save();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return redirect('/portal/settings/conditions');
    }

    public function showSettingsTestingQuestionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $categories = Category::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.testing-questions')->with('categories', $categories)->with('portalUser', $portalUser);
    }


    public function showCategoryAddQuestionPage($id){
        $brandid = $id;
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.add.question')->with('brandid', $brandid)->with('portalUser', $portalUser);
    }

    public function showSettingsPaymentsOptionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.payment-options')->with('portalUser', $portalUser);
    }

    public function showSettingsDeliveryOptionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.delivery-options')->with('portalUser', $portalUser);
    }

    public function showSettingsCheckoutOptionsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.checkout-options')->with('portalUser', $portalUser);
    }

    public function showSettingsPromotionalCodesPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.promotional-codes')->with('portalUser', $portalUser);
    }

    public function showSettingsBrandsPage(){
        //if(!$this->checkAuthLevel(10)){return redirect('/');}
        $brands = Brand::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.settings.brands')->with('brands', $brands)->with('portalUser', $portalUser);
    }

    public function showCostsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $additionalCosts = AdditionalCosts::where('id', 1)->first();
        $miscalaniousCosts = AdditionalCosts::where('id', '!=', 1)->get();
        #dd($additionalCosts);

        return view('portal.settings.costs', ['portalUser'=>$portalUser, 'additionalCosts'=>$additionalCosts, 'miscalaniousCosts'=>$miscalaniousCosts]);
    }

    public function updateCosts(Request $request){

        #dd($request->all());

        $additionalCosts = AdditionalCosts::where('id', 1)->first();

        $additionalCosts->administration_costs = ltrim($request->administration_costs, '£');
        $additionalCosts->carriage_costs = ltrim($request->carriage_costs, '£');
        #$additionalCosts->miscellaneous_costs_total = $request->miscellaneous_costs_total;
        #$additionalCosts->miscellaneous_costs_individual = $request->miscellaneous_costs_individual;

        $additionalCosts->save();

        return redirect()->back()->with(['success'=>'You have succesfully updated costs.']);
    }

    public function addCosts(Request $request){
        #dd($request->all());
        if($request->per_job_deduction > 0){
            AdditionalCosts::create([
                'administration_costs'=>0.00,
                'carriage_costs'=>0.00,
                'miscellaneous_costs'=>$request->miscellaneous_costs,
                'per_job_deduction'=>$request->per_job_deduction,
                'applied_to'=>0,
                'cost_description'=>$request->cost_description
            ]);
    
            return redirect()->back()->with(['success'=>'You have succesfully added costs.']);
        }
        else{
            dd("Misato Katsuragi."); 
        }
    }

    public function showNonWorkingDaysPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $nonWorkingDates = NonWorkingDays::get();

        return view('portal.settings.dates', ['portalUser'=>$portalUser, 'nonWorkingDates'=>$nonWorkingDates]);
    }

    public function addNonWorkingDays(Request $request){
        #dd($request);

        $nonWorkingDate = NonWorkingDays::create([

            'day'=>$request->non_working_day_title,
            'non_working_date'=> \Carbon\Carbon::parse($request->non_working_day),
        ]);

        return redirect()->back()->with(['success'=>'You have succesfully added new Non-working Date.']);
    }

    public function deleteNonWorkingDay(Request $request){
        #dd($request->all());

        $nonWorkingDate = NonWorkingDays::where('id', $request->dateid)->first();
        $nonWorkingDate->delete();

        return response(['Success'], 200);
    }

    public function showClientsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $clients = Clients::all();

        return view('portal.settings.clients', ['portalUser'=>$portalUser, 'clients'=>$clients]);
        
    }

    public function addClient(Request $request){
        #dd($request->all());

        Clients::create([
            'account_name'=>$request->account_name,
            'contact_name'=>$request->contact_name,
            'address'=>$request->address,
            'post_code'=>$request->post_code,
            'country'=>$request->country,
            'contact_email'=>$request->contact_email,
            'contact_number'=>$request->contact_number,
            'vat_code'=>$request->vat_code,
            'payment_type'=>$request->payment_type
        ]);

        return redirect()->back()->with('success', 'You have added client.');
    }

    public function deleteClient(Request $request){
        $clientid = $request->clientid;

        Clients::where('id', $clientid)->first()->delete();
        return 200;
    }
}
