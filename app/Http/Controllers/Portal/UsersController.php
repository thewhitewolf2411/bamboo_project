<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
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

    public function editUser($id){
        //if(!$this->checkAuthLevel(9)){return redirect('/');}
        $userdata = User::where('id', $id)->get();
        $userdata = $userdata[0];

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.users.adduser')->with('userdata', $userdata)->with('title', 'Edit User '.$userdata->first_name)->with('portalUser', $portalUser);
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
        $user->birthdate = "01.08.2020";
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
        if($request->box_managment == "on"){
            $portalUser->box_management = true;
        }
        if($request->quarantine_managment == "on"){
            $portalUser->quarantine_managment = true;
        }
        if($request->warehouse_management == "on"){
            $portalUser->warehouse_management = true;
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
        if($request->settings == "on"){
            $portalUser->settings = true;
        }
        if($request->payments == "on"){
            $portalUser->payments = true;
        }
        if($request->payments_awaiting_assignment == "on"){
            $portalUser->payments_awaiting_assignment = true;
        }
        if($request->pending_payments == "on"){
            $portalUser->pending_payments = true;
        }
        if($request->completed_payment == "on"){
            $portalUser->completed_payment = true;
        }
        if($request->payment_report == "on"){
            $portalUser->payment_report = true;
        }


        $portalUser->save();

        return \redirect('/portal/user');
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
