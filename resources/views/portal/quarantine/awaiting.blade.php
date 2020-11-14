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

    <title>Bamboo Recycle::Products Awaiting Seller Response</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Products Awaiting Seller Response</p>
                    </div>
                </div>

                @if(Session::has('success'))

                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>

                @endif

                @if(Session::has('error'))

                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>

                @endif

                <div class="portal-table-container">
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in Barcode</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Quarantine reasons</div></td>
                            <td><div class="table-element">Device location</div></td>
                            <td><div class="table-element">Options</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->id}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">
                                <ul>
                                    @if($tradein->device_correct == false)<li>Device was not correct</li>@endif
                                    @if($tradein->checkmend_passed == false)<li>Phonecheck failed</li>@endif
                                    @if($tradein->grade_changed == true)<li>Device grade was changed</li>@endif
                                    @if($tradein->older_than_14_days == true)<li>Order was expired after 14 days</li>@endif
                                </ul>
                            </div></td>
                            <td><div class="table-element"><p>Device is in a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a></p></div></td>
                            <td><div class="table-element">
                            
                            </div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[3];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
