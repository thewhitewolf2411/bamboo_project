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

    <title>Bamboo Recycle::Trade-pack Despatch</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Trade-pack Despatch</p>
                    </div>
                </div>
                <div class="portal-table-container">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <div class="py-4 d-flex align-items-center">
                        <form class="d-flex align-items-center" action="/portal/customer-care/trade-in/all/" method="get">              
                            <label for="searchtradeins">Select product type:</label>
                            <select id="search" name="search" class="form-control mx-3">
                                <option value="0" @if($search == 0) selected @endif>All</option>
                                <option value="1" @if($search == 1) selected @endif>Mobile phones</option>
                                <option value="2" @if($search == 2) selected @endif>Tablets</option>
                                <option value="3" @if($search == 3) selected @endif>Smartwatches</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        </form>
                        <form class="d-flex align-items-center mx-5" action="/portal/customer-care/trade-in/all/" method="get">              
                            <label for="searchtradeins">Input trade-in barcode number:</label>
                            <input type="text" name="search" class="form-control mx-3 my-0">
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        </form>
                    </div>


                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Products</div></td>
                            <td><div class="table-element">Customer grade</div></td>
                            <td><div class="table-element">Order Type</div></td>
                            <td>
                                <div class="table-element"><input type="checkbox" onclick="checkall(this)"></div>
                            </td>
                        </tr>
                        <form id="print_trade_pack_bulk_form" name="print_trade_pack_bulk_form" class="my-5" enctype="multipart/form-data" action="/portal/customer-care/trade-in/printlabelbulk" method="post">
                        @csrf
                            @foreach($tradeins as $key=>$order)
                            <tr>
                                <td ><div class="table-element">{{$key}}</div></td>
                                <td><div class="table-element">{{$order[0]->created_at}}</div></td>
                                <td><div class="table-element">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} {{$tradein->memory}} <br> @endforeach</div></td>
                                <td><div class="table-element">@foreach($order as $tradein){{$tradein->product_state}} <br> @endforeach</div></td>
                                <td><div class="table-element">{{$order[0]->getOrderType($order[0]->barcode)}}</div></td>
                                <td><div class="table-element">
                                    <a title="See trade in details" href="/portal/customer-care/trade-in/{{$tradein->barcode}}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="javascript:void(0)" title="Print trade-in label" onclick = printTradePackTradeIn({{$tradein->barcode}})>
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a onclick = deleteTradeInDetailsFromSystem({{$tradein->barcode}})>
                                        <i title="Delete trade in from system" class="fa fa-times" style="color:red !important;"></i>
                                    </a>
                                    <input class="printcheckbox" type="checkbox" name="{{$key}}" value="{{$key}}" onclick="enablebtn()">
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        <button type="submit" id="print_trade_pack_bulk_form_trigger" class="btn btn-primary mb-5" disabled>Print Trade Pack Trade-In Bulk</button>
                        </form>
                    </table>

                    <form id="print_trade_pack_form" name="form-print-trade-pack" enctype="multipart/form-data" action="/portal/customer-care/trade-in/printlabel" method="post">
                        @csrf
                        <input type="hidden" id="print_trade_pack_trade_in_id" name="hidden_print_trade_pack_trade_in_id">
                        <input type="submit" id="print_trade_pack_trade_in_trigger" name="print_trade_pack_trade_in" value="Print Trade Pack Trade-In">
                    </form>

                    <form onsubmit="return confirm('Are you sure you want to delete this tradein from system?')" style="display:none;" id="delete_trade_pack_form" name="delete_trade_pack_form" action="/portal/customer-care/tradein/deletetradein" method="post">
                        @csrf
                        <input type="number" name="delete_trade_in_id" id="delete_trade_in_id">
                        <input type="submit" id="delete_trade_in_button" name="delete_trade_in_button" value="Print Trade Pack Trade-In Bulk">
                    </form>

                </div>
            </div>
        </div>
    </main>

</body>

<script>

 

</script>


</html>
