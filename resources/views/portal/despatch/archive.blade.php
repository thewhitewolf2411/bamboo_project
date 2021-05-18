@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="portal-title-container">
        <div class="portal-title">
            <div class="row justify-content-around">
                <p class="pt-2 text-center">Despatch archive</p>
            </div>
        </div>
    </div>

    @if($despatched->count() > 0)
        <div class="row ml-auto mt-0 mr-auto mb-2">
            <a class="btn btn-info" href="/portal/despatch/exportarchive">Export</a>
        </div>
    @endif

    <div class="portal-table-container">

        <table class="portal-table" id="despatch-devices-table">
            <tr>
                <td class="text-center"><div class="table-element">Trade-in ID</div></td>
                <td class="text-center"><div class="table-element">Trade-in barcode number</div></td>
                <td class="text-center"><div class="table-element">Manufacturer/Model</div></td>
                <td class="text-center"><div class="table-element">Customer name</div></td>
                <td class="text-center"><div class="table-element">Postcode</div></td>
                <td class="text-center"><div class="table-element">Address</div></td>
                <td class="text-center"><div class="table-element">Bamboo Status</div></td>
                <td class="text-center"><div class="table-element">Carrier</div></td>
                <td class="text-center"><div class="table-element">Tracking Reference</div></td>
            </tr>
            @foreach($despatched as $device)
                <tr>
                    <td><div class="table-element">{{$device->getTradeinId()}}</div></td>
                    <td><div class="table-element">{{$device->getTradeinBarcode()}}</div></td>
                    <td><div class="table-element">{{$device->getModel()}}</div></td>
                    <td><div class="table-element">{{$device->getCustomer()}}</div></td>
                    <td><div class="table-element">{{$device->getPostCode()}}</div></td>
                    <td><div class="table-element">{{$device->getAddressLine()}}</div></td>
                    <td><div class="table-element">{{$device->getBambooStatus()}}</div></td>
                    <td><div class="table-element">{{$device->getCarrier()}}</div></td>
                    <td><div class="table-element">{{$device->getTrackingReference()}}</div></td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection