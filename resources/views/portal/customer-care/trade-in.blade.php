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

    <title>Bamboo Recycle::Trade-Ins</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Trade-Ins</p>
                    </div>
                </div>
                <div class="portal-table-container">

                    <div class="py-4 d-flex align-items-center">

                        <div class="d-flex align-items-center">
                            <label for="number_of_trade_labels">Select number of trade labels to print:</label>
                            <select class="form-control ml-3" name="number_of_trade_labels" id="number_of_trade_labels">
                                <option value="" selected disabled>Make a selection</option>
                                @if(count($tradeins)>=10 && count($tradeins)<20)
                                <option onclick=setNumberOfTradePacks(10) value="10">10</option>
                                @endif
                                @if(count($tradeins)>=20 && count($tradeins)<50)
                                <option onclick=setNumberOfTradePacks(20) value="20">20</option>
                                @endif
                                @if(count($tradeins)>=50 && count($tradeins)<100)
                                <option onclick=setNumberOfTradePacks(50) value="50">50</option>
                                @endif
                                @if(count($tradeins)>=100 && count($tradeins)<200)
                                <option onclick=setNumberOfTradePacks(100) value="100">100</option>
                                @endif
                                @if(count($tradeins)>=500)
                                <option onclick=setNumberOfTradePacks(500) value="500">500</option>
                                @endif
                              </select>
                        </div>
                        <div class="d-flex align-items-center px-5">
                            <button id="bulk_label_print_button" class="btn btn-primary btn-blue" disabled onclick = printTradePackTradeInBulk()>
                                <p style="color: #fff;">Bulk Print trade Label</p>
                            </button>
                        </div>

                    </div>


                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Customer grade</div></td>
                            <td>

                            </td>
                        </tr>

                        @foreach($tradeins as $tradein)

                        <tr>
                            <td><div class="table-element">{{$tradein->id}}</td>
                            <td ><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->created_at}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->product_state}}</div></td>
                            <td><div class="table-element">
                                <a href="/portal/customer-care/trade-in/{{$tradein->id}}">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="javascript:void(0)" onclick = printTradePackTradeIn({{$tradein->id}})>
                                    <i class="fa fa-print"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-times" style="color:red !important;"></i>
                                </a>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </table>

                    <form id="print_trade_pack_form" name="form-print-trade-pack" enctype="multipart/form-data" action="/portal/customer-care/trade-in/printlabel" method="post">
                        @csrf
                        <input type="hidden" id="print_trade_pack_trade_in_id" name="hidden_print_trade_pack_trade_in_id">
                        <input type="submit" id="print_trade_pack_trade_in_trigger" name="print_trade_pack_trade_in" value="Print Trade Pack Trade-In">
                    </form>

                    <form id="print_trade_pack_bulk_form" name="print_trade_pack_bulk_form" enctype="multipart/form-data" action="/portal/customer-care/trade-in/printlabelbulk" method="post">
                        @csrf
                        <input type="number" name="number_of_bulk_prints" id="number_of_bulk_prints">
                        <input type="submit" id="print_trade_pack_bulk_form_trigger" name="print_trade_pack_bulk_form" value="Print Trade Pack Trade-In Bulk">
                    </form>

                </div>
            </div>
        </div>
    </main>

</body>

<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[0];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
