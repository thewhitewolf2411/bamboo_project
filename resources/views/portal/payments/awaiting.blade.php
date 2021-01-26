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

    <title>Bamboo Recycle::Payments Awaiting Assignment</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p class="pt-2 text-center">Awaiting Payments</p>

                        
                    </div>
                </div>

                <div class="m-auto w-75">
                    <form class="d-flex align-items-center mx-5 text-center" action="/portal/payments/awaiting" method="GET">              
                        <label for="searchtradeins">Search by Trade-in barcode / Trade-in ID:</label>
                        <input type="text" minlength="7" name="search" class="form-control mx-3 my-0">
                        <button type="submit" class="btn btn-primary btn-blue">Search</button>
                    </form>
                    <div class="mt-4">
                        <div class="btn btn-primary btn-blue w-25 m-auto" style="display:block;" onclick="createBatch()">New Batch</div>
                    </div>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Trays</h5>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Tray ID</div></td>
                            <td><div class="table-element">Tray name</div></td>
                            <td><div class="table-element">Assigned trolley</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Print Tray Label</div></td>
                        </tr>
                        @foreach($trays as $tray)
                        <tr>
                            <td><div class="table-element">{{$tray->id}}</div></a></td>
                            <td><div class="table-element">{{$tray->tray_name}}</div></a></td>
                            <td><div class="table-element">@if($tray->trolley_id == null) <p style="color:red;">Unassigned</p> @else <p style="color:green;"> {{$tray->getTrolleyName($tray->trolley_id)}} </p> @endif</div></a></td>
                            <td><div class="table-element">{{$tray->getTrayNumberOfDevices($tray->id)}}</div></a></td>
                            <td><div class="table-element"><a href="/portal/trays/tray/printlabel/{{$tray->tray_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Tray Label</p></div></a></div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Trolleys</h5>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trolley ID</div></td>
                            <td><div class="table-element">Trolley</div></td>
                            <td><div class="table-element">No of Trays</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Print Trolley Label</div></td>
                        </tr>
                        @foreach($trolleys as $trolley)
                        <tr>
                            <td><div class="table-element">{{$trolley->id}}</div></td>
                            <td><div class="table-element">{{$trolley->trolley_name}}</div></td>
                            <td><div class="table-element">{{$trolley->number_of_trays}}</div></td>
                            <td><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></td>
                            <td><div class="table-element"><a href="/portal/trolleys/trolley/printlabel/{{$trolley->trolley_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Trolley Label</p></div></a></div></td>
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

    var elem = $('.portal-links-container > .portal-header-element')[5];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

function createBatch(){
    alert('create batch');
}

</script>


</html>
