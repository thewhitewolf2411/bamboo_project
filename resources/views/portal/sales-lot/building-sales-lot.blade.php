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

            <div class="col-md-6">
                <div class="d-flex">
                    <div class="button-box col-lg-12 my-3 d-flex" data-toggle="buttons">
                        <label class="btn btn-secondary active" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="options" id="changetoviewtradeins" autocomplete="off" checked style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by Trade-in Barcode number
                        </label>
                        <label class="btn btn-secondary" style="display: flex; align-items:center; justify-content:center; max-width:310px;margin:0;">
                            <input type="radio" name="options" id="changetoviewboxes" autocomplete="off" style="opacity: 0; height:0 !important; width:0 !important; margin:0 !important;"> View by box number
                        </label>
                    </div>
                    <div class="">
                        <button id="addtolot" class="btn btn-info" role="button">Add to Lot</button>
                    </div>
                </div>

                <table class="portal-table sortable table-visible" id="boxedtradeinstable">
                    <tr>
                        <td><div class="table-element">Trade in id</div></td>
                        <td><div class="table-element">Box id</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Target Value</div></td>
                        <td><div class="table-element">Checkbox</div></td>
                    </tr>
                    @foreach ($tradeins as $key=>$tradein)
                    <tr id="tradein-{{$tradein->id}}">
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td class="{{$tradein->getTrayName($tradein->id)}}"><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_price}}£</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_price}}£</div></td>
                        <td><div class="table-element"><input class="clickable tradein-click" type="checkbox" id="{{$tradein->id}}"></div></td>
                    </tr>
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
                    <tr id="box-{{$box->tray_name}}">
                        <td><div class="table-element">{{$box->tray_name}}</div></td>
                        <td><div class="table-element">{{$box->tray_grade}}</div></td>
                        <td><div class="table-element">{{$box->number_of_devices}}</div></td>
                        <td><div class="table-element">{{$box->getBoxPrice()}}£</div></td>
                        <td><div class="table-element">{{$box->getBoxPrice()}}£</div></td>
                        <td><div class="table-element"><input class="clickable box-click" type="checkbox" id="{{$box->tray_name}}"></div></td>
                    </tr>
                    @endforeach
                </table>
            </div>


            <div class="col-md-6">
                <div class="row d-flex py-3">
                    <div class="col-md-4">
                        <a role="button" class="mx-3" id="removefromlot" style="opacity: 0.65" disabled>
                            <div class="btn btn-danger">
                                Remove from lot
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <input role="button" id="buildalot" type="submit" class="btn btn-primary btn-blue my-0" value="Build a lot" disabled>
                    </div>
                </div>
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Selected tradeins</p>
                    </div>
                </div>
                <table class="portal-table sortable" id="selected-tradeins">
                    <tr>
                        <td><div class="table-element">Trade-in id</div></td>
                        <td><div class="table-element">Box id</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Target value</div></td>
                    </tr>
                </table>
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Selected boxes</p>
                    </div>
                </div>
                <table class="portal-table sortable" id="selected-boxes">
                    <tr>
                        <td><div class="table-element">Box id</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Qty</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Target value</div></td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>


@endsection