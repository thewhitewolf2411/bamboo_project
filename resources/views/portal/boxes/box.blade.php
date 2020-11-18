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

    <title>Bamboo Recycle::Box</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Box {{$box->box_name}}</p>
                    </div>
                </div>

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
                        <tr>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->id}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->box_name}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element">{{$box->description}}</div></a></td>
                            <td><a href="/portal/boxes/box?box_id_scan={{$box->box_name}}"><div class="table-element"></div></a></td>
                            <td><div class="table-element"><a onclick="return confirm('Are you sure? This will remove trolley from system and remove all trays and devices from the system?')" href="/portal/boxes/delete={{$box->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Box</p></div></a></div></td>
                            <td><div class="table-element"><a href="/portal/trolleys/trolley/printlabel/{{$box->box_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print box Label</p></div></a></div></td>
                        </tr>
                    </table>

                    <div class="portal-title-container">
                        <div class="portal-title">
                            <p>Box {{$box->trolley_name}} devices</p>
                        </div>
                    </div>

                    <a href="/portal/boxes/addtobox/{{$box->box_name}}">
                        <div class="btn btn-primary btn-red">
                            Add devices to box
                        </div>
                    </a>

                    <table class="portal-table" id="categories-table" style="margin-top:30px;">
                        <tr>
                            <td><div class="table-element">Device name</div></td>
                            <td><div class="table-element">Device barcode</div></td>
                        </tr>
                    </table>
                    
                </div>

            </div>
        </div>
    </main>

</body>

</html>
