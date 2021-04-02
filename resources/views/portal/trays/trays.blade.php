@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Trays managment</p>
            </div>
        </div>

        <div class="portal-search-form-container">
            <form action="/portal/trays/tray/" method="GET">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <label style="margin: 0;" for="tray_id_scan">Please Scan or Type the Tray Number:</label>
                    <input style="margin: 0; width: 50%;" class="form-control" name="tray_id_scan" id="tray_id_scan" autofocus>
                    <button type="submit" class="btn btn-primary btn-blue">Go</button>
                </div>
            </form>
        </div>
        <div class="portal-title-container">
            <div class="portal-title">
                <p>All trays</p>
            </div>
        </div>

        @if(Session::has('success'))

        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>

        @endif

        @if(Session::has('error'))

        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>

        @endif

        <div class="portal-table-container">
            
            <div class="container">
                <a href="/portal/trays/create"><div class="btn btn-primary btn-blue">
                    <p style="color: #fff;">Create Tray</p>
                </div></a>
            </div>

            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Tray ID</div></td>
                    <td><div class="table-element">Tray name</div></td>
                    <td><div class="table-element">Assigned trolley</div></td>
                    <td><div class="table-element">No of Devices</div></td>
                    <td><div class="table-element">Delete Tray</div></td>
                    <td><div class="table-element">Print Tray Label</div></td>
                </tr>
                @foreach($trays as $tray)
                <tr>
                    <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->tray_name}}"><div class="table-element">{{$tray->id}}</div></a></td>
                    <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->tray_name}}"><div class="table-element">{{$tray->tray_name}}</div></a></td>
                    <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->tray_name}}"><div class="table-element">@if($tray->trolley_id == null) <p style="color:red;">Unassigned</p> @else <p style="color:green;"> {{$tray->getTrolleyName($tray->trolley_id)}} </p> @endif</div></a></td>
                    <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->tray_name}}"><div class="table-element">{{$tray->getTrayNumberOfDevices($tray->id)}}</div></a></td>
                    <td>
                        <div class="table-element">
                            @if($tray->canBeDeleted())
                                <a onclick="return confirm('Are you sure? This will remove tray from system, and remove all devices from the system and remove its records from corrseponding trolleys?')" href="/portal/trays/delete/{{$tray->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete tray</p></div></a>
                            @else
                                This tray cannot be deleted.
                            @endif
                        </div>
                    </td>
                    <td><div class="table-element"><a class="printtraylabel" data-value="{{$tray->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Tray Label</p></div></a></div></td>
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