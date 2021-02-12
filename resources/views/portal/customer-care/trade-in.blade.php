@extends('portal.layouts.portal')

@section('content')
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
                    <select id="searchtype" name="searchtype" class="form-control mx-3">
                        <option value="0" @if($search == 0) selected @endif>All</option>
                        <option value="1" @if($search == 1) selected @endif>Mobile phones</option>
                        <option value="2" @if($search == 2) selected @endif>Tablets</option>
                        <option value="3" @if($search == 3) selected @endif>Smartwatches</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                </form>
                <form class="d-flex align-items-center mx-5" action="/portal/customer-care/trade-in/all/" method="get">              
                    <label for="searchtradeins">Input Trade-in barcode number / Trade-in ID:</label>
                    <input type="text" minlength="3" name="search" class="form-control mx-3 my-0">
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                </form>
            </div>


            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Trade-in ID</div></td>
                    <td><div class="table-element">Date Placed</div></td>
                    <td><div class="table-element">Products</div></td>
                    <td><div class="table-element">Customer grade</div></td>
                    <td><div class="table-element">Order Type</div></td>
                    <td>
                        <div class="table-element"><input type="checkbox" id="tradein-checkallbtn"></div>
                    </td>
                </tr>
                @csrf
                    @foreach($tradeins as $key=>$order)

                        @if($order->count() > 0)
                            <tr>
                                <td ><div class="table-element">{{$key}}</div></td>
                                <td><div class="table-element">{{$order[0]->created_at}}</div></td>
                                <td><div class="table-element">@foreach($order as $tradein){{$tradein->getProductName($tradein->product_id)}} {{$tradein->memory}} <br> @endforeach</div></td>
                                <td><div class="table-element">@foreach($order as $tradein){{$tradein->customer_grade}} <br> @endforeach</div></td>
                                <td><div class="table-element">{{$order[0]->getOrderType($order[0]->barcode)}}</div></td>
                                <td><div class="table-element">
                                    <a title="See trade in details" href="/portal/customer-care/trade-in/{{$tradein->barcode}}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="print-one-tradein" data-barcode="{{$tradein->barcode}}" title="Print trade-in label">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a onclick = deleteTradeInDetailsFromSystem({{$tradein->barcode}})>
                                        <i title="Delete trade in from system" class="fa fa-times" style="color:red !important;"></i>
                                    </a>
                                    <input class="printcheckbox" type="checkbox" name="{{$key}}" value="{{$key}}">
                                    </div>
                                </td>
                            </tr>
                        @endif

                    @endforeach
                <a role="button" id="print_trade_pack_bulk_form_trigger" class="btn btn-primary mb-5" disabled>Print Trade Pack Trade-In Bulk</a>
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

    @if(Session::has('success'))
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <script>

        $(document).ready(function(){
            $('#tradein-iframe').attr('src', '/' + "{{Session::get('success')}}");
            $('#label-trade-in-modal').modal('show');
        });

    </script>

@endif

@if(Session::has('bulk'))
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <script>

        $(document).ready(function(){
            $('#label-trade-in-bulk-modal').modal('show');
        });

    </script>
    <div id="label-trade-in-bulk-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trade in label</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <iframe id="tradein-iframe" src="{{Session::get('bulk')}}"></iframe>

            </div>
            </div>
        </div>
    </div>
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