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

    <div class="row ml-auto mt-0 mr-auto mb-2">
        <a class="btn btn-info" href="/portal/despatch/exportarchive">Export</a>
    </div>

    <div class="portal-table-container">

        <table class="portal-table sortable" id="despatch-devices-table">
            <tr>
                <td class="text-center"><div class="table-element">Trade-in ID</div></td>
                <td class="text-center"><div class="table-element">Order identifier</div></td>
                <td class="text-center"><div class="table-element">Order reference</div></td>
                <td class="text-center"><div class="table-element">Order Date</div></td>
            </tr>
            @foreach($despatched as $device)
                <tr>
                    <td><div class="table-element">{{$device->getTradeinId()}}</div></td>
                    <td><div class="table-element">{{$device->order_identifier}}</div></td>
                    <td><div class="table-element">{{$device->order_reference}}</div></td>
                    <td><div class="table-element">{{$device->order_date}}</div></td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection