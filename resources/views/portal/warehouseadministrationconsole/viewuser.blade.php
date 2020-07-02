<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>@include('portal.layouts.header')</header>

        <div class="portal-header-container">
            <h3>Create user</h3>
        </div>

        <div class="portal-form-container">

            <form action="{{url('/portal/adminconsole/adduser/change')}}" method="post">
                @csrf
                <div class="emplyee-details">
                    <h4>Employee Details</h4>

                    <div class="emloyee-details-form">
                        <input type="hidden" name="user_id" value="{{$user->id}}"></input>
                        <label>First Name:</label>
                        <input type="text" name="first_name" required value="{{$user->first_name}}"></input>
                        <label>Surename:</label>
                        <input type="text" name="surename" required value="{{$user->surename}}"></input>
                        <label>Username:</label>
                        <input type="text" name="username" required value="{{$user->username}}"></input>
                        <label>Password:</label>
                        <input type="password" name="password" required value="{{$user->password}}"></input>

                    </div>

                </div>

                <div class="access-privileges">

                    <div class="access-details-container">
                        <p>Warehouse Receipt & Dispatch Portal</p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="trade_pack_dispatch_system" @if($portalUser->trade_pack_dispach_system) checked @endif>
                            <label for="trade_pack_dispatch_system">Trade Pack Dispatch System</label>
                            <input type="checkbox" id="scales" name="receipt_and_dispatch_delivery_receiving_system" @if($portalUser->dispach_portal_delivery_receiving_system) checked @endif>
                            <label for="receipt_and_dispatch_delivery_receiving_system">Delivery Receiving System</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Warehouse Stock Management Portal </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="device_tester_stock_managment" @if($portalUser->device_tester_stock_managment) checked @endif>
                            <label for="device_tester_stock_managment">Device Tester Stock Managment</label>
                            <input type="checkbox" id="scales" name="stock_managment" @if($portalUser->stock_managment) checked @endif>
                            <label for="stock_managment">Stock Managment</label>
                            <input type="checkbox" id="scales" name="stock_managment_delivery_receiving_system" @if($portalUser->stock_managment_delivery_receiving_system) checked @endif>
                            <label for="stock_managment_delivery_receiving_system">Delivery Receiving System</label>
                            <input type="checkbox" id="scales" name="quarantine_managment" @if($portalUser->quarantine_managamnet_and_customer_returns) checked @endif>
                            <label for="quarantine_managment">Quarantine Management & Customer Returns</label>
                            <input type="checkbox" id="scales" name="tray_managment_system" @if($portalUser->tray_managment_system) checked @endif>
                            <label for="tray_managment_system">Tray Managment System</label>
                            <input type="checkbox" id="scales" name="sales_and_dispatch" @if($portalUser->sales_and_dispach) checked @endif>
                            <label for="sales_and_dispatch">Sales & Dispatch</label>
                            <input type="checkbox" id="scales" name="stock_transfer" @if($portalUser->stock_transfer) checked @endif>
                            <label for="stock_transfer">Stock Transfer</label>
                            <input type="checkbox" id="scales" name="device_managment" @if($portalUser->device_managment) checked @endif>
                            <label for="device_managment">Device Managment</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Phone Testing Portal </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="box_managment_system" @if($portalUser->box_managment_system) checked @endif>
                            <label for="box_managment_system">Box Managment System</label>
                            <input type="checkbox" id="scales" name="device_testing" @if($portalUser->device_testing) checked @endif>
                            <label for="device_testing">Device Testing</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Warehouse Administration Console </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="user_managment" @if($portalUser->user_managment) checked @endif>
                            <label for="user_managment">User Managment</label>
                            <input type="checkbox" id="scales" name="reports_and_statistics" @if($portalUser->reports_and_statistics) checked @endif>
                            <label for="reports_and_statistics">Reports & Statistics</label>
                        </div>
                    </div>

                </div>

                <div class="submit-container">
                    <input type="submit" value="Change User">
                </div>
            </form>

        </div>


    </body>
</html>