@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Quarantine Bins Overview</p>
            </div>
        </div>

        <div class="portal-search-form-container">
            <form action="/portal/quarantine/quarantine-bins/bin/" method="GET">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <label style="margin: 0;" for="tray_id_scan">Please Scan or Type the Bin Number:</label>
                    <input style="margin: 0; width: 50%;" class="form-control" name="bin_id_scan" id="bin_id_scan" autofocus>
                    <button type="submit" class="btn btn-primary btn-blue">Go</button>
                </div>
            </form>
        </div>
        <div class="portal-title-container">
            <div class="portal-title">
                <p>All bins</p>
            </div>
        </div>

        <div class="portal-table-container">

            <div class="container">
                <a href="/portal/quarantine/quarantine-bins/create"><div class="btn btn-primary btn-blue">
                    <p style="color: #fff;">Create Bin</p>
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
                    <td><div class="table-element">Bin ID</div></td>
                    <td><div class="table-element">Bin Location</div></td>
                    <td><div class="table-element">Device quantity</div></td>
                    <td><div class="table-element">Delete Bin</div></td>
                    <td><div class="table-element">Print Bin Label</div></td>
                </tr>
                @foreach($quarantineBins as $quarantineBin)
                <tr>
                    <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->id}}</a></div></td>
                    <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->tray_name}}</a></div></td>
                    <td><div class="table-element"><a href="/portal/quarantine/quarantine-bins/bin/?bin_id_scan={{$quarantineBin->tray_name}}">{{$quarantineBin->number_of_devices}}</a></div></td>
                    <td><div class="table-element">@if($quarantineBin->number_of_devices == 0) <a onclick="return confirm('Are you sure? This will remove tray from system. This action cannot be reversed.')" href="/portal/quarantine-bins/delete/{{$quarantineBin->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Delete Bin</p></div> @else This bin cannot be deleted. @endif</div></td>
                    <td><div class="table-element"><a class="printbinlabel" data-value="{{$quarantineBin->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Bin Label</p></div></a></div></td>
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