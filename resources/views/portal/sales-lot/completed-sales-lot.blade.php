@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Completed Sales Lot</p>
        </div>
    </div>
    <div class="portal-table-container p-0">
        <div class="row">

            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
            @endif

            <div class="col-md-12">
                <table class="portal-table sortable table-visible" id="boxedtradeinstable">
                    <tr>
                        <td><div class="table-element">Lot no.</div></td>
                        <td><div class="table-element">Date Created</div></td>
                        <td><div class="table-element">Qty</div></td>
                        <td><div class="table-element">Cost</div></td>
                        <td><div class="table-element">Sold Value</div></td>
                        <td><div class="table-element">Status</div></td>
                        <td><div class="table-element">Date sold</div></td>
                        <td><div class="table-element">Payment date</div></td>
                    </tr>
                    @foreach ($salesLots as $saleLot)
                    <tr class="saleslots" id="{{$saleLot->id}}">
                        <td><div class="table-element">{{$saleLot->id}}</div></td>
                        <td><div class="table-element">{{$saleLot->created_at}}</div></td>
                        <td><div class="table-element">{{$saleLot->getSalesLotQuantity()}}</div></td>
                        <td><div class="table-element">£{{$saleLot->getSalesLotPrice()}}</div></td>
                        <td><div class="table-element">£{{$saleLot->getSalesLotPrice()}}</div></td>
                        <td><div class="table-element">{{$saleLot->getStatus($saleLot->sales_lot_status)}}</div></td>
                        <td><div class="table-element">{{$saleLot->date_sold}}</div></td>
                        <td><div class="table-element">{{$saleLot->payment_date}}</div></td>
                    </tr>
                    @endforeach
                </table>

            </div>

        </div>

    </div>
</div>

<div id="salelot-action" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Completed sales lot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">

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
                    <th><div class="table-element">Box Name</div></th>
                    <th><div class="table-element">Bay Location</div></th>
                </tr>
            </table>

            <form id="changelotstateform" action="/portal/sales-lot/completed-sales-lots/change-state" method="POST">
                @csrf

                <input type="hidden" name="saleslotid" id="saleslotidform" value="">
                <div id="changelotstatedata">


                </div>

            </form>
        </div>
        </div>
    </div>
</div>


@endsection