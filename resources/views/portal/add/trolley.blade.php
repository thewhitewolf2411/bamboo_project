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

    <title>Bamboo Recycle::Add Trolley</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Add Trolley</p>
                    </div>
                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/trolleys/createtrolley" method="POST">
                    @csrf
                        <div class="container form-group d-flex flex-column align-items-center justify-content-between">
                           
                            <input required style="margin: 0; width: 30%; margin-bottom:15px;" class="p-2 form-control" type="text" name="trolley_name" id="trolley_name" placeholder="Trolley Name">
                            <select name="trolley_type" required style="margin:0; width:30%; margin-bottom:15px;" class="p-2 form-control">
                                <option value="">Choose Trolley Type:</option>
                                <option value="1">Testing</option>
                                <option value="2">New</option>
                                <option value="3">Working A</option>
                                <option value="4">Working B</option>
                                <option value="5">Working C</option>
                                <option value="6">Faulty</option>
                                <option value="7">Damaged</option>
                                <option value="8">Quarantine</option>
                                <option value="9">Risk</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-blue">Create Tray</button>
                        </div>
                    </form>
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
