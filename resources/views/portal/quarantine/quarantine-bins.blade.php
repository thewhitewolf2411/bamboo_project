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

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Quarantine Bins Overview</title>
    <script src="{{ asset('js/Quarantine.js') }}"></script>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app p-5">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Quarantine Bins Overview</p>
                    </div>
                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/quarantine/quarantine-bins/bin/" method="GET">
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label style="margin: 0;" for="tray_id_scan">Please Scan or Type the Bin Number:</label>
                            <input style="margin: 0; width: 50%;" class="form-control" name="bin_id_scan" id="bin_id_scan" autofocus>
                            <button type="submit" class="btn btn-primary btn-blue">Go</button>
                        </div>
                    </form>
                </div>
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>All bins</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    <div class="container">
                        <a href="/portal/quarantine/quarantine-bins/create"><div class="btn btn-primary btn-blue">
                            <p style="color: #fff;">Create Bin</p>
                        </div></a>
                    </div>

                    
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Bin ID</div></td>
                            <td><div class="table-element">Bin Location</div></td>
                            <td><div class="table-element">Device quantity</div></td>
                            <td><div class="table-element">Delete Bin</div></td>
                            <td><div class="table-element">Print Bin Label</div></td>
                        </tr>
                        @foreach($quarantineBins as $quarantineBin)
                        <tr>
                            <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->id}}</a></div></td>
                            <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->tray_name}}</a></div></td>
                            <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->number_of_devices}}</a></div></td>
                            <td><div class="table-element">@if($quarantineBin->number_of_devices == 0) <a onclick="return confirm('Are you sure? This will remove tray from system. This action cannot be reversed.')" href="/portal/quarantine-bins/delete/{{$quarantineBin->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Bin</p></div> @else This bin cannot be deleted. @endif</div></td>
                            <td><div class="table-element"><a href="/portal/quarantine-bins/printlabel/{{$quarantineBin->tray_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Bin Label</p></div></a></div></td>
                        </tr>
                        @endforeach
                    </table>

                </div>

            </div>

        </div>
    </main>


</body>
</html>
