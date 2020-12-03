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

    <script src="/js/PrintTradeIn.js"></script>

    <!-- Sortable -->
    <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Order Management</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>E-commerence Order Management</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif

                    <div class="py-4 d-flex align-items-center">
                        <form class="d-flex align-items-center" action="/portal/ecommerence/order-management/" method="get">              
                            <label for="searchtradeins">Select product type:</label>
                            <select id="search" name="search" class="form-control mx-3">
                                <option value="0" @if($search == 0) selected @endif>All</option>
                                <option value="1" @if($search == 1) selected @endif>Mobile phones</option>
                                <option value="2" @if($search == 2) selected @endif>Tablets</option>
                                <option value="3" @if($search == 3) selected @endif>Smartwatches</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        </form>
                        <form class="d-flex align-items-center mx-5" action="/portal/customer-care/order-managment/" method="get">              
                            <label for="searchtradeins">Input trade-in barcode number:</label>
                            <input type="text" name="search" class="form-control mx-3 my-0">
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        </form>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Device name</div></td>
                            <td><div class="table-element">Order status</div></td>
                            <td>

                            </td>
                        </tr>

                        @foreach($tradeouts as $key=>$order)

                        <tr>
                            <td><div class="table-element">{{$order->id}}</div></td>
                            <td><div class="table-element">{{$order->created_at}}</div></td>
                            <td><div class="table-element">{{$order->getDeviceName($order->product_id)}}</div></td>
                            <td><div class="table-element">
                            @if($order->order_state === 0) Order Not complete @endif
                            @if($order->order_state === 1) Order Sent @endif
                            </div></td>
                            <td>

                            @if($order->order_state === 0)
                            <a href="javascript:void(0)" onclick = markOrderAsSent({{$order->id}}) title="Mark order as sent">
                                    <i class="fa fa-envelope-o"></i>
                                </a>
                            </td>
                            @endif

                        </tr>

                        @endforeach
                    </table>

                    <form id="mark_as_complete" name="mark_as_complete" enctype="multipart/form-data" action="/portal/ecommerence/setAsSent" method="post">
                        @csrf
                        <input type="hidden" id="mark_as_complete_trade_out_id" name="mark_as_complete_trade_out_id">
                        <input type="submit" id="mark_as_complete_trade_out_trigger" name="mark_as_complete_trade_out_trigger" value="Set as complete">
                    </form>


                </div>
            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
