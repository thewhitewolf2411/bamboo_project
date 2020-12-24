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

    <title>Bamboo Recycle::{{$title}}</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>{{$title}}</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <div class="py-4 d-flex align-items-center">
                        <form class="d-flex align-items-center" action="/portal/customer-care/order-managment/" method="get">              
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
                            <td><div class="table-element">Trade-in Barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Device name</div></td>
                            <td><div class="table-element">Order status</div></td>
                            <td>

                            </td>
                        </tr>

                        @foreach($tradeins as $key=>$order)

                        <tr>
                            <td ><div class="table-element">@foreach($order as $tradein){{$tradein->barcode_original}}<br>@endforeach</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->barcode}} <br> @endforeach</div></td>
                            <td><div class="table-element">{{$order[0]->created_at}}</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} <br> @endforeach</div></td>
                            <td><div class="table-element">
                                @if($tradein->job_state == 1)<p>Awaiting Trade-pack</p> 
                                @elseif ($tradein->job_state == 2) <p>Awaiting Receipt</p> 
                                @elseif($tradein->job_state == 3 && $tradein->marked_for_quarantine == false) <p>Awaiting Testing <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a>.</p> 
                                @elseif($tradein->job_state == 3 && $tradein->marked_for_quarantine == true) <p>Device received, in a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a>.</p> 
                                @elseif($tradein->job_state == 4) <p>Device received but missing/wrong, in a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a></p> 
                                @elseif($tradein->job_state == 5) <p>1st Test. In a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a></p> 
                                @elseif($tradein->job_state == 6) 2nd Test.</div></td>
                                @elseif($tradein->job_state == 9) <p>Device was tested, and is in quarantine. Location: In a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a> </p>@endif</div></td>
                            <td><div class="table-element">
                                <a href="/portal/customer-care/trade-in/{{$tradein->barcode}}" title="View tradein details">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="/portal/trays/tray/printlabel/{{$tradein->barcode}}">
                                    <i class="fa fa-print"></i>
                                </a>
                                @if($tradein->job_state == 3)
                                <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                    <i class="fa fa-times" style="color:blue !important;" title="Return device to receiving" ></i>
                                </a>
                                @endif
                                @if($tradein->job_state >= 5)
                                <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                    <i class="fa fa-times" style="color:blue !important;"></i>
                                </a>
                                <a title="Return device to testing" href="/totesting/{{$tradein->id}}">
                                    <i class="fa fa-times" style="color:black !important;"></i>
                                </a>
                                @endif
                                
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

 

</script>


</html>
