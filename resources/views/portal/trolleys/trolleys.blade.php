@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Trolley management </p>
            </div>
        </div>

        <div class="portal-search-form-container">
            <form action="/portal/trolleys/trolley" method="GET">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <label style="margin: 0;" for="trolley_id_scan">Please Scan or Type the Trolley Number:</label>
                    <input style="margin: 0; width: 50%;" class="form-control" name="trolley_id_scan" id="trolley_id_scan" autofocus>
                    <button type="submit" class="btn btn-primary btn-blue">Go</button>
                </div>
            </form>
        </div>
        <div class="portal-title-container">
            <div class="portal-title">
                <p>All trolleys</p>
            </div>
        </div>

        @if(Session::has('success'))

        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>

        @endif

        <div class="portal-table-container">
            
            <div class="container">
                <a href="/portal/trolleys/create"><div class="btn btn-primary btn-blue">
                    <p style="color: #fff;">Create Trolley</p>
                </div></a>
            </div>
            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Trolley ID</div></td>
                    <td><div class="table-element">Trolley</div></td>
                    <td><div class="table-element">No of Trays</div></td>
                    <td><div class="table-element">No of Devices</div></td>
                    <td><div class="table-element">Delete Trolley</div></td>
                    <td><div class="table-element">Print Trolley Label</div></td>
                </tr>
                @foreach($trolleys as $trolley)
                <tr>
                    <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->trolley_name}}"><div class="table-element">{{$trolley->id}}</div></a></td>
                    <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->trolley_name}}"><div class="table-element">{{$trolley->trolley_name}}</div></a></td>
                    <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->trolley_name}}"><div class="table-element">{{$trolley->number_of_trays}}</div></a></td>
                    <td><a href="/portal/trolleys/trolley?trolley_id_scan={{$trolley->trolley_name}}"><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></a></td>
                    <td><div class="table-element">@if($trolley->canBeDeleted())<a onclick="return confirm('Are you sure? This will remove trolley from system and remove all trays and devices from the system?')" href="/portal/trolleys/delete/{{$trolley->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Trolley</p></div></a>@else This trolley cannot be deleted. @endif</div></td>
                    <td><div class="table-element"><a class="printtrolleylabel" data-value="{{$trolley->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Trolley Label</p></div></a></div></td>
                </tr>
                @endforeach
            </table>
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