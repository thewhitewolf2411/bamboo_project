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
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
              crossorigin="anonymous"></script>
    
              <script src="/js/PrintTradeIn.js"></script>

    <title>Bamboo Recycle::Receive Trade-In</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Process Trade-In #{{$tradein->barcode}}</p>
                    </div>
                </div>
                <div class="portal-search-form-container">

                    <div class="d-flex flex-column portal-search-form-container">
                       
                        <form action="/portal/testing/receive/printnewlabel" method="POST" class="d-flex flex-column">
                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Status</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    @if($tradein->marked_for_quarantine)
                                    <div class="d-flex w-50 border p-3"><p>This device has been marked for quarantine because:</p><br>
                                        <ul>
                                            @if($tradein->device_missing == true) <li><p>Device is Missing</p></li> @endif
                                            @if(isset($tradein->chekmend_passed) == true && $tradein->chekmend_passed == false) <li><p>Device IMEI Check failed</p></li> @endif
                                        </ul>
                                    </div>
                                    @else
                                    <div class="d-flex w-50 border p-3">
                                    
                                        <p>This device has passed receiving part of the testing.</p><br>

                                    </div>
                                    @endif
                                </div>
                                <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                    <a href="/portal/testing/checkimeiresult/{{$tradein->id}}" style="margin: 0;">
                                        <div class="btn btn-primary btn-blue">
                                            <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                        </div>
                                    </a>
                                    <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Print new label and allocate device to tray. </button>
                                </div>
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </main>

</body>
</html>
