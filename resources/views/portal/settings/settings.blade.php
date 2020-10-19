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

    <title>Bamboo Recycle::Settings</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Settings</p>
                    </div>
                </div>
                <div class="portal-content-container">

                    <div class="d-flex flex-column align-items-center p-3 border border-dark rounded h-100 w-100 my-3">
                        <div class="d-flex flex-wrap w-100">
                            <a href="/portal/settings/product-options" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Product Options</p>
                                </div>
                            </a>
                            <a href="/portal/settings/conditions" class="col-2 my-2">
                                <div class="portal-content-element">
                                <p>Conditions</p>
                                </div>
                            </a>
                            <a href="/portal/settings/testing-questions" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Testing Questions</p>
                                </div>
                            </a>
                            <a href="/portal/settings/websites" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Websites</p>
                                </div>
                            </a>
                            <a href="/portal/settings/stores" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Stores</p>
                                </div>
                            </a>
                            <a href="/portal/settings/payments-options" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Payments Options</p>
                                </div>
                            </a>
                            <a href="/portal/settings/delivery-options" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Delivery Options</p>
                                </div>
                            </a>
                            <a href="/portal/settings/checkout-options" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Checkout Options</p>
                                </div>
                            </a>
                            <a href="/portal/settings/promotional-codes" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Promotional Codes</p>
                                </div>
                            </a>
                            <a href="/portal/settings/brands" class="col-2 my-2">
                                <div class="portal-content-element">
                                    <p>Manufacturers</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[9];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
