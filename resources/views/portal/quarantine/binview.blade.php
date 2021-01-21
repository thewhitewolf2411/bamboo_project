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

    <title>Bamboo Recycle::Bin</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Bin {{$bin->bin_name}}</p>
                    </div>
                </div>

                @if(Session::has('success'))

                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>

                @endif
                <form method="post" action="/portal/quarantine-bins/{{$bin->bin_name}}/allocatedevice">
                    @csrf
                <div class="row mb-3">
                    <!-- Check security issues later -->
                    <div class="col-md-2">
                        <input id="export_csv" type="submit" class="custombtn btn-green" value="Allocate devices">
                    </div>
                </div>
                <div class="portal-table-container">
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Bin Location</div></td>
                            <td><div class="table-element">Device Quantity</div></td>
                            <td><div class="table-element">Print Label</div></td>
                        </tr>
                        <tr>
                            <td><div class="table-element">{{$bin->bin_name}}</div></td>
                            <td><div class="table-element">{{$bin->device_quantity}}</div></td>
                            <td><div class="table-element"><a href="/portal/quarantine-bins/printlabel/{{$bin->bin_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Bin Label</p></div></a></div></td>
                        </tr>
                    </table>

                    <div class="portal-title-container">
                        <div class="portal-title">
                            <p>Bin {{$bin->bin_name}} Content</p>
                        </div>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Tradein Barcode</div></td>
                            <td><div class="table-element">Product name</div></td>
                            <td><div class="table-element">IMEI Number</div></td>
                        </tr>
                        @foreach($quarantineBinContent as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </main>

</body>

</html>
