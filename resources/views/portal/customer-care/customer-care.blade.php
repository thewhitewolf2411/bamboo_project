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

    <title>Bamboo Recycle::Customer Care</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Customer Care</p>
                    </div>
                </div>
                <div class="portal-content-container">
                    <a href="/portal/customer-care/trade-in/all/">
                        <div class="portal-content-element">
                        <p><i class="fa fa-shopping-cart"></i>Recycle</p>
                        </div>
                    </a>
                    <a href="/portal/customer-care/trade-out">
                        <div class="portal-content-element">
                        <p><i class="fa fa-shopping-cart"></i>Sellings</p>
                        </div>
                    </a>
                    <a href="/portal/customer-care/destroy-device">
                        <div class="portal-content-element">
                        <p><i class="fa fa-trash-o"></i>Devices to be destroyed</p>
                        </div>
                    </a>
                    <a href="/portal/customer-care/trade-pack">
                        <div class="portal-content-element">
                        <p><i class="fa fa-envelope-o"></i>Awaiting Receipt</p>
                        </div>
                    </a>
                    <a href="/portal/customer-care/seller">
                        <div class="portal-content-element">
                        <p><i class="fa fa-child"></i>Customers</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
