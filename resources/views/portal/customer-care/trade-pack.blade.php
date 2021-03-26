@extends('portal.layouts.portal')

@section('content')
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
                <form class="d-flex align-items-center" action="/portal/customer-care/trade-pack/" method="get">              
                    <label for="searchtradeins">Select product type:</label>
                    <select id="search" name="searchtype" class="form-control mx-3">
                        <option value="0" @if($search == 0) selected @endif>All</option>
                        <option value="1" @if($search == 1) selected @endif>Mobile phones</option>
                        <option value="2" @if($search == 2) selected @endif>Tablets</option>
                        <option value="3" @if($search == 3) selected @endif>Smartwatches</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                </form>
                <!--
                <form class="d-flex align-items-center mx-5" action="/portal/customer-care/trade-pack/" method="get">              
                    <label for="searchtradeins">Input Trade-in barcode number / Trade-in ID:</label>
                    <input type="text" minlength="7" name="search" class="form-control mx-3 my-0">
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                </form>
                -->
            </div>

            <table class="portal-table" id="trade-pack-table">
                <thead>
                    <tr>
                        <td><div class="table-element">Trade-in ID</div></td>
                        <td><div class="table-element">Trade-in barcode number</div></td>
                        <td><div class="table-element">Date Placed</div></td>
                        <td><div class="table-element">Product</div></td>
    
                        <td><div class="table-element">Customer Sent</div></td>
                        <td>
    
                        </td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td><div class="table-element">Trade-in ID</div></td>
                        <td><div class="table-element">Trade-in barcode number</div></td>
                        <td><div class="table-element">Date Placed</div></td>
                        <td><div class="table-element">Product</div></td>
    
                        <td><div class="table-element">Customer Sent</div></td>
                        <td>
    
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($tradeins as $key=>$order)
                    @if($order->count() > 0)
                        <tr>
                            <td ><div class="table-element">@foreach($order as $tradein){{$tradein->barcode_original}}<br>@endforeach</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->barcode}} <br> @endforeach</div></td>
                            <td><div class="table-element">{{$order[0]->created_at}}</div></td>
                            <td><div class="table-element">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} {{$tradein->memory}} <br> @endforeach</div></td>
                            
                            <td><div class="table-element">@if($tradein->job_state === "2") Yes @else No @endif</div></td>
                            <td><div class="table-element">
                                <a href="/portal/customer-care/trade-in/{{$tradein->barcode}}" title="View tradein details">
                                    <i class="fa fa-search"></i>
                                </a>

                                @if($tradein->job_state == 2)
                                <a href="javascript:void(0)" class="print-one-tradein" data-barcode="{{$tradein->barcode}}" title="Print trade-in label">
                                    <i class="fa fa-print"></i>
                                </a>
                                @endif
                                @if($tradein->job_state == 3)
                                <a href="javascript:void(0)" class="print-one-tradein" data-barcode="{{$tradein->barcode}}" title="Print trade-in label">
                                    <i class="fa fa-print"></i>
                                </a>
                                @endif

                                <a onclick="return confirm('Are you sure? This will remove this order from system and you will no longer be able to access it?')" href="/cancel/{{$tradein->id}}">
                                    <i class="fa fa-times" style="color:red !important;" title="Cancel order" ></i>
                                </a>

                                @if($tradein->job_state >= 5)
                                <a title="Return device to receiving" href="/toreceive/{{$tradein->barcode}}">
                                    <i class="fa fa-times" style="color:blue !important;"></i>
                                </a>
                                <a title="Return device to testing" href="/totesting/{{$tradein->barcode}}">
                                    <i class="fa fa-times" style="color:black !important;"></i>
                                </a>
                                @endif
                                
                                </div>
                            </td>
                        </tr>
                    @endif

                @endforeach

                </tbody>


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
@endsection




