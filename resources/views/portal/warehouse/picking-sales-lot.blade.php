@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Picking sales lot no. {{$saleLot->id}} </p>
        </div>
    </div>
    <div class="">

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

            <div class="col-md-4">

                <div class="row mb-3">
                    <div class="col-md-6"><p>Lot no.:</p></div>
                    <div class="col-md-6"><p>{{$saleLot->id}}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><p>Customer:</p></div>
                    <div class="col-md-6"><p>{{$saleLot->sold_to}}</p></div>
                </div>


                <div class="border border-primary rounded p-3">
                    <input type="hidden" id="buildsaleslot-salelot" value="{{$saleLot->id}}">
                    @if($saleLot->sales_lot_status === 2)
                    <div class="row">
                        <div class="col-md-6">
                            <a role="button" id="showscanboxdiv">
                                <div class="btn btn-primary btn-blue">Scan box No.</div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a role="button" id="showscandevicediv">
                                <div class="btn btn-primary btn-blue">Scan barcode No.</div>
                            </a>
                        </div>
                    </div>
                    
                    <div id="buildsaleslot-scanboxdiv" class="buildsaleslot-active">
                        
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/pickbox" method="POST">
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <div class="portal-title">
                                <p class="my-0">Enter Box Number </p>
                            </div>
                            <div class="form-group">
                                <label for="buildssaleslot-scanboxinput">Scan or type box number:</label>
                                <input type="text" class="form-control" name="buildssaleslot_scanboxinput" id="buildssaleslot-scanboxinput">
                            </div>
                            <div id="buildssaleslot-scandeviceinput-message">

                            </div>
                            <div class="col-md-12 p-0 my-3">
                                <input type="submit" id="buildssaleslot-scanboxsubmit" class="btn btn-primary btn-blue" value="Pick box" disabled>
                            </div>
                        </form>
                    </div>
                    <div id="buildsaleslot-scandevicediv" class="buildsaleslot-hidden">
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/pickdevice" method="POST">
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <div class="portal-title">
                                <p class="my-0">Enter Device Number </p>
                            </div>
                            <div class="form-group">
                                <label for="buildssaleslot-scandeviceinput">Scan or type device barcode:</label>
                                <input type="text" class="form-control" name="buildssaleslot_scandeviceinput" id="buildssaleslot-scandeviceinput">
                            </div>
                            <div id="buildssaleslot-scandeviceinput-message">

                            </div>
                            <div class="col-md-12 p-0 my-3">
                                <input type="submit" id="buildssaleslot-scandevicesubmit" class="btn btn-primary btn-blue" value="Pick device" disabled>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="">
                        <div class="d-flex justify-content-between">
                            <p class="m-0">Remaining qty to pick:</p>
                            <p class="m-0" id="remaining"></p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="m-0">Picked:</p>
                            <p class="m-0" id="picked"></p>
                        </div>
                    </div>
                    
                </div>

                <div class="row my-5">
                    
                    <div class="col-md-3 px-1">
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/cancel-picking" method="POST">
                        
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <input type="submit" id="cancelpickingsaleslot" class="btn btn-primary btn-blue mx-auto w-100" value="Cancel" disabled>

                        </form>
                    </div>
                    <div class="col-md-3 px-1">
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/suspend-picking" method="POST">
                        
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <input type="submit" id="suspendpickingsaleslot" class="btn btn-primary btn-blue mx-auto w-100" @if($saleLot->sales_lot_status !== 6) value="Suspend" @else value="Continue" @endif disabled>

                        </form>
                    </div>
                    <div class="col-md-3 px-1">
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/complete-picking" method="POST">
                        
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <input type="submit" id="completepickingsaleslot" class="btn btn-primary btn-blue mx-auto w-100" value="Complete" disabled>

                        </form>
                    </div>
                    <div class="col-md-3 px-1">
                        <form action="/portal/warehouse-management/picking-despatch/pick-lot/despatch-picking" method="POST">
                        
                            @csrf
                            <input type="hidden" name="buildsaleslot_salelot" value="{{$saleLot->id}}">
                            <input type="submit" id="despatchpickingsaleslot" class="btn btn-primary btn-blue mx-auto w-100" value="Despatch" @if($saleLot->sales_lot_status !== 4) disabled @endif>

                        </form>
                    </div>

                </div>

            </div>

            <div class="col-md-8">
                <table class="portal-table my-3" id="pick-sales-lot-boxes">
                    <tr>
                        <th><div class="table-element">Box number</div></th>
                        <th><div class="table-element">Grade</div></th>
                        <th><div class="table-element">Qty</div></th>
                    </tr>
                    @foreach ($boxes as $box)
                    <tr @if($box->status === 5) class="box-picked" @endif>
                        <td><div class="table-element">{{$box->tray_name}}</div></td>
                        <td><div class="table-element">{{$box->tray_grade}}</div></td>
                        <td><div class="table-element">{{$box->number_of_devices}}</div></td>
                    </tr>
                    @endforeach
                </table>
                <table class="portal-table my-3" id="pick-sales-lot-devices">
                    <tr>
                        <th><div class="table-element">Trade in barcode</div></th>
                        <th><div class="table-element">Box number</div></th>
                        <th><div class="table-element">Grade</div></th>
                        <th><div class="table-element">Model</div></th>
                        <th><div class="table-element">IMEI</div></th>
                    </tr>
                    @foreach ($devices as $device)
                    <tr @if($device->job_state === '29') class="device-picked" @endif>
                        <td><div class="table-element">{{$device->barcode}}</div></td>
                        <td><div class="table-element">{{$device->box_location}}</div></td>
                        <td><div class="table-element">{{$device->cosmetic_condition}}</div></td>
                        <td><div class="table-element">{{$device->product_name}}</div></td>
                        <td><div class="table-element">{{$device->imei_number}}</div></td>
                    </tr>
                    @endforeach
                </table>     
            </div>

        </div>

    </div>
</div>

@endsection