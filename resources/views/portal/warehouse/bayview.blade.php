@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>{{$bay->trolley_name}}</p>
        </div>
    </div>

    <div class="portal-table-container">
        <div class="container">
            <a role="button" data-toggle="modal" data-target="#allocateboxtobaymodal">
                <div class="btn btn-primary btn-green">
                    <p style="color: #fff;">Allocate box</p>
                </div>
            </a>
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

        <div class="row">
            <div class="col-md-6">
                <table class="portal-table" id="categories-table">
                    <tr>
                        <td><div class="table-element">Bay Location</div></td>
                        <td><div class="table-element">Box Quantity</div></td>
                        <td><div class="table-element">Print Bay Label</div></td>
                    </tr>
                    <tr>
                        <td><div class="table-element">{{$bay->trolley_name}}</div></td>
                        <td><div class="table-element">{{$bay->getNumberOfTrays()}}</div></td>
                        <td><div class="table-element"><div class="btn btn-primary printbaylabel" data-value="{{$bay->id}}"><p style="color: #fff;">Print label</p></div></div></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="portal-table" id="categories-table">
                    <tr>
                        <td><div class="table-element">Box name</div></td>
                        <td><div class="table-element">Device Qty</div></td>
                    </tr>
                    @foreach ($bayboxes as $baybox)
                        @if($baybox->status !== 10 && $baybox->getNumberOfDevices() !== 0)
                        <tr>
                            <td><div class="table-element">{{$baybox->tray_name}}</div></td>
                            <td><div class="table-element">{{$baybox->getNumberOfDevices()}}</div></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        
    </div>
</div>

<div id="allocateboxtobaymodal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Allocate box to this bay.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">
            <form action="/portal/warehouse-management/bay-overview/bay/allocatebox" method="post">
                @csrf
                <table id="addedboxestable" class="portal-table" id="categories-table">
                    <div id="statement">
                    
                    </div>

                    <input type="hidden" name="bayid" id="bayid" value="{{$bay->trolley_name}}">

                    <div class="form-group">

                        <label for="inputboxid">Type or scan Box label:</label>
                        <input type="text" class="form-control" id="inputboxid">
                        <a role="button" id="checkboxsubmit"><div class="btn btn-primary">Add box</div></a>

                    </div>
                    <div id="form-inputs">
                        
                    </div>

                    <div id="addedboxes">
                        <tr>
                            <td><div class="table-element">Box name</div></td>
                            <td><div class="table-element">Device Qty</div></td>
                        </tr>
                    </div>
                </table>

                <div class="row">
                    <div class="col-md-6"><input type="submit" class="btn btn-primary my-3" value="Submit"></div>
                    <div class="col-md-6"><a role="button" class="w-100 my-3" data-dismiss="modal" aria-label="Cancel"><div class="btn btn-primary w-100 my-3">Cancel</div> </a></div>
                </div>
            </form>
        </div>
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