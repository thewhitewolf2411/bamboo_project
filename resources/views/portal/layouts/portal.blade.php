<!DOCTYPE html>

<html>

<head>

    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.js" defer></script>-->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>
   <script src="{{ asset('js/Quarantine.js') }}"></script>

   <title>Bamboo Portal</title>

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app p-5">

            @yield('content')

        </div>
    </main>

</body>



</html>
