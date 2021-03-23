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
            <button class="btn btn-primary" id="ism-pre-alert">Export XLS</button>
        </div>
    </div>

    <input type="hidden" class="saleslot-active" id="{{$salesLots->id}}">

    <div class="portal-table-container">
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
            </tr>
            @foreach ($tradeins as $key=>$tradein)
            <tr id="{{$tradein->id}}">
                <td><div class="table-element">{{$tradein->barcode}}</div></td>
                <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                <td><div class="table-element">{{$tradein->customer_grade}}</div></td>
                <td><div class="table-element">{{$tradein->getDeviceBambooGrade()}}</div></td>
                <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                <td><div class="table-element">{{$tradein->correct_memory}}</div></td>
                <td><div class="table-element">{{$tradein->correct_network}}</div></td>
                <td><div class="table-element">{{$tradein->product_colour}}</div></td>
                <td><div class="table-element">£{{$tradein->bamboo_price}}</div></td>
            </tr>
            @endforeach
    </div>
</div>

@endsection