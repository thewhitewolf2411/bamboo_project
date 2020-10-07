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

    <title>Bamboo Recycle::Awaiting Receipt</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Awaiting Receipt</p>
                    </div>
                </div>

                <div class="portal-table-container">
                <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Label Status</div></td>
                            <td>

                            </td>
                        </tr>

                        @foreach($tradeins as $tradein)

                        <tr>
                            <td><div class="table-element">{{$tradein->id}}</td>
                            <td ><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->created_at}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">@if($tradein->job_state == 1)Printed @elseif ($tradein->job_state == 2) Sent @elseif($tradein->job_state == 3) Order received @elseif($tradein->job_state == 4) Device received @elseif($tradein->job_state == 5) Device in tray @endif</div></td>
                            <td><div class="table-element">
                                <a href="/portal/customer-care/trade-in/{{$tradein->id}}">
                                    <i class="fa fa-search"></i>
                                </a>
                                @if($tradein->job_state <=2)
                                <a href="javascript:void(0)" onclick = setAsSent({{$tradein->id}})>
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" onclick = printTradePackTradeIn({{$tradein->barcode}})>
                                    <i class="fa fa fa-print"></i>
                                </a>
                                @endif
                                <a title="Return device to print" href="">
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

                    <form id="set_label_as_sent_form" name="form-print-trade-pack" enctype="multipart/form-data" action="/portal/customer-care/trade-in/setassent" method="post">
                        @csrf
                        <input type="hidden" id="set_trade_in_as_sent" name="set_trade_in_as_sent">
                        <input type="submit" id="set_trade_in_as_sent_trigger" name="set_trade_in_as_sent_trigger" value="Set trade-in label as sent Trade-In">
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
