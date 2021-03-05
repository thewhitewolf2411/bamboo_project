@extends('portal.layouts.portal')

@section('content')
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
                    <td><div class="table-element text-center">Trade-in Barcode number</div></td>
                    <td><div class="table-element">Date Placed</div></td>
                    <td><div class="table-element">Device name</div></td>
                    <td><div class="table-element text-center">Customer Name</div></td>
                    <td><div class="table-element text-center">Post Code</div></td>
                    <td><div class="table-element">Bamboo status</div></td>
                    <td><div class="table-element">Location</div></td>
                    <td><div class="table-element">Customer status</div></td>
                    <td><div class="table-element text-center">View detail</div></td>
                    <td><div class="table-element text-center">Reprint</div></td>
                    <td><div class="table-element text-center">Revert to Receiving</div></td>
                    <td><div class="table-element text-center">Revert to Testing</div></td>
                    <td><div class="table-element text-center">Send to Despatch</div></td>

                </tr>

                @foreach($tradeins as $key=>$order)

                <tr>
                    <td ><div class="table-element">@foreach($order as $tradein){{$tradein->barcode_original}}<br>@endforeach</div></td>
                    <td><div class="table-element text-center">@foreach($order as $tradein){{$tradein->barcode}} <br> @endforeach</div></td>
                    <td><div class="table-element text-center">{{$order[0]->created_at}}</div></td>
                    <td><div class="table-element text-center">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} <br> @endforeach</div></td>
                    <td><div class="table-element text-center">{{$tradein->customer()->fullName()}}</div></td>
                    <td><div class="table-element text-center">{{$tradein->postCode()}}</div></td>
                    <td><div class="table-element text-center"> @foreach($order as $tradein) {{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[0]}} <br> @endforeach </div></td>
                    <td><div class="table-element text-center">{{$tradein->getTrayName($tradein->id)}}</div></td>
                    <td><div class="table-element text-center">@foreach($order as $tradein) {{$tradein->getDeviceStatus($tradein->id, $tradein->job_state)[1]}} <br> @endforeach</div></td>
                    <td><div class="table-element">
                        <a href="/portal/customer-care/trade-in/{{$tradein->barcode}}" title="View tradein details">
                            <i class="fa fa-search"></i>
                        </a>
                        </div>
                    </td>
                    <td>
                        <div class="table-element">
                            @if(!$tradein->hasDeviceBeenReceived())
                            <a href="javascript:void(0)" onclick="printTradePackTradeIn({{$tradein->barcode}})" title="Reprint tradepack">
                                <i class="fa fa fa-print"></i>
                            </a>
                            @else
                            <a href="javascript:void(0)" onclick="printDeviceLabel({{$tradein->barcode}})" title="Print device label">
                                <i class="fa fa fa-print"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                        
                    <td class="text-center 1 p-0">
                        @if($tradein->hasDeviceBeenReceived())
                            <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                {{-- <i class="fa fa-times" style="color:blue !important;" title="Return device to receiving" ></i> --}}
                                <img style="width: 15px;" src="{{url('/images/undo.png')}}">
                            </a>
                        @else
                            <div></div>
                        @endif
                    </td>
                        
                    
                    <td class="text-center 3 p-0">
                        @if($tradein->hasBeenTested())
                        <a title="Return device to testing" href="/totesting/{{$tradein->id}}">
                            {{-- <i class="fa fa-times" style="color:black !important;"></i> --}}
                            <img style="width: 15px;" src="{{url('/images/undo.png')}}">
                        </a>
                        @elseif($tradein->deviceInPaymentProcess())
                            <div></div>
                        @else
                            <div></div>
                        @endif
                    </td>
                                                
                    <td class="text-center 4 p-0">
                        @if($tradein->hasDeviceBeenReceived() && !$tradein->deviceInPaymentProcess())
                            <a href="#" title="Send to Despatch" onclick="sendToDespatch({{$tradein->id}})"><img style="width: 15px;" src="{{url('/images/undo.png')}}"></a>
                        @elseif($tradein->job_state === '21')
                            <div class="alert alert-success mb-0" role="alert">Device was dispatched to customer</div>
                        @else
                            <div></div>
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


@if(Session::has('success'))
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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


@endsection




