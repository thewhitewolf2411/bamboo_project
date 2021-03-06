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

    <script src="/js/PrintTradeIn.js"></script>

    <title>Bamboo Recycle::Tray Content</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Tray Content</p>
                    </div>
                </div>

                    @foreach($tradeins as $tradein)
                        <a onclick="selectDeviceForTesting({{$tradein->barcode}})" class="ml-0 mr-0"><div class="d-flex flex-column shadow bg-white rounded ml-5 mr-5 p-3 hover">
                            <div class="" style="width:200px;">Product name: {{$tradein->getProductName($tradein->product_id)}}</div>
                            <div class="" style="width:200px;">Customer grade: {{$tradein->customer_grade}}</div>
                            <div class="" style="width:200px;">Price {{$tradein->getProductPrice($tradein->product_id, $tradein->customer_grade)}} £</div>
                        </div></a>
                    @endforeach

                <form id="select_device_for_testing_form" action="/portal/testing/find/find" method="POST" style="display:none;">
                    @csrf
                    <input id="searchinput" type="number" name="scanid" class="form-control" autofocus>
                    <button id="select_device_for_testing_button" type="submit" class="btn btn-primary btn-blue">Search</button>
                </form>

            </div>
        </div>
    </main>

</body>
</html>
