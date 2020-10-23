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
                        <p>Boxes managment</p>
                    </div>
                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/trolleys/trolley" method="GET">
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label style="margin: 0;" for="trolley_id_scan">Please Scan or Type the Box Number:</label>
                            <input style="margin: 0; width: 50%;" class="form-control" type="number" name="trolley_id_scan" id="trolley_id_scan" autofocus>
                            <button type="submit" class="btn btn-primary btn-blue">Go</button>
                        </div>
                    </form>
                </div>

                <div class="container">
                    <a href="/portal/boxes/create"><div class="btn btn-primary btn-blue">
                        <p style="color: #fff;">Create Box</p>
                    </div></a>
                </div>

                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>All boxes</p>
                    </div>
                </div>

                @if(Session::has('success'))

                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>

                @endif

                <div class="portal-table-container">
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Box ID</div></td>
                            <td><div class="table-element">Box name</div></td>
                            <td><div class="table-element">Box Description</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Delete Box</div></td>
                            <td><div class="table-element">Print Box Label</div></td>
                        </tr>
                        @foreach($boxes as $box)
                        <tr>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->id}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->box_name}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->description}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element"></div></a></td>
                            <td><div class="table-element"><a onclick="return confirm('Are you sure? This will remove box from system and remove and devices in the the box from the system?')" href="/portal/boxes/delete/{{$box->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Box</p></div></a></div></td>
                            <td><div class="table-element"><a href="/portal/trolleys/trolley/printlabel/{{$box->box_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print box Label</p></div></a></div></td>
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
