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

    <title>Bamboo Recycle::Trolley</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Trolley {{$trolley->trolley_name}}</p>
                    </div>
                </div>

                <div class="portal-table-container">
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trolley ID</div></td>
                            <td><div class="table-element">Trolley</div></td>
                            <td><div class="table-element">No of Trays</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Trolley Type</div></td>
                            <td><div class="table-element">Delete Trolley</div></td>
                        </tr>
                        <tr>
                            <td><div class="table-element">{{$trolley->id}}</div></a></td>
                            <td><div class="table-element">{{$trolley->trolley_name}}</div></a></td>
                            <td><div class="table-element">{{$trolley->number_of_trays}}</div></a></td>
                            <td><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></a></td>
                            <td><div class="table-element">{{$trolley->trolley_type}}</div></a></td>
                            <td><div class="table-element"><a href="/portal/trolleys/trolley/printlabel/{{$trolley->id}}"><div class="btn btn-primary btn-blue"><p style="color: #fff;">Print Trolley label</p></div></a></div></td>
                        </tr>
                    </table>

                    <div class="portal-title-container">
                        <div class="portal-title">
                            <p>Trolley {{$trolley->trolley_name}} trays</p>
                        </div>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Tray ID</div></td>
                            <td><div class="table-element">Tray name</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                        </tr>
                        @foreach($trolleyTrays as $tray)
                        
                            <tr>
                                <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element">{{$tray->id}}</div></a></td>
                                <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element"><div class="table-element">{{$tray->tray_name}}</div></a></td>
                                <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element"><div class="table-element">{{$tray->number_of_devices}}</div></a></td>
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

    var elem = $('.portal-links-container > .portal-header-element')[12];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
