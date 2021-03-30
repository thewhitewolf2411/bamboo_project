@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Trolley {{$trolley->trolley_name}}</p>
            </div>
        </div>

        <div class="portal-table-container">
            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Trolley ID</div></td>
                    <td><div class="table-element">Trolley</div></td>
                    <td><div class="table-element">No of Trays</div></td>
                    <td><div class="table-element">No of Devices</div></td>
                    <td><div class="table-element">Trolley Type</div></td>
                    <td><div class="table-element">Print Trolley Label</div></td>
                </tr>
                <tr>
                    <td><div class="table-element">{{$trolley->id}}</div></a></td>
                    <td><div class="table-element">{{$trolley->trolley_name}}</div></a></td>
                    <td><div class="table-element">{{$trolley->number_of_trays}}</div></a></td>
                    <td><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></a></td>
                    <td><div class="table-element">{{$trolley->trolley_type}}</div></a></td>
                    <td><div class="table-element"><a class="printtrolleylabel" data-value="{{$trolley->id}}"><div class="btn btn-primary btn-blue"><p style="color: #fff;">Print Trolley label</p></div></a></div></td>
                </tr>
            </table>

            <div class="portal-title-container">
                <div class="portal-title">
                    <p>Trolley {{$trolley->trolley_name}} trays</p>
                </div>
            </div>

            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Tray ID</div></td>
                    <td><div class="table-element">Tray name</div></td>
                    <td><div class="table-element">No of Devices</div></td>
                </tr>
                @foreach($trolleyTrays as $tray)
                
                    <tr>
                        <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element">{{$tray->id}}</div></a></td>
                        <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element"><div class="table-element">{{$tray->tray_name}}</div></a></td>
                        <td><a href="/portal/trays/tray/?tray_id_scan={{$tray->id}}"><div class="table-element"><div class="table-element">{{$tray->number_of_devices}}</div></a></td>
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