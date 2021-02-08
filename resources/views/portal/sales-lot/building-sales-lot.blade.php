@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Building Sales Lot</p>
        </div>
    </div>
    <div class="portal-table-container p-0">

        <div class="row">

            <div class="col-md-6">
                <div class="row d-flex py-3">
                    <a role="button" class="mx-3" id="changetoviewtradeins">
                        <div class="btn btn-primary btn-primary-active">
                            View by Trade-in barcode No.
                        </div>
                    </a>
                    <a role="button" class="mx-3" id="changetoviewboxes">
                        <div class="btn btn-primary btn-primary-nonactive">
                            View By Box Ref.
                        </div>
                    </a>
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
                    @foreach ($tradeins as $tradein)
                    <tr>
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_price}}£</div></td>
                        <td><div class="table-element">{{$tradein->bamboo_price}}£</div></td>
                        <td><div class="table-element"><input type="checkbox"></div></td>
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
                    <tr>
                        <td><div class="table-element">{{$box->tray_name}}</div></td>
                        <td><div class="table-element">{{$box->tray_grade}}</div></td>
                        <td><div class="table-element">{{$box->number_of_devices}}</div></td>
                        <td><div class="table-element">{{$box->getBoxPrice()}}£</div></td>
                        <td><div class="table-element">{{$box->getBoxPrice()}}£</div></td>
                        <td><div class="table-element"><input type="checkbox"></div></td>
                    </tr>
                    @endforeach
                </table>
            </div>


            <div class="col-md-6">
                <table class="portal-table sortable" id="box-table">
                    <tr>
                        <td><div class="table-element">Trade-in id</div></td>
                        <td><div class="table-element">Box id</div></td>
                        <td><div class="table-element">Grade</div></td>
                        <td><div class="table-element">Value</div></td>
                        <td><div class="table-element">Target value</div></td>
                        <td><div class="table-element">Cancel</div></td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>


@endsection