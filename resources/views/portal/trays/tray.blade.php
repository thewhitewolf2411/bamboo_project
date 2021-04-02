@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Tray {{$tray->tray_name}}</p>
            </div>
        </div>

        @if(Session::has('success'))

            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>

        @endif

        <div class="portal-table-container">
            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Tray ID</div></td>
                    <td><div class="table-element">Tray name</div></td>
                    <td><div class="table-element">No of Devices</div></td>
                    <td><div class="table-element">Print tray Label</div></td>
                    <td><div class="table-element">Assign tray to trolley</div></td>
                </tr>
                <tr>

                    <td><div class="table-element">{{$tray->id}}</div></td>
                    <td><div class="table-element">{{$tray->tray_name}}</div></td>
                    <td><div class="table-element">{{$tray->getTrayNumberOfDevices($tray->id)}}</div></td>
                    <td><div class="table-element"><a class="printtraylabel" data-value="{{$tray->id}}"><div class="btn btn-primary btn-blue"><p style="color:#fff">Print Tray label</p></div></a></div></td>
                    <td><div class="table-element">

                        <form action="/portal/trays/tray/addtotrolley" class="d-flex flex-column" onsubmit="return confirm('Are you sure you want to change assigned trolley of this tray?')" method="post">
                    
                            @csrf
                            <input type="hidden" name="tray_id" value="{{$tray->id}}">
                            <select required class="form-control" name="trolley_select">
                                <option value="" disabled @if($tray->trolley_id == null) selected @endif >Select Trolley</option>
                                @foreach($trolleys as $trolley)
                                <option value="{{$trolley->id}}" @if($tray->trolley_id == $trolley->id) selected @endif >{{$tray->getTrolleyName($trolley->id)}}</option>
                                @endforeach
                            </select>
                            
                            <button type="submit" class="btn btn-primary btn-blue">Submit</button>
                        </form>


                    </div></td>
                </tr>
            </table>

            <div class="portal-title-container">
                <div class="portal-title">
                    <p>Tray {{$tray->tray_name}} Content</p>
                </div>
            </div>

            <table class="portal-table sortable" id="categories-table">
                <tr>
                    <td><div class="table-element">Trade-in ID</div></td>
                    <td><div class="table-element">Tradein Barcode</div></td>
                    <td><div class="table-element">Product name</div></td>
                    <td><div class="table-element">IMEI Number</div></td>
                </tr>
                @foreach($tradeins as $tradein)
                <tr>
                    <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                    <td><div class="table-element">{{$tradein->barcode}}</div></td>
                    <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                    <td><div class="table-element">
                        @if($tradein->imei_number === null)
                            {{$tradein->serial_number}}
                        @else
                            {{$tradein->imei_number}}
                        @endif
                    </div></td>
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