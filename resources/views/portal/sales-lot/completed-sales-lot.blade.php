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
            
            <div class="col-md-12" style="display: flex;">
                <div class="button-box my-3 d-flex" id="saleslot-option-buttons">
                    <button class="btn btn-primary" id="view-sales-lot-btn" disabled>View Sales Lot</button>
                    <button class="btn btn-primary" id="edit-lot-btn" disabled>Edit Lot</button>
                    <button class="btn btn-primary" id="sell-lot-btn" disabled>Sell Lot</button>
                    <button class="btn btn-primary" id="payment-received-btn" disabled>Payment Received</button>
                    <button class="btn btn-primary" id="sales-export-btn" disabled>Client Sales Export</button>
                    <button class="btn btn-primary" id="ism-pre-alert" disabled>ISM Pre-alert</button>
                </div>
            </div>

            <div class="col-md-12">
                <table class="portal-table table-visible" id="boxedtradeinstable">
                    <thead>
                        <tr>
                            <td><div class="table-element">Lot no.</div></td>
                            <td><div class="table-element">Date Created</div></td>
                            <td><div class="table-element">Qty</div></td>
                            <td><div class="table-element">Cost</div></td>
                            <td><div class="table-element">Sold Value</div></td>
                            <td><div class="table-element">Status</div></td>
                            <td><div class="table-element">Date sold</div></td>
                            <td><div class="table-element">Payment date</div></td>
                            <td><div class="table-element">Customer</div></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><div class="table-element">Lot no.</div></td>
                            <td><div class="table-element">Date Created</div></td>
                            <td><div class="table-element">Qty</div></td>
                            <td><div class="table-element">Cost</div></td>
                            <td><div class="table-element">Sold Value</div></td>
                            <td><div class="table-element">Status</div></td>
                            <td><div class="table-element">Date sold</div></td>
                            <td><div class="table-element">Payment date</div></td>
                            <td><div class="table-element">Customer</div></td>
                        </tr>
                    </tfoot>
                    @foreach ($salesLots as $saleLot)
                    <tr class="saleslots" id="{{$saleLot->id}}">
                        <td><div class="table-element">{{$saleLot->id}}</div></td>
                        <td><div class="table-element">{{$saleLot->created_at}}</div></td>
                        <td><div class="table-element">{{$saleLot->getSalesLotQuantity()}}</div></td>
                        <td><div class="table-element">£{{$saleLot->getSalesLotPrice()}}</div></td>
                        @if($saleLot->sold_value === null)
                        <td><div class="table-element">N/A</div></td>
                        @else
                        <td><div class="table-element">£{{$saleLot->sold_value}}</div></td>
                        @endif
                        <td><div class="table-element">{{$saleLot->getStatus($saleLot->sales_lot_status)}}</div></td>
                        <td><div class="table-element">{{$saleLot->date_sold ?? null ?: 'N/A'}}</div></td>
                        <td><div class="table-element">{{$saleLot->payment_date ?? null ?: 'N/A'}}</div></td>
                        @if($saleLot->sold_to === null)
                        <td><div class="table-element">N/A</div></td>
                        @else
                        <td><div class="table-element">{{$saleLot->getCustomerName()}}</div></td>
                        @endif
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

            <form action="/portal/sales-lot/completed-sales-lots/change-state" onsubmit="return confirm('Are you sure?')" method="POST">
                @csrf
                <h5 class="modal-title">Sell Lot</h5>
                <table class="portal-table my-3" id="sales-lot-boxes">
                    <tr>
                        <th><div class="table-element">Sales Lot No:</div></th>

                        <th><div class="table-element" id="salelot-number"></div></th>
                        <input type="hidden" id="salelot-number-value" name="salelot_number" value="">
                    </tr>
                    <tr>
                        <th><div class="table-element">Customer:</div></th>
                        <th><div class="table-element">
                            <select class="form-control" name="clients" id="clients">
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->account_name}}</option>
                                @endforeach
                            </select>
                        </div></th>
                    </tr>
                    <tr>
                        <th><div class="table-element">Device QTY:</div></th>
                        <th><div class="table-element" id="device-qty">
                            
                        </div></th>
                    </tr>
                    <tr>
                        <th><div class="table-element">Sold Value:</div></th>
                        <th><div class="table-element">
                            <input type="number" class="form-control" id="sold-for-input" name="sold_for_input" step=".01" required>    
                        </div></th>
                    </tr>
                </table>

                <input type="submit" class="btn btn-primary" id="sell-lot-confirm-btn" value="Submit">
            </form>
        </div>
        </div>
    </div>
</div>


@endsection