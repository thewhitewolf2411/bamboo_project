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

    <title>Bamboo Recycle::User {{$user->id}}</title>
</head>


<body class="portal-body">



    <header>@include('portal.layouts.header')</header>
    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>View User "{{$user->first_name}} {{$user->last_name}}"</p>
                    </div>
                </div>
                <div class="portal-content-container">
                    <div class="w-100 details">
                        <div class="portal-title">
                            <p class="text-secondary" style="font-size: 14pt; font-weight: 300; border-bottom: 1px solid #000;">Trade-in Summary</p>
                        </div>
                        <div class="d-flex w-100">
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>User first name:</p>
                                    <p>User last name:</p>
                                    <p>User delivery address:</p>
                                    <p>User billing address:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>{{$user->first_name}}</p>
                                    <p>{{$user->last_name}}</p>
                                    <p>{{$user->delivery_address}}</p>
                                    <p>{{$user->billing_address}}</p>
                                </div>
                            </div>
                            <div class="d-flex w-50">
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p>Number of sales made:</p>
                                    <p>Number of sales finished: </p>
                                    <p>Date of registration:</p>
                                </div>
                                <div class="d-flex flex-column w-50 justify-content-between">
                                    <p></p>
                                    <p></p>
                                    <p>{{$user->created_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
</body>