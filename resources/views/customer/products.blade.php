<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>


        <header>@include('customer.layouts.header')</header>

        <h3>Avalible products from {{$category}} category</h3>
        @foreach($products as $product)

        <a href="/product/{{$product->id}}">{{$product->product_name}}</a>

        @endforeach

        <footer>@include('customer.layouts.footer')</footer>

        
    </body>
</html>