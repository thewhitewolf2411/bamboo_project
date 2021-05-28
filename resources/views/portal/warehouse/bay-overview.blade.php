@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Bay Overview </p>
        </div>
    </div>
    <div class="portal-table-container">
        <div class="portal-search-form-container">
            <form action="/portal/warehouse-management/bay-overview/bay/" method="GET">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <label style="margin: 0;" for="tray_id_scan">Please Scan or Type the Bay name or Box name:</label>
                    <input style="margin: 0; width: 50%;" class="form-control" name="bay_id_scan" id="bay_id_scan" autofocus>
                    <button type="submit" class="btn btn-primary btn-blue">Go</button>
                </div>
            </form>
            @if(Session::has('searcherror'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('searcherror')}}
            </div>
            @endif
        </div>

        <div class="portal-table-container">

            <div class="container">
                <a href="/portal/warehouse-management/bay-overview/create"><div class="btn btn-primary btn-blue">
                    <p style="color: #fff;">Create Bay</p>
                </div></a>
            </div>

            
            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif

            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Bay Location</div></td>
                    <td><div class="table-element">Box Quantity</div></td>
                    <td><div class="table-element">Units</div></td>
                    <td><div class="table-element">Delete Bay</div></td>
                    <td><div class="table-element">Print Bay Label</div></td>
                </tr>
                @foreach ($bays as $bay)
                <tr>
                    <td><a href="/portal/warehouse-management/bay-overview/bay/?bay_id_scan={{$bay->trolley_name}}"><div class="table-element">{{$bay->trolley_name}}</div></a></td>
                    <td><a href="/portal/warehouse-management/bay-overview/bay/?bay_id_scan={{$bay->trolley_name}}"><div class="table-element">{{$bay->getNumberOfTrays()}}</div></a></td>
                    <td><a href="/portal/warehouse-management/bay-overview/bay/?bay_id_scan={{$bay->trolley_name}}"><div class="table-element">{{$bay->getNumberOfDevices($bay->id)}}</div></a></td>
                    <td><div class="table-element">@if($bay->canBeDeleted()) <div class="btn btn-primary baydelete" id="{{$bay->trolley_name}}"><p style="color: #fff;">Delete</p></div> @else Bay cannot be deleted @endif</div></td>
                    <td><div class="table-element"><div class="btn btn-primary printbaylabel" data-value="{{$bay->id}}"><p style="color: #fff;">Print</p></div></div></td>
                </tr>
                @endforeach
            </table>

        </div>

    </div>
</div>

<div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Trade in label</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <iframe id="tradein-iframe"></iframe>
        </div>
        </div>
    </div>
</div>

@endsection