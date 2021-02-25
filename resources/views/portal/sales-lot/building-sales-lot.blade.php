@extends('portal.layouts.portal')

@section('content')

<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Building Sales Lot</p>
        </div>
    </div>
    <div class="portal-table-container p-0">

        <div class="row">

            <div class="col-md-8">
                <div class="d-flex">
                    <div class="button-box col-lg-8 my-3 d-flex" data-toggle="buttons">
                        <label class="btn btn-secondary active" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="options" id="changetoviewtradeins" autocomplete="off" checked style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by Trade-in Barcode number
                        </label>
                        <label class="btn btn-secondary" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="options" id="changetoviewboxes" autocomplete="off" style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by box number
                        </label>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <button id="addtolot" class="btn btn-info" role="button" disabled>Add to Lot</button>
                    </div>
                </div>

                <table class="portal-table sortable table-visible" id="boxedtradeinstable">
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
                    @foreach ($tradeins as $key=>$tradein)

                    @endforeach
                </table>
                <table class="portal-table sortable table-invisible" id="closedboxtable">
                    <tr>
                        <td><div class="table-element">Box id</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Qty</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Target value</div></td>
                        <td><div class="table-element">Checkbox</div></td>
                    </tr>
                    @foreach ($boxes as $box)

                    @endforeach
                </table>
            </div>


            <div class="col-md-4">
                <div class="d-flex">
                    <div class="button-box col-lg-8 my-3 d-flex" data-toggle="buttons">
                        <button id="addtolot" class="btn btn-danger" role="button" disabled>Remove from Lot</button>
                        <button id="addtolot" class="btn btn-success" role="button" disabled>Lot complete</button>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <a href="/portal/sales-lot/completed-sales-lots" class="btn btn-warning">Completed Sales Lots</a>
                    </div>
                </div>

                <table class="portal-table sortable">
                    <tr>
                        <td><div class="table-element">Box number</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Total QTY</div></td>
                        <td><div class="table-element">Total Cost</div></td>
                        <td><div class="table-element">Checkbox</div></td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>


@endsection