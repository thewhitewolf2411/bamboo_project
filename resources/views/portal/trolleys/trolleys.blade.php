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

    <title>Bamboo Recycle::Trolley Managment</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Trolley managment</p>
                    </div>
                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/trolleys/trolley" method="GET">
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label style="margin: 0;" for="trolley_id_scan">Please Scan or Type the Trolley Number:</label>
                            <input style="margin: 0; width: 50%;" class="form-control" type="number" name="trolley_id_scan" id="trolley_id_scan" autofocus>
                            <button type="submit" class="btn btn-primary btn-blue">Go</button>
                        </div>
                    </form>
                </div>
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>All trolleys</p>
                    </div>
                </div>

                <div class="portal-table-container">
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trolley ID</div></td>
                            <td><div class="table-element">Trolley</div></td>
                            <td><div class="table-element">No of Trays</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Trolley Type</div></td>
                            <td><div class="table-element">Delete Trolley</div></td>
                            <td><div class="table-element">Print Trolley Label</div></td>
                        </tr>
                        @foreach($trolleys as $trolley)
                        <tr>
                            <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->id}}"><div class="table-element">{{$trolley->id}}</div></a></td>
                            <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->id}}"><div class="table-element">{{$trolley->trolley_name}}</div></a></td>
                            <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->id}}"><div class="table-element">{{$trolley->number_of_trays}}</div></a></td>
                            <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->id}}"><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></a></td>
                            <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->id}}"><div class="table-element">{{$trolley->trolley_type}}</div></a></td>
                            <td><div class="table-element"><a href="/portals/trolleys/delete/{{$trolley->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Trolley</p></div></a></div></td>
                            <td><div class="table-element"><a href="/portal/trolleys/trolley/printlabel/{{$trolley->trolley_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Trolley Label</p></div></a></div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="container">
                    <a href="/portal/trolleys/create"><div class="btn btn-primary btn-blue">
                        <p style="color: #fff;">Create Trolley</p>
                    </div></a>
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
