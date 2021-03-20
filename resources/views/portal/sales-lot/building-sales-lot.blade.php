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
                    <div class="button-box col-lg-8 my-3 d-flex" id="changeview-container" data-toggle="buttons">
                        <label class="btn btn-secondary active" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="changeview" id="changetoviewtradeins" autocomplete="off" checked style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by Trade-in Barcode number
                        </label>
                        <label class="btn btn-secondary" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="changeview" id="changetoviewboxes" autocomplete="off" style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by box number
                        </label>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <button id="addtolot" class="btn btn-info" role="button" disabled>Add to Lot</button>
                    </div>
                </div>

                <table class="portal-table table-visible" id="boxedtradeinstable">
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
                        <td><div class="table-element"><input type="checkbox" id="boxedtradeinstable-selectall"></div></td>
                    </tr>
                    @foreach ($tradeins as $key=>$tradein)
                    <tr id="{{$tradein->id}}">
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                        <td><div class="table-element">{{$tradein->customer_grade}}</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                        <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                        <td><div class="table-element">{{$tradein->correct_memory}}</div></td>
                        <td><div class="table-element">{{$tradein->correct_network}}</div></td>
                        <td><div class="table-element"></div></td>
                        <td><div class="table-element"></div></td>
                        <td><div class="table-element"><input type="checkbox" class="tradein-sales-lot" data-value="{{$tradein->id}}"></div></td>
                    </tr>
                    @endforeach
                </table>
                <table class="portal-table table-invisible" id="closedboxtable">
                    <tr>
                        <td><div class="table-element">Box number</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Total QTY</div></td>
                        <td><div class="table-element">Total Cost</div></td>
                        <td><div class="table-element"><input type="checkbox" id="closedboxtable-selectall"> </div></td>
                    </tr>
                    @foreach ($boxes as $box)
                    <tr id="{{$box->id}}">
                        <td><div class="table-element">{{$box->tray_name}}</div></td>
                        <td><div class="table-element">{{$box->tray_grade}}</div></td>
                        <td><div class="table-element">{{$box->tray_network}}</div></td>
                        <td><div class="table-element">{{$box->number_of_devices}}</div></td>
                        <td><div class="table-element"></div></td>
                        <td><div class="table-element"><input type="checkbox" class="box-sales-lot" data-value="{{$box->id}}"></div></td>
                    </tr>
                    @endforeach
                </table>
            </div>


            <div class="col-md-4">
                <div class="d-flex">
                    <div class="button-box col-lg-8 my-3 d-flex" data-toggle="buttons">
                        <button id="removefromlot" class="btn btn-danger" role="button" disabled>Remove from Lot</button>
                        <button id="completelot" class="btn btn-success" role="button" disabled>Lot complete</button>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <a href="/portal/sales-lot/completed-sales-lots" class="btn btn-warning">Completed Sales Lots</a>
                    </div>
                </div>

                <table class="portal-table" id="saleslotboxes">
                    <tr>
                        <td><div class="table-element">Box number</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Network</div></td>
                        <td><div class="table-element">Total QTY</div></td>
                        <td><div class="table-element">Total Cost</div></td>
                        <td><div class="table-element"><input type="checkbox" id="saleslotboxes-selectall"></div></td>
                    </tr>
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