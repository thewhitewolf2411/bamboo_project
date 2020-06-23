<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        @php
        $i = 0
        @endphp
        @foreach($products as $cartProduct)
            <div>
                <p>{{$cartProduct[0]->product_name}}</p>

                <form action="/removefromcart" method="post">
                    @csrf
                    <input type="hidden" value="{{$i++}}" name="deleteid"></input>
                    <input type="submit" value="Remove from cart"></input>
                </form>
            </div>

        @endforeach
        @if(Session::has('cart'))
        <form action="/checkoutcart" method="post">
            @csrf

            <input type="submit" value="Confirm"></input>
        </form>
        @else
        <p>Your basket is empty</p>
        @endif

        <footer>@include('customer.layouts.footer')</footer>    
    </body>
</html>