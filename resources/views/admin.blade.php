<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>

        Admin

        <div>

            <p>Some message title</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non pretium augue. Proin interdum erat non justo laoreet, quis ornare odio molestie. Duis sed imperdiet nisi. Nam commodo quis enim ut malesuada. Curabitur ullamcorper quam erat, ac porta enim dapibus nec. Aliquam erat volutpat. Pellentesque commodo nunc diam, nec bibendum nisl commodo id. Suspendisse potenti. Integer id libero eu quam rhoncus luctus sit amet eu nibh. Proin sed mauris non quam porttitor sagittis rhoncus id leo. </p>

        </div>

        <a href="{{ url('/admin/sales') }}">Sales</a>
        <a href="{{ url('/admin/customers') }}">Customers</a>
        <a href="{{ url('/admin/products') }}">Products</a>
        <a href="{{ url('/admin/search') }}">Search</a>
        <a href="{{ url('/admin/reports') }}">Reports</a>
        <a href="{{ url('/admin/options') }}">Options</a>

        <div style="display:flex; flex-direction:row; justify-content:space-between;">

            <div style="width:33%; max-width:33%; padding:15px;">
                <h5>Messages and News </h5>
                <h6>Welcome to the new OnCommerce Administration Console</h6>
                <p>While we have performed extensive testing there may still be bugs and problems, if you encounter any issues please let us know at feedback@oncommercelive.co.uk, unfortunately we cannot provide support from this address so any questions or queries please direct them to your project manager.</p>
            </div>
            <div style="width:33%; max-width:33%; padding:15px;">
                <h5>Last 10 Sales</h5>
                @if(count($last_orders)>0)
                    @foreach($last_orders as $order)
                        <span>{{$order->order_placed}}</span>
                        <span><a href="#">{{$order->user_id}}</a></span>
                        <span>(£{{$order->product_total}})</span>
                        <br>
                    @endforeach
                @endif
            </div>
            <div style="width:33%; max-width:33%; padding:15px;">
                <h5>Top 10 Selling Products </h5>
            </div>

        </div>

        <footer>@include('customer.layouts.footer')</footer>    
    </body>
</html>