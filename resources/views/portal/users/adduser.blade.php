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

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>{{$title}}</p>
                    </div>
                </div>
                @if(Session::get('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{Session::get('error')}}</li>
                        </ul>
                    </div>
                @endif
                <div class="register-form-container">
                    <form method="POST" action="/portal/user/adduser">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group p20">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                            </div>
                            <div class="form-group p20">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-group p20">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="form-group p20">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group p20">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group p20">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                        </div>
                        <div class="portal-title">
                            <p>Access Level</p>
                        </div>
                        <div class="d-flex flex-wrap p20 access-container">
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="customer_care" id="customer_care">
                                <label class="form-check-label" for="customer_care">Customer Care</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="categories" id="categories">
                                <label class="form-check-label" for="categories">Categories</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="product" id="product">
                                <label class="form-check-label" for="product">Product</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="quarantine" id="quarantine">
                                <label class="form-check-label" for="quarantine">Quarantine</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="testing" id="testing">
                                <label class="form-check-label" for="testing">Testing</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="payments" id="payments">
                                <label class="form-check-label" for="payments">Payments</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="reports" id="reports">
                                <label class="form-check-label" for="reports">Reports</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="feeds" id="feeds">
                                <label class="form-check-label" for="feeds">Feeds</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="users" id="users">
                                <label class="form-check-label" for="users">Users</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="settings" id="settings">
                                <label class="form-check-label" for="settings">Settings</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="cms" id="cms">
                                <label class="form-check-label" for="cms">CMS</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="trays" id="trays">
                                <label class="form-check-label" for="cms">Trays Managment</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="trolleys" id="trolleys">
                                <label class="form-check-label" for="cms">Trolley Managment</label>
                            </div>
                            <div class="form-group p20 w-25">
                                <input type="checkbox" class="form-check-input" name="boxes" id="boxes">
                                <label class="form-check-label" for="cms">Box Managment</label>
                            </div>
                        </div>
                        <div class="form-group p20">
                            <button type="submit" class="btn btn-primary btn-blue">Add new user</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

</body>



</html>


<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[8];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>