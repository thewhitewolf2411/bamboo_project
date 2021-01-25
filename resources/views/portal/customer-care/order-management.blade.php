<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!---->

    <script src="/js/PrintTradeIn.js"></script>

    <!-- Sortable -->
    <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::{{$title}}</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="container-fluid">
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
                            <label for="searchtradeins">Input Trade-in barcode number / Trade-in ID:</label>
                            <input type="text" minlength="7" name="search" class="form-control mx-3 my-0">
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        </form>
                    </div>

                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in Barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Device name</div></td>
                            <td><div class="table-element">Customer Name</div></td>
                            <td><div class="table-element">Post Code</div></td>
                            <td><div class="table-element">Bamboo status</div></td>
                            <td><div class="table-element">Location</div></td>
                            <td><div class="table-element">Customer status</div></td>
                            <td><div class="table-element">View detail</div></td>
                            <td><div class="table-element">Reprint</div></td>
                            <td><div class="table-element">Revert to Receiving</div></td>
                            <td><div class="table-element">Revert to Testing</div></td>
                            <td><div class="table-element">Send to Despatch</div></td>

                        </tr>

                        @foreach($tradeins as $key=>$order)

                        <tr>
                            <td ><div class="table-element">@foreach($order as $tradein){{$tradein->barcode_original}}<br>@endforeach</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->barcode}} <br> @endforeach</div></td>
                            <td><div class="table-element">{{$order[0]->created_at}}</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} <br> @endforeach</div></td>
                            <td><div class="table-element">{{$tradein->customer()->fullName()}}</div></td>
                            <td><div class="table-element">{{$tradein->postCode()}}</div></td>
                            <td><div class="table-element"> @foreach($order as $tradein) {{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0]}} <br> @endforeach </div></td>
                            <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                            <td><div class="table-element">@foreach($order as $tradein) {{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[1]}} <br> @endforeach</div></td>
                            <td><div class="table-element">
                                <a href="/portal/customer-care/trade-in/{{$tradein->barcode}}" title="View tradein details">
                                    <i class="fa fa-search"></i>
                                </a>
                                </div>
                            </td>
                            <td>
                                <div class="table-element">
                                    @if($tradein->job_state <= 2)
                                    <a href="javascript:void(0)" onclick = printTradePackTradeIn({{$tradein->barcode}}) title="Reprint tradepack">
                                        <i class="fa fa fa-print"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" onclick = printDeviceLabel({{$tradein->barcode}}) title="Print device label">
                                        <i class="fa fa fa-print"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                                
                            <td class="text-center 1">
                                @if($tradein->job_state == 3 || $tradein->job_state >= 5 && $tradein->job_state !== 6)
                                    <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                        {{-- <i class="fa fa-times" style="color:blue !important;" title="Return device to receiving" ></i> --}}
                                        <img style="width: 15px;" src="{{url('/images/undo.png')}}">
                                    </a>
                                @endif
                            </td>
                                
                            <!-- <td class="text-center 2">
                                @if($tradein->job_state >= 5 && $tradein->job_state !== 6)
                                <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                    {{-- <i class="fa fa-times" style="color:blue !important;"></i> --}}
                                    <img style="width: 15px;" src="{{url('/images/undo.png')}}">
                                </a>
                                @endif
                            </td> -->
                            
                            <td class="text-center 3">
                                @if($tradein->job_state >= 5 && $tradein->job_state !== 6)
                                <a title="Return device to testing" href="/totesting/{{$tradein->id}}">
                                    {{-- <i class="fa fa-times" style="color:black !important;"></i> --}}
                                    <img style="width: 15px;" src="{{url('/images/undo.png')}}">
                                </a>
                                @endif
                            </td>
                                

                                
                                                       
                            {{-- <td class="text-center"><a href="#" title="Revert to receiving" onclick="revertToReceiving({{$tradein->id}})"><img style="width: 15px;" src="{{url('/images/undo.png')}}"></a></td> 
                            <td class="text-center"><a href="#" title="Revert to testing" onclick="revertToTesting({{$tradein->id}})"><img style="width: 15px;" src="{{url('/images/undo.png')}}"></a></td> --}}
                            <td class="text-center 4">
                                @if($tradein->job_state !== 11)
                                    <a href="#" title="Send to Despatch" onclick="sendToDespatch({{$tradein->id}})"><img style="width: 15px;" src="{{url('/images/undo.png')}}"></a>
                                @endif
                            </td>

                        </tr>


                        @endforeach
                    </table>

                    <form id="print_trade_pack_form" name="form-print-trade-pack" enctype="multipart/form-data" action="/portal/customer-care/trade-in/printlabel" method="post">
                        @csrf
                        <input type="hidden" id="print_trade_pack_trade_in_id" name="hidden_print_trade_pack_trade_in_id">
                        <input type="submit" id="print_trade_pack_trade_in_trigger" name="print_trade_pack_trade_in" value="Print Trade Pack Trade-In">
                    </form>

                    <form id="print_device_barcode_form" name="form-print-trade-pack" enctype="multipart/form-data" action="/portal/customer-care/printdevicelabel" method="post">
                        @csrf
                        <input type="hidden" id="print_device_id" name="print_device_id">
                        <input type="submit" id="print_device_barcode" name="print_device_barcode" value="">
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

@if(Session::has('success'))
    <script>

        $(document).ready(function(){
            $('#tradein-iframe').attr('src', '/' + "{{Session::get('success')}}");
            $('#label-trade-in-modal').modal('show');
        });

    </script>

@endif

<div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Trade in label</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <iframe id="tradein-iframe"></iframe>
        </div>
        </div>
    </div>
</div>

<script>
    function sendToDespatch(id){
        $.ajax({
            type: "POST",
            url: "{{route('sendToDespatch')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id: id},
            success: function(response) {
                if(response == 200){
                    alert('Trade-in sent to despatch.');
                    window.location.reload();
                }
            }
        });
    }
</script>

</html>
