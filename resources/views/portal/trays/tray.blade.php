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

    <title>Bamboo Recycle::Tray</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Tray {{$tray->id}}</p>
                    </div>
                </div>

                <div class="portal-table-container">
                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Tray ID</div></td>
                            <td><div class="table-element">Tray name</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                            <td><div class="table-element">Print tray Label</div></td>
                            <td><div class="table-element">Assign tray to trolley</div></td>
                        </tr>
                        <tr>
                            <td><div class="table-element">{{$tray->id}}</div></td>
                            <td><div class="table-element">{{$tray->tray_name}}</div></td>
                            <td><div class="table-element">{{$tray->number_of_devices}}</div></td>
                            <td><div class="table-element"><a href="/portal/trays/tray/printlabel/{{$tray->id}}"><div class="btn btn-primary btn-blue"><p style="color:#fff">Print Tray label</p></div></a></div></td>
                            <td><div class="table-element">

                                <form action="/portal/trays/tray/addtotrolley" class="d-flex flex-column" onsubmit="return confirm('Are you sure you want to change assigned trolley of this tray?')" method="post">
                            
                                    @csrf
                                    <input type="hidden" name="tray_id" value="{{$tray->id}}">
                                    <select required class="form-control" name="trolley_select">
                                        <option value="" disabled @if($tray->trolley_id == null) selected @endif >Select Trolley</option>
                                        @foreach($trolleys as $trolley)
                                        <option value="{{$trolley->id}}" @if($tray->trolley_id == $trolley->id) selected @endif >{{$tray->getTrolleyName($trolley->id)}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <button type="submit" class="btn btn-primary btn-blue">Submit</button>
                                </form>


                            </div></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[11];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
