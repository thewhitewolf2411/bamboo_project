<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>

        Portal
        <div class="portal-dashboard">

            <div class="portal-dashboard-elements">
                <h3> Warehouse Receipt & Dispatch Portal </h3>
                <div class="portal-elements-links-container">
                    @if($user_data->trade_pack_dispach_system || $user_data->superuser)
                    <a href="{{ url('/portal/dispachportal/tradepackdispach') }}"><p class="portal-elements-text">Trade Pack Dispach</p></a>
                    @endif
                    @if($user_data->dispach_portal_delivery_receiving_system || $user_data->superuser)
                    <a href="{{ url('/portal/dispachportal/deliveryreciving') }}"><p class="portal-elements-text">Delivery Receiving</p></a>
                    @endif
                </div>
            </div>

            <div class="portal-dashboard-elements">
                <h3> Warehouse Stock Management Portal </h3>
                <div class="portal-elements-links-container">
                    @if($user_data->device_tester_stock_managment || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/deviceteststockmanagment') }}"><p class="portal-elements-text">Device Tester Stock Managment</p></a>
                    @endif

                    @if($user_data->stock_managment_delivery_receiving_system || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/trolleymanagment') }}"><p class="portal-elements-text">Trolley Managment</p></a>
                    @endif

                    @if($user_data->tray_managment_system || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/trayymanagment') }}"><p class="portal-elements-text">Tray Managment</p></a>
                    @endif

                    @if($user_data->stock_transfer || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/stocktransfer') }}"><p class="portal-elements-text">Stock Transfer</p></a>
                    @endif

                    @if($user_data->stock_managment || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/stockmanagment') }}"><p class="portal-elements-text">Stock Managment</p></a>
                    @endif

                    @if($user_data->quarantine_managamnet_and_customer_returns || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/quarantinemanagment') }}"><p class="portal-elements-text">Quarantine Managment and Customer Returns</p></a>
                    @endif

                    @if($user_data->sales_and_dispach || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/salesanddispach') }}"><p class="portal-elements-text">Sales and Dispatch</p></a>
                    @endif

                    @if($user_data->device_managment || $user_data->superuser)
                    <a href="{{ url('/portal/stockportal/devicemanagment') }}"><p class="portal-elements-text">Device Managment</p></a>
                    @endif
                </div>
            </div>

            <div class="portal-dashboard-elements">
                <h3> Phone Testing Portal </h3>
                <div class="portal-elements-links-container">
                    @if($user_data->device_testing || $user_data->superuser)
                    <a href="{{ url('/portal/testingportal/devicetesting') }}"><p class="portal-elements-text">Device Testing</p></a>
                    @endif
                    @if($user_data->box_managment_system || $user_data->superuser)
                    <a href="{{ url('/portal/testingportal/boxmanagment') }}"><p class="portal-elements-text">Box Managment</p></a>
                    @endif
                </div>
            </div>

            <div class="portal-dashboard-elements">
                <h3> Customer Care Portal  </h3>
                <div class="portal-elements-links-container">
                    <a href="{{ url('/portal/careportal/addorder') }}"><p class="portal-elements-text">Create Order</p></a>
                    <a href="{{ url('/portal/careportal/searchorder') }}"><p class="portal-elements-text">Order Managmen</p></a>
                </div>
            </div>

            <div class="portal-dashboard-elements">
                <h3> Administration Portal  </h3>
                <div class="portal-elements-links-container">
                    <a href="{{ url('/portal/adminportal/sales') }}"><p class="portal-elements-text">Sales</p></a>
                    <a href="{{ url('/portal/adminportal/reports') }}"><p class="portal-elements-text">Reports and Statistics</p></a>
                    <a href="{{ url('/portal/adminportal/usermanagment') }}"><p class="portal-elements-text">User Managment</p></a>
                    <a href="{{ url('/portal/adminportal/testingmanagment') }}"><p class="portal-elements-text">Testing Managment</p></a>
                    <a href="{{ url('/portal/adminportal/customerpayment') }}"><p class="portal-elements-text">Customer Payment</p></a>
                    <a href="{{ url('/portal/adminportal/managemanufacturer') }}"><p class="portal-elements-text">Manage Make Model</p></a>
                </div>
            </div>

            <div class="portal-dashboard-elements">
                <h3> Warehouse Administration Console  </h3>
                <div class="portal-elements-links-container">
                    @if($user_data->superuser)
                    <a href="{{ url('/portal/adminconsole/adduser') }}"><p class="portal-elements-text">Create User</p></a>
                    @endif
                    @if($user_data->user_managment || $user_data->superuser)
                    <a href="{{ url('/portal/adminconsole/usermanagment') }}"><p class="portal-elements-text">User Managment</p></a>
                    @endif
                    @if($user_data->reports_and_statistics || $user_data->superuser)
                    <a href="{{ url('/portal/adminconsole/reports') }}"><p class="portal-elements-text">Reports and Statistics</p></a>
                    @endif
                </div>
            </div>

        </div>

        <footer>@include('customer.layouts.footer')</footer>    
    </body>
</html>