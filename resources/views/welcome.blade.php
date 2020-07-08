<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            @if(session('page'))
                @switch(session('page'))
                    @case("home")
                        @include('customer.home')
                        @break
                    @case("about")
                        @include('customer.about')
                        @break
                    @case("how")
                        @include('customer.how')
                        @break
                    @case("sell")
                        @include('customer.sell')
                        @break
                    @case("faqs")
                        @include('customer.faqs')
                        @break
                    @case("support")
                        @include('customer.support')
                        @break
                    @case("contact")
                        @include('customer.contact')
                        @break
                    @default
                        @include('customer.home')
                        @break
                @endswitch
            @else
                @include('customer.home')
            @endif
        </main>
        <footer>@include('customer.layouts.footer')</footer>

    </body>
</html>