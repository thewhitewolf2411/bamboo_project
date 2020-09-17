<div class="portal-header-container">

    <div class="portal-header background-black">

        <div class="portal-header-element">
            <a class="navbar-brand" href="/portal">MOBILE</a>
        </div>
        <div class="portal-links-container">
            @if($portalUser->customer_care)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/customer-care"><i class="fa fa-child"></i>Customer Care</a>
            </div>
            @endif
            @if($portalUser->categories)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/categories"><i class="fa fa-folder-open-o"></i>Categories</a>
            </div>
            @endif
            @if($portalUser->product)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/product"><i class="fa fa-barcode"></i>Product</a>
            </div>
            @endif
            @if($portalUser->quarantine)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/quarantine"><i class="fa fa-stethoscope"></i>Quarantine</a>
            </div>
            @endif
            @if($portalUser->testing)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/testing"><i class="fa fa-tachometer"></i>Testing</a>
            </div>
            @endif
            @if($portalUser->payments)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/payments"><i class="fa fa-credit-card"></i>Payments</a>
            </div>
            @endif
            @if($portalUser->reports)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/reports"><i class="fa fa-line-chart"></i>Reports</a>
            </div>
            @endif
            @if($portalUser->feeds)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/feeds"><i class="fa fa-cloud-download"></i>Feeds</a>
            </div>
            @endif
            @if($portalUser->users)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/user"><i class="fa fa-user"></i>Users</a>
            </div>
            @endif
            @if($portalUser->settings)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/settings"><i class="fa fa-cogs"></i>Settings</a>
            </div>
            @endif
            @if($portalUser->cms)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/cms"><i class="fa fa-file"></i>CMS</a>
            </div>
            @endif
            @if($portalUser->trays)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/trays"><i class="fa fa-inbox"></i>Trays</a>
            </div>
            @endif
            @if($portalUser->trolleys)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/trays"><i class="fa fa-shopping-cart"></i>Trolleys</a>
            </div>
            @endif
            @if($portalUser->boxes)
            <div class="portal-header-element">
                <a class="menu_button_text" href="/portal/boxes"><i class="fa fa-cube"></i>Boxes</a>
            </div>
            @endif
        </div>
        <div class="portal-header-element">
            <a href="/logout"><i class="fa fa-sign-out"></i></a>
        </div>

    </div>

</div>


