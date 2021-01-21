<div class="portal-header-container">

    <div class="portal-header background-black">

        <div class="portal-header-element">
            <a class="navbar-brand" href="/portal">MOBILE</a>
        </div>
        <div class="portal-links-container">

            @if($portalUser->recycle)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Recycle
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if($portalUser->trade_pack_despatch)<a class="dropdown-item" href="/portal/customer-care/trade-in/all">Trade-pack Despatch</a>@endif
                    @if($portalUser->awaiting_receipt)<a class="dropdown-item" href="/portal/customer-care/trade-pack">Awaiting Receipt</a>@endif
                    @if($portalUser->receiving)<a class="dropdown-item" href="/portal/testing/receive">Receiving</a>@endif
                    @if($portalUser->device_testing)<a class="dropdown-item" href="/portal/testing/find">Device Testing</a>@endif
                    @if($portalUser->trolley_management)<a class="dropdown-item" href="/portal/trolleys">Trolley Management</a>@endif
                    @if($portalUser->trays_managment)<a class="dropdown-item" href="/portal/trays">Trays Management</a>@endif
                    @if($portalUser->box_management)<a class="dropdown-item" href="/portal/boxes">Box Management</a>@endif
                    @if($portalUser->quarantine_managment)<a class="dropdown-item" href="/portal/quarantine">Quarantine Management</a>@endif
                    @if($portalUser->warehouse_management)<a class="dropdown-item" href="#">Warehouse Management</a>@endif
                </div>
            </div>
            @endif

            @if($portalUser->buying)
            <!--
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    E-commerce
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if($portalUser->ecommerence_orders)<a class="dropdown-item" href="/portal/ecommerence/order-management">Order Management</a>@endif
                    @if($portalUser->ecommerence_users)<a class="dropdown-item" href="/portal/ecommerence/customer-accounts">Customer accounts</a>@endif
                    @if($portalUser->selling_status)<a class="dropdown-item" href="/portal/ecommerence/order-status">Order Status</a>@endif
                </div>
            </div>
            -->
            @endif

            @if($portalUser->customer_care)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customer Care
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if($portalUser->trade_pack_despatch)<a class="dropdown-item" href="/portal/customer-care/order-managment">Order Management</a>@endif
                    @if($portalUser->order_management)<a class="dropdown-item" href="/portal/customer-care/createorder">Create Order</a>@endif
                    @if($portalUser->create_order)<a class="dropdown-item" href="/portal/customer-care/seller">Customer Accounts</a>@endif
                </div>
            </div>
            @endif

            @if($portalUser->administration)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administration
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if($portalUser->salvage_models)<a class="dropdown-item" href="/portal/product/selling-products">Salvage Models</a>@endif
                    @if($portalUser->sales_models)<a class="dropdown-item" href="/portal/product/buying-products">Sales Models</a>@endif
                    @if($portalUser->feeds)<a class="dropdown-item" href="/portal/feeds">Feeds</a>@endif
                    @if($portalUser->users)<a class="dropdown-item" href="/portal/user">Users</a>@endif
                    @if($portalUser->reports)<a class="dropdown-item" href="/portal/reports">Reports</a>@endif
                    @if($portalUser->cms)<a class="dropdown-item" href="/portal/cms">CMS</a>@endif
                    @if($portalUser->categories)<a class="dropdown-item" href="/portal/categories">Categories</a>@endif
                    @if($portalUser->settings)<a class="dropdown-item" href="/portal/settings">Settings</a>@endif
                </div>
            </div>
            @endif

            @if($portalUser->payments)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Payments
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if($portalUser->payments_awaiting_assignment)<a class="dropdown-item" href="/portal/payments/awaiting">Payments Awaiting Assignment</a>@endif
                    @if($portalUser->pending_payments)<a class="dropdown-item" href="/portal/payments/pending">Pending Payments</a>@endif
                    @if($portalUser->completed_payment)<a class="dropdown-item" href="/portal/payments/completed">Completed Payments</a>@endif
                    @if($portalUser->payment_report)<a class="dropdown-item" href="/portal/payments/reports">Payment Reports</a>@endif
                </div>
            </div>
            @endif

        </div>
        <div class="portal-header-element">
            <a href="/logout"><i class="fa fa-sign-out"></i></a>
        </div>

    </div>

</div>


