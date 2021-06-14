@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Sales lot</p>
        </div>
    </div>

    
    <div class="col-md-12" style="display: flex;">
        <div class="button-box my-3 d-flex">
            <a href="/portal/sales-lot/completed-sales-lots/">
                <div class="btn btn-primary">Back</div>
            </a>
            <button class="btn btn-primary" id="export-xls-data">Export XLS</button>
        </div>
    </div>

    <input type="hidden" class="saleslot-active" id="{{$salesLots->id}}">

    <div class="portal-table-container">
        <table class="portal-table table-visible" id="completed-sales-lots-table">
            <thead>
                <tr>
                    <td><div class="table-element">Trade-in Barcode number</div></td>
                    <td><div class="table-element">Box number</div></td>
                    <td><div class="table-element">Bamboo Grade</div></td>
                    <td><div class="table-element">Customer Grade</div></td>
                    <td><div class="table-element">Manufacturer/Model</div></td>
                    <td><div class="table-element">Category</div></td>
                    <td><div class="table-element">GB Size</div></td>
                    <td><div class="table-element">Network</div></td>
                    <td><div class="table-element">Colour</div></td>
                    <td><div class="table-element">IMEI</div></td>
                    <td><div class="table-element">Cost</div></td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td><div class="table-element">Trade-in Barcode number</div></td>
                    <td><div class="table-element">Box number</div></td>
                    <td><div class="table-element">Bamboo Grade</div></td>
                    <td><div class="table-element">Customer Grade</div></td>
                    <td><div class="table-element">Manufacturer/Model</div></td>
                    <td><div class="table-element">Category</div></td>
                    <td><div class="table-element">GB Size</div></td>
                    <td><div class="table-element">Network</div></td>
                    <td><div class="table-element">Colour</div></td>
                    <td><div class="table-element">IMEI</div></td>
                    <td><div class="table-element">Cost</div></td>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($tradeins as $key=>$tradein)
                <tr id="{{$tradein->id}}">
                    <td><div class="table-element">{{$tradein->barcode ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->getTrayName($tradein->id) ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->getDeviceBambooGrade() ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->customer_grade ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->getProductName($tradein->product_id) ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->getCategoryName($tradein->correct_product_id) ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->correct_memory ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->correct_network ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->product_colour ?? null ?: 'N/A'}}</div></td>
                    <td><div class="table-element">{{$tradein->imei_number ?? null ?: $tradein->serial_number}}</div></td>
                    <td><div class="table-element">£{{$tradein->getDeviceCost() ?? null ?: 'N/A'}}</div></td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>

@endsection