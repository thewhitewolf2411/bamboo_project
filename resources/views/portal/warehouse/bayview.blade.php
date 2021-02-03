@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>{{$bay->trolley_name}} </p>
        </div>
    </div>

    <div class="portal-table-container">
        <div class="row">
            <div class="col-md-6">
                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Bay Location</div></td>
                        <td><div class="table-element">Box Quantity</div></td>
                        <td><div class="table-element">Print Bay Label</div></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Box name</div></td>
                        <td><div class="table-element">Device Qty</div></td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
</div>


@endsection