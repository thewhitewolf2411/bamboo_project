@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            @if($edit)
            <p>Edit Sales lot</p>
            @else
            <p>Building Sales Lot</p>
            @endif
        </div>
    </div>

    <div class="loader" id="sales-lot-loader">
            
    </div>

    <div class="portal-table-container p-0 hidden" id="sales-lot-content">

        <div class="d-flex flex-column">

            <div class="row justify-content-end">
                <div class="col-md-1">Lot No.</div>
                @if($edit)
                <div class="col-md-6">{{$salelot->id}}</div>
                @else
                <div class="col-md-6">{{$totalSalesLots + 1}}</div>
                @endif
            </div>
            <div class="row justify-content-end">
                <div class="col-md-1">Total Qty.</div>
                @if($edit)
                <div class="col-md-6" id="total_qty">{{$salelot->getSalesLotQuantity()}}</div>
                @else
                <div class="col-md-6" id="total_qty">0</div>
                @endif
                
            </div>
            <div class="row justify-content-end">
                <div class="col-md-1">Total Cost</div>
                @if($edit)
                <div class="col-md-6" id="total_cost">{{$salelot->getSalesLotPrice()}}</div>
                @else
                <div class="col-md-6" id="total_cost">0</div>
                @endif
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="d-flex">
                    <div class="button-box my-3 d-flex" id="changeview-container" data-toggle="buttons">
                        <label class="btn btn-secondary active" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0; margin-right:10px;">
                            <input type="radio" name="changeview" id="changetoviewtradeins" autocomplete="off" checked style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by Trade-in Barcode number
                        </label>
                        <label class="btn btn-secondary" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0; margin-left:10px;">
                            <input type="radio" name="changeview" id="changetoviewboxes" autocomplete="off" style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by box number
                        </label>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-between">
                        <button id="addtolot" class="btn btn-info" role="button" disabled>Add to Lot</button>
                    </div>

                </div>

                <table class="sales-lot-table" id="boxed-tradeins">
                    <thead>
                        <tr>
                            <td>Trade-in Barcode number</td>
                            <td>Box Number</td>
                            <td>Customer Grade</td>
                            <td>Bamboo Grade</td>
                            <td>Manufacturer Model</td>
                            <td>GB Size</td>
                            <td>Network</td>
                            <td>Colour</td>
                            <td>Cost</td>
                            <td><input type="checkbox" id="select_all_tradeins_building_lot"></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Trade-in Barcode number</td>
                            <td>Box Number</td>
                            <td>Customer Grade</td>
                            <td>Bamboo Grade</td>
                            <td>Manufacturer Model</td>
                            <td>GB Size</td>
                            <td>Network</td>
                            <td>Colour</td>
                            <td>Cost</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>

                <table class="sales-lot-table" id="bayed-boxes">
                    <thead>
                        <tr>
                            <td>Box Number</td>
                            <td>Bamboo Grade</td>
                            <td>Network</td>
                            <td>Avaliable QTY</td>
                            <td>Total Cost</td>
                            <td><input type="checkbox" id="select_all_boxes_building_lot"></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Box Number</td>
                            <td>Bamboo Grade</td>
                            <td>Network</td>
                            <td>Avaliable QTY</td>
                            <td>Total Cost</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>

            </div>


            <div class="col-md-6">
                <div class="d-flex">
                    <div class="button-box col-lg-8 my-3 d-flex" data-toggle="buttons">
                        <button id="removefromlot" class="btn btn-danger mx-2" role="button" disabled>Remove from Lot</button>
                        @if($edit)
                        <button id="editlot" class="btn btn-success mx-2" role="button">Finish Editing Lot</button>
                        <input type="hidden" id="edit_lot_id" value="{{$salelot->id}}">
                        @else
                        <button id="completelot" class="btn btn-success mx-2" role="button" disabled>Lot complete</button>
                        @endif
                        <button id="exportxls" class="btn btn-success mx-2" role="button" disabled>Export XLS</button>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <a href="/portal/sales-lot/completed-sales-lots" class="btn btn-warning">Completed Sales Lots</a>
                    </div>
                </div>

                <table class="sales-lot-table" id="added-tradeins-building-lot">
                    <thead>
                        <tr>
                            <td>Box number</td>
                            <td>Bamboo Grade</td>
                            <td>Manufacturer/Model</td>
                            <td>GB Size</td>
                            <td>Total Cost</td>
                            <td><input type="checkbox" id="select_all_added_tradeins_building_lot"></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Box number</td>
                            <td>Bamboo Grade</td>
                            <td>Manifacturer/Model</td>
                            <td>GB Size</td>
                            <td>Total Cost</td>
                            <td><input type="checkbox" id="select_all_added_tradeins_building_lot"></td>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="saleslotboxes-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1200px !important" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body mx-auto">
                <div class="my-3">
                    <button class="btn btn-primary" id="removefromlot" disabled>Remove</button>
                </div>
                
                <table class="portal-table sortable table-visible my-5" id="saleslotboxes-content-table">
                    <tr>
                        <td><div class="table-element">Trade in Barcode numbers</div></td>
                        <td><div class="table-element">Box number</div></td>
                        <td><div class="table-element">Customer Grade</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Model/Manufacturer</div></td>
                        <td><div class="table-element">GB Size</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Colour</div></td>
                        <td><div class="table-element">Cost</div></td>
                        <td><div class="table-element">Checkbox</div></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection