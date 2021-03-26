<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Eloquent\PortalUsers;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showUsersPage(){
        //if(!$this->checkAuthLevel(9)){return redirect('/');}

        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        $users = User::where('type_of_user', 1)->orWhere('type_of_user', 2)->orWhere('type_of_user', 3)->get();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.users')->with('users', $users)->with('portalUser', $portalUser);
    }

    public function showAddUserPage(){
        //if(!$this->checkAuthLevel(9)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('title', 'Add User')->with('portalUser', $portalUser);
    }

    public function editUserPage($id){
        //if(!$this->checkAuthLevel(9)){return redirect('/');}
        $userdata = User::where('id', $id)->first();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $thisportalUser = PortalUsers::where('user_id', $id)->first();

        return view('portal.users.adduser')->with(['userdata'=>$userdata, 'thisportalUser'=>$thisportalUser, 'title'=>'Edit User '.$userdata->first_name, 'portalUser'=>$portalUser]);
    }

    public function deleteUser($id){
        //if(!$this->checkAuthLevel(9)){return redirect('/');}
        User::where('id', $id)->delete();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return \redirect()->back();
    }

    public function addUser(Request $request){

        #dd($request->all());

        if($request->password !== $request->confirm_password){
            return \redirect('/portal/user/add')->with('error', "Password mismach.");
        }
        
        if(count(User::where('email', $request->email)->get())>0){
            return \redirect('/portal/user/add')->with('error', "User Exists.");
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($request->password);
        //$user->birthdate = "01.08.2020";
        $user->current_phone = 0;
        $user->preffered_os = 'none';
        $user->sub = 0;
        $user->delivery_address = "none";
        $user->billing_address = "none";
        $user->contact_number = "none";
        $user->bamboo_credit = 0;
        $user->username = $request->username;
        $user->worker_email = "customersupport@bamboorecycle.com";
        $user->type_of_user = 1;
        $user->account_disabled = 0;

        $user->birth_date = \Carbon\Carbon::now();

        $user->save();

        $portalUser = new PortalUsers();
        $portalUser->user_id = $user->id;
        if($request->recycle == "on"){
            $portalUser->recycle = true;
        }
        if($request->trade_pack_despatch == "on"){
            $portalUser->trade_pack_despatch = true;
        }
        if($request->awaiting_receipt == "on"){
            $portalUser->awaiting_receipt = true;
        }
        if($request->receiving == "on"){
            $portalUser->receiving = true;
        }
        if($request->device_testing == "on"){
            $portalUser->device_testing = true;
        }
        if($request->trolley_managment == "on"){
            $portalUser->trolley_management = true;
        }
        if($request->trays_managment == "on"){
            $portalUser->trays_managment = true;
        }
        if($request->quarantine_managment == "on"){
            $portalUser->quarantine_managment = true;
        }
        if($request->warehouse_management == "on"){
            $portalUser->warehouse_management = true;
        }
        if($request->sales_lots == "on"){
            $portalUser->sales_lots = true;
        }
        if($request->despatch == "on"){
            $portalUser->despatch = true;
        }
        if($request->customer_care == "on"){
            $portalUser->customer_care = true;
        }
        if($request->order_management == "on"){
            $portalUser->order_management = true;
        }
        if($request->create_order == "on"){
            $portalUser->create_order = true;
        }
        if($request->customer_accounts == "on"){
            $portalUser->customer_accounts = true;
        }
        if($request->messages == "on"){
            $portalUser->messages = true;
        }
        if($request->administration == "on"){
            $portalUser->administration = true;
        }
        if($request->salvage_models == "on"){
            $portalUser->salvage_models = true;
        }
        if($request->sales_models == "on"){
            $portalUser->sales_models = true;
        }
        if($request->feeds == "on"){
            $portalUser->feeds = true;
        }
        if($request->users == "on"){
            $portalUser->users = true;
        }
        if($request->reports == "on"){
            $portalUser->reports = true;
        }
        if($request->cms == "on"){
            $portalUser->cms = true;
        }
        if($request->categories == "on"){
            $portalUser->categories = true;
        }
        if($request->settings == "on"){
            $portalUser->settings = true;
        }
        if($request->payments == "on"){
            $portalUser->payments = true;
        }
        if($request->awaiting_payments == "on"){
            $portalUser->awaiting_payments = true;
        }
        if($request->submit_payments == "on"){
            $portalUser->submit_payments = true;
        }
        if($request->payment_confirmations == "on"){
            $portalUser->payment_confirmations = true;
        }
        if($request->failed_payments == "on"){
            $portalUser->failed_payments = true;
        }


        $portalUser->save();

        return \redirect('/portal/user');
    }

    public function editUser(Request $request){
        #dd($request->all());

        if(isset($request->password)){
            if($request->password !== $request->confirm_password){
                return \redirect()->back()->with(['error'=>"Password mismach."]);
            }
    
        }

        $user = User::where('id', $request->userid)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($request->password);
        //$user->birthdate = "01.08.2020";
        $user->current_phone = 0;
        $user->preffered_os = 'none';
        $user->sub = 0;
        $user->delivery_address = "none";
        $user->billing_address = "none";
        $user->contact_number = "none";
        $user->bamboo_credit = 0;
        $user->username = $request->username;
        $user->worker_email = "customersupport@bamboorecycle.com";
        $user->type_of_user = 1;
        $user->account_disabled = 0;

        $user->save();

        $portalUser = PortalUsers::where('user_id', $request->userid)->first();

        if($request->recycle == "on"){
            $portalUser->recycle = true;
        }
        else{
            $portalUser->recycle = false;
        }

        if($request->trade_pack_despatch == "on"){
            $portalUser->trade_pack_despatch = true;
        }
        else{
            $portalUser->trade_pack_despatch = false;
        }

        if($request->awaiting_receipt == "on"){
            $portalUser->awaiting_receipt = true;
        }
        else{
            $portalUser->awaiting_receipt = false;
        }

        if($request->receiving == "on"){
            $portalUser->receiving = true;
        }
        else{
            $portalUser->receiving = false;
        }

        if($request->device_testing == "on"){
            $portalUser->device_testing = true;
        }
        else{
            $portalUser->device_testing = false;
        }

        if($request->trolley_managment == "on"){
            $portalUser->trolley_management = true;
        }
        else{
            $portalUser->trolley_management = false;
        }
        
        if($request->trays_managment == "on"){
            $portalUser->trays_managment = true;
        }
        else{
            $portalUser->trays_managment = false;
        }

        if($request->quarantine_managment == "on"){
            $portalUser->quarantine_managment = true;
        }
        else{
            $portalUser->quarantine_managment = false;
        }

        if($request->warehouse_management == "on"){
            $portalUser->warehouse_management = true;
        }
        else{
            $portalUser->warehouse_management = false;
        }

        if($request->sales_lots == "on"){
            $portalUser->sales_lots = true;
        }
        else{
            $portalUser->sales_lots = false;
        }

        if($request->despatch == "on"){
            $portalUser->despatch = true;
        }
        else{
            $portalUser->despatch = false;
        }

        if($request->customer_care == "on"){
            $portalUser->customer_care = true;
        }
        else{
            $portalUser->customer_care = false;
        }

        if($request->order_management == "on"){
            $portalUser->order_management = true;
        }
        else{
            $portalUser->order_management = false;
        }

        if($request->create_order == "on"){
            $portalUser->create_order = true;
        }
        else{
            $portalUser->create_order = false;
        }

        if($request->customer_accounts == "on"){
            $portalUser->customer_accounts = true;
        }
        else{
            $portalUser->customer_accounts = false;
        }
        if($request->messages == "on"){
            $portalUser->messages = true;
        }
        else{
            $portalUser->messages = false;
        }

        if($request->administration == "on"){
            $portalUser->administration = true;
        }
        else{
            $portalUser->administration = false;
        }

        if($request->salvage_models == "on"){
            $portalUser->salvage_models = true;
        }
        else{
            $portalUser->salvage_models = false;
        }

        if($request->sales_models == "on"){
            $portalUser->sales_models = true;
        }
        else{
            $portalUser->sales_models = false;
        }

        if($request->feeds == "on"){
            $portalUser->feeds = true;
        }
        else{
            $portalUser->feeds = false;
        }

        if($request->users == "on"){
            $portalUser->users = true;
        }
        else{
            $portalUser->users = false;
        }

        if($request->reports == "on"){
            $portalUser->reports = true;
        }
        else{
            $portalUser->reports = false;
        }

        if($request->cms == "on"){
            $portalUser->cms = true;
        }
        else{
            $portalUser->cms = false;
        }

        if($request->categories == "on"){
            $portalUser->categories = true;
        }
        else{
            $portalUser->categories = false;
        }

        if($request->settings == "on"){
            $portalUser->settings = true;
        }
        else{
            $portalUser->settings = false;
        }

        if($request->payments == "on"){
            $portalUser->payments = true;
        }
        else{
            $portalUser->payments = false;
        }

        if($request->awaiting_payments == "on"){
            $portalUser->awaiting_payments = true;
        }
        else{
            $portalUser->awaiting_payments = false;
        }

        if($request->submit_payments == "on"){
            $portalUser->submit_payments = true;
        }
        else{
            $portalUser->submit_payments = false;
        }

        if($request->payment_confirmations == "on"){
            $portalUser->payment_confirmations = true;
        }
        else{
            $portalUser->payment_confirmations = false;
        }

        if($request->failed_payments == "on"){
            $portalUser->failed_payments = true;
        }
        else{
            $portalUser->failed_payments = false;
        }


        $portalUser->save();

        return \redirect()->back()->with(['success'=>'You have succesfully eddited a user.']);


    }

    public function searchUser(Request $request){
        $user = null;
        $match = ['type_of_user' => 1, 'type_of_user' => 2, 'type_of_user' => 3];
        if($request->select_search_by_field == 1){
            $user = User::where('id', $request->searchname)->where($match)->first();
            #dd($user);
            if($user != null){
                $user = $user[0];
            }
            else{
                return \redirect()->back()->with('error', "User not found. Please check your search parameters.");
            }
            
        }
        else if($request->select_search_by_field == 2){
            $user = User::where('first_name', $request->searchname)->where($match)->first();
            if($user != null){
                $user = $user[0];
            }
            else{
                return \redirect()->back()->with('error', "User not found. Please check your search parameters.");
            }
        }

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('userdata', $user)->with('title', "Search result: ".$user->first_name)->with('portalUser', $portalUser);
    }
}
