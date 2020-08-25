<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Mobile</p>
                    </div>
                </div>
                <div class="portal-content-container">
                    <a href="/portal/customer-care">
                        <div class="portal-content-element">
                            <p><i class="fa fa-child"></i>Customer Care</p>
                        </div>
                    </a>
                    <a href="/portal/categories">
                        <div class="portal-content-element">
                        <p><i class="fa fa-folder-open-o"></i>Categories / Brands</p>
                        </div>
                    </a>
                    <a href="/portal/product">
                        <div class="portal-content-element">
                            <p><i class="fa fa-barcode"></i>Product</p>
                        </div>
                    </a>
                    <a href="/portal/quarantine">
                        <div class="portal-content-element">
                            <p><i class="fa fa-stethoscope"></i>Quarantine</p>
                        </div>
                    </a>
                    <a href="/portal/testing">
                        <div class="portal-content-element">
                            <p><i class="fa fa-tachometer"></i>Testing</p>
                        </div>
                    </a>
                    <a href="/portal/payments">
                        <div class="portal-content-element">
                            <p><i class="fa fa-credit-card"></i>Payments</p>
                        </div>
                    </a>
                    <a href="/portal/reports">
                        <div class="portal-content-element">
                            <p><i class="fa fa-line-chart"></i>Reports</p>
                        </div>
                    </a>
                    <a href="/portal/feeds">
                        <div class="portal-content-element">
                            <p><i class="fa fa-cloud-download"></i>Feeds</p>
                        </div>
                    </a>
                    <a href="/portal/user">
                        <div class="portal-content-element">
                            <p><i class="fa fa-user"></i>Users</p>
                        </div>
                    </a>
                    <a href="/portal/settings">
                        <div class="portal-content-element">
                            <p><i class="fa fa-cogs"></i>Settings</p>
                        </div>
                    </a>
                    <a href="/portal/cms">
                        <div class="portal-content-element">
                        <p><i class="fa fa-file"></i>CMS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>



</html>
