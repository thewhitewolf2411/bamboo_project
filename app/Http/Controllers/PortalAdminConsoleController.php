<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Eloquent\User;
use App\Eloquent\PortalUsers;

class PortalAdminConsoleController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function showAdminConsoleAddUser(){
        return view('portal.warehouseadministrationconsole.createuser');
    }

    public function showAdminConsoleUserManagment(){

        $allUsers = User::where('type_of_user', 1)->get();

        return view('portal.warehouseadministrationconsole.usermanagment')->with('allUsers', $allUsers);
    }

    public function showAdminConsoleUserManagmentView($id){
        $user = User::where('id', $id)->get();
        $portalUser = PortalUsers::where('user_id', $id)->get();

        $user = $user[0];
        $portalUser = $portalUser[0];

        return view('portal.warehouseadministrationconsole.viewuser')->with('user', $user)->with('portalUser', $portalUser);
    }

    public function showAdminConsoleChange(Request $request){
        $user = User::find($request->user_id);
        PortalUsers::where('user_id', $request->user_id);

        if($user->first_name != $request->first_name){
            $user->first_name = $request->first_name;
        }

        if($user->surename != $request->surename){
            $user->surename = $request->surename;
        }

        if($user->username != $request->username){
            $user->username = $request->username;
        }

        if($user->password != $request->password){
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        if($request->trade_pack_dispatch_system && $request->trade_pack_dispatch_system==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['trade_pack_dispach_system'=>true]);
        }
        if($request->receipt_and_dispatch_delivery_receiving_system && $request->receipt_and_dispatch_delivery_receiving_system==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['dispach_portal_delivery_receiving_system'=>true]);
        }
        if($request->device_tester_stock_managment && $request->device_tester_stock_managment==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['device_tester_stock_managment'=>true]);
        }
        if($request->stock_managment && $request->stock_managment==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['stock_managment'=>true]);
        }
        if($request->stock_managment_delivery_receiving_system && $request->stock_managment_delivery_receiving_system==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['stock_managment_delivery_receiving_system'=>true]);
        }
        if($request->quarantine_managment && $request->quarantine_managment==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['quarantine_managamnet_and_customer_returns'=>true]);
        }
        if($request->tray_managment_system && $request->tray_managment_system==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['tray_managment_system'=>true]);
        }
        if($request->sales_and_dispatch && $request->sales_and_dispatch==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['sales_and_dispach'=>true]);
        }
        if($request->stock_transfer && $request->stock_transfer==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['stock_transfer'=>true]);
        }
        if($request->device_managment && $request->device_managment==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['device_managment'=>true]);
        }
        if($request->box_managment_system && $request->box_managment_system==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['box_managment_system'=>true]);
        }
        if($request->device_testing && $request->device_testing==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['device_testing'=>true]);
        }
        if($request->user_managment && $request->user_managment==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['user_managment'=>true]);
        }
        if($request->reports_and_statistics && $request->reports_and_statistics==="on"){
            PortalUsers::where('user_id', $request->user_id)
            ->update(['reports_and_statistics'=>true]);
        }


        return redirect('/portal/adminconsole/usermanagment');
    }

    public function showAdminConsoleReportsAndStatistics(){
        return view('portal.warehouseadministrationconsole.reportsandstatistics');
    }

    public function showAdminConsoleStuckDevices(){
        dd("Create user view");
    }

    public function showAdminConsoleOnlineUser(){
        dd("Create user view");
    }

    public function showAdminConsoleAdd(Request $request){
        $user = new User();

        $user->first_name = $request->first_name;
        $user->surename = $request->surename;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->address = "Bamboo Distribution";
        $user->city = "England";
        $user->worker_email = "customersupport@bamboorecycle.com";
        $user->type_of_user = 1;
        

        $user->save();
        $userid = $user->id;


        $portalUser = new PortalUsers();

        $portalUser->user_id = $userid;
        $portalUser->superuser = false;
        if($request->trade_pack_dispatch_system && $request->trade_pack_dispatch_system==="on"){
            $portalUser->trade_pack_dispach_system = true;
        }
        if($request->receipt_and_dispatch_delivery_receiving_system && $request->receipt_and_dispatch_delivery_receiving_system==="on"){
            $portalUser->dispach_portal_delivery_receiving_system = true;
        }
        if($request->device_tester_stock_managment && $request->device_tester_stock_managment==="on"){
            $portalUser->device_tester_stock_managment = true;
        }
        if($request->stock_managment && $request->stock_managment==="on"){
            $portalUser->stock_managment = true;
        }
        if($request->stock_managment_delivery_receiving_system && $request->stock_managment_delivery_receiving_system==="on"){
            $portalUser->stock_managment_delivery_receiving_system = true;
        }
        if($request->quarantine_managment && $request->quarantine_managment==="on"){
            $portalUser->quarantine_managamnet_and_customer_returns = true;
        }
        if($request->tray_managment_system && $request->tray_managment_system==="on"){
            $portalUser->tray_managment_system = true;
        }
        if($request->sales_and_dispatch && $request->sales_and_dispatch==="on"){
            $portalUser->sales_and_dispach = true;
        }
        if($request->stock_transfer && $request->stock_transfer==="on"){
            $portalUser->stock_transfer = true;
        }
        if($request->device_managment && $request->device_managment==="on"){
            $portalUser->device_managment = true;
        }
        if($request->box_managment_system && $request->box_managment_system==="on"){
            $portalUser->box_managment_system = true;
        }
        if($request->device_testing && $request->device_testing==="on"){
            $portalUser->device_testing = true;
        }
        if($request->user_managment && $request->user_managment==="on"){
            $portalUser->user_managment = true;
        }
        if($request->reports_and_statistics && $request->reports_and_statistics==="on"){
            $portalUser->reports_and_statistics = true;
        }

        $portalUser->save();

        return redirect('/portal/adminconsole/adduser');

    }


}
