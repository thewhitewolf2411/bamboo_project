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

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Users</p>
                    </div>
                </div>
                <div class="portal-search-form-container">
                    <form action="/portal/user/search" method="POST" style="margin-bottom:50px;">
                        @csrf
                        <label for="">Search:</label>
                        <input id="searchinput" type="text" name="searchname" class="form-control">
                        <select class="form-control" id="search_by_field" name="select_search_by_field"><option value="1">User ID</option><option value="2" selected="">Name</option></select>

                    </form>
                    @if((Session::get('error') != null))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{Session::get('error')}}</li>
                            </ul>
                        </div>
                    @endif

                    @if(Session::has('success'))

                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>

                    @endif


                </div>

                <div></div>

                <div class="portal-table-container">

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td>Id</td>
                            <td>Username</td>
                            <td>First Name</td>
                            <td>Surename</td>
                            <td>Email Address</td>
                            <td>Created</td>
                            <td>Account disabled</td>
                            <td>
                                Options
                            </td>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>@if($user->account_disabled) Yes @else No @endif</td>
                            <td>
                                <div class="table-element">
                                    <a href="/portal/customer-care/seller/{{$user->id}}" title="See user details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if(!$user->account_disabled)
                                    <a onclick="return confirm('Are you sure? This will stop user from being able to do any purchases and/or buyings from customer website?')" href="/portal/customer-care/seller/disable/{{$user->id}}" title="Disable user account">
                                        <i class="fa fa-times remove"></i>
                                    </a>
                                    @else
                                    <a onclick="return confirm('Are you sure? This will stop user from being able to do any purchases and/or buyings from customer website?')" href="/portal/customer-care/seller/enable/{{$user->id}}" title="Enable user account">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </table>

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