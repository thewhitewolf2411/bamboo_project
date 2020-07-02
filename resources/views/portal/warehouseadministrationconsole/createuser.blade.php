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

            <form action="{{url('/portal/adminconsole/adduser/add')}}" method="post">
                @csrf
                <div class="emplyee-details">
                    <h4>Employee Details</h4>

                    <div class="emloyee-details-form">

                        <label>First Name:</label>
                        <input type="text" name="first_name" required></input>
                        <label>Surename:</label>
                        <input type="text" name="surename" required></input>
                        <label>Username:</label>
                        <input type="text" name="username" required></input>
                        <label>Password:</label>
                        <input type="password" name="password" required></input>

                    </div>

                </div>

                <div class="access-privileges">

                    <div class="access-details-container">
                        <p>Warehouse Receipt & Dispatch Portal</p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="trade_pack_dispatch_system" >
                            <label for="trade_pack_dispatch_system">Trade Pack Dispatch System</label>
                            <input type="checkbox" id="scales" name="receipt_and_dispatch_delivery_receiving_system" >
                            <label for="receipt_and_dispatch_delivery_receiving_system">Delivery Receiving System</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Warehouse Stock Management Portal </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="device_tester_stock_managment" >
                            <label for="device_tester_stock_managment">Device Tester Stock Managment</label>
                            <input type="checkbox" id="scales" name="stock_managment" >
                            <label for="stock_managment">Stock Managment</label>
                            <input type="checkbox" id="scales" name="stock_managment_delivery_receiving_system" >
                            <label for="stock_managment_delivery_receiving_system">Delivery Receiving System</label>
                            <input type="checkbox" id="scales" name="quarantine_managment" >
                            <label for="quarantine_managment">Quarantine Management & Customer Returns</label>
                            <input type="checkbox" id="scales" name="tray_managment_system" >
                            <label for="tray_managment_system">Tray Managment System</label>
                            <input type="checkbox" id="scales" name="sales_and_dispatch" >
                            <label for="sales_and_dispatch">Sales & Dispatch</label>
                            <input type="checkbox" id="scales" name="stock_transfer" >
                            <label for="stock_transfer">Stock Transfer</label>
                            <input type="checkbox" id="scales" name="device_managment" >
                            <label for="device_managment">Device Managment</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Phone Testing Portal </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="box_managment_system" >
                            <label for="box_managment_system">Box Managment System</label>
                            <input type="checkbox" id="scales" name="device_testing" >
                            <label for="device_testing">Device Testing</label>
                        </div>
                    </div>
                    <div class="access-details-container">
                        <p>Warehouse Administration Console </p>
                        <div class="access-details">
                            <input type="checkbox" id="scales" name="user_managment" >
                            <label for="user_managment">User Managment</label>
                            <input type="checkbox" id="scales" name="reports_and_statistics" >
                            <label for="reports_and_statistics">Reports & Statistics</label>
                        </div>
                    </div>

                </div>

                <div class="submit-container">
                    <input type="submit" value="Create User">
                </div>
            </form>

        </div>


    </body>
</html>