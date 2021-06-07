@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Picking / Despatch Management </p>
        </div>
    </div>
    <div class="portal-table-container">

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif      

        <div class="row">

            <div class="col-md-6">
                <table class="portal-table" id="saleslot-table">
                    <thead>
                        <tr>
                            <td><div class="table-element">Lot Ref No.</div></td>
                            <td><div class="table-element">Date raised</div></td>
                            <td><div class="table-element">Sold to</div></td>
                            <td><div class="table-element">Status</div></td>
                            <td><div class="table-element">Suspended</div></td>
                            <td><div class="table-element">Qty</div></td>
                            <td><div class="table-element">Tag Box</div></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><div class="table-element">Lot Ref No.</div></td>
                            <td><div class="table-element">Date raised</div></td>
                            <td><div class="table-element">Sold to</div></td>
                            <td><div class="table-element">Status</div></td>
                            <td><div class="table-element">Suspended</div></td>
                            <td><div class="table-element">Qty</div></td>
                            <td><div class="table-element">Tag Box</div></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($salesLots as $salesLot)
                        <tr class="saleslotpicking" id="{{$salesLot->id}}" data-status="{{$salesLot->sales_lot_status}}">
                            <td><div class="table-element">{{$salesLot->id}}</div></td>
                            <td><div class="table-element">{{$salesLot->created_at}}</div></td>
                            <td><div class="table-element">{{$salesLot->getCustomerName()}}</div></td>
                            <td><div class="table-element" id="saleslotstatus{{$salesLot->id}}" data-value="{{$salesLot->sales_lot_status}}">{{$salesLot->getStatus($salesLot->sales_lot_status)}}</div></td>
                            <td><div class="table-element" data-value="{{$salesLot->sales_lot_status}}">@if($salesLot->sales_lot_status === 6) Yes @else No @endif</div></td>
                            <td><div class="table-element">{{$salesLot->getSalesLotQuantity()}}</div></td>
                            <td><div class="table-element">@if($salesLot->sales_lot_status === 4 || $salesLot->sales_lot_status === 2 || $salesLot->sales_lot_status == 6) <input type="checkbox" data-value="{{$salesLot->id}}"  class="tagfordespatch"> @endif</div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <button type="submit" id="starttopicklot" class="btn btn-primary btn-blue mx-auto w-100" disabled>Start to pick lot</button>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" id="despatchpickingsaleslot" class="btn btn-primary btn-blue mx-auto w-100" disabled>Despatch</button>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" id="printpicknote" class="btn btn-primary btn-blue mx-auto w-100" disabled>Print Pick Note</button>
                    </div>
                </div>

                <div class="row" id="salelotcontent-table-container">

                </div>

            </div>

        </div>




    </div>
</div>

<div id="salelot-picking" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Pick lot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">

            <div class="row my-3">
                <div class="col-md-3">
                    <a role="button" id="printpicknote">
                        <div class="btn btn-primary btn-blue">
                            Print pick note
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a role="button" id="startpicklot" href="">
                        <div class="btn btn-primary btn-blue">
                            Start to pick lot
                        </div>
                    </a>
                </div>

            </div>


            <h5 class="modal-title">Full Boxes</h5>
            <table class="portal-table my-3" id="sales-lot-boxes">
                <tr>
                    <th><div class="table-element">Box Name</div></th>
                    <th><div class="table-element">Box Location</div></th>
                    <th><div class="table-element">Qty</div></th>
                </tr>
            </table>

            <h5 class="modal-title">Individual Devices</h5>
            <table class="portal-table my-3" id="sales-lot-devices">
                <tr>
                    <th><div class="table-element">Trade in id</div></th>
                    <th><div class="table-element">Model</div></th>
                    <th><div class="table-element">IMEI</div></th>
                    <th><div class="table-element">Bay Location</div></th>
                    <th><div class="table-element">Box Name</div></th>
                </tr>
            </table>
        </div>
        </div>
    </div>
</div>

@endsection