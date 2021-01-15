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

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Quarantine Overview</title>
    <script src="{{ asset('js/Quarantine.js') }}"></script>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app p-5">
            <div class="container-fluid">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Quarantine Overview</p>
                    </div>
                </div>

                <div class="">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in Barcode</div></td>
                            <td><div class="table-element">Model</div></td>
                            <td><div class="table-element">IMEI</div></td>
                            <td><div class="table-element">Bamboo Status</div></td>
                            <td><div class="table-element">Quarantine Reason</div></td>
                            <td><div class="table-element">Stock location</div></td>
                            <td><div class="table-element">Order Date</div></td>
                            <td><div class="table-element">Quarantine Date</div></td>
                            <td><div class="table-element">Bamboo Grade</div></td>
                            <td><div class="table-element">Tag</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)

                        <tr>
                            <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            <td><div class="table-element">{{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0]}}</div></td>
                            <td><div class="table-element">
                                @if($tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0] === "BLACKLISTED")
                                    Blacklisted
                                @else
                                    Not blacklisted
                                @endif
                            </div></td>
                            <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                            <td><div class="table-element">{{$tradein->created_at}}</div></td>
                            <td><div class="table-element">{{$tradein->quarantine_date}}</div></td>
                            <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                            <td><div class="table-element">Tag</div></td>
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
