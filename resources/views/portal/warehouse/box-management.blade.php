@extends('portal.layouts.portal')

@section('content')
<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Box Management</p>
        </div>
    </div>
    <div class="portal-table-container p-0">

        <div class="d-flex">
            <div class="col-md-4">
                <form action="/portal/warehouse-management/box-management/createbox" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="manifacturer">Manufacturer:</label>
                        @if(isset($box))
                            <input type="text" class="form-control" disabled value="{{$box->tray_brand}}">
                        @endif
                        <select class="form-control" name="manifacturer" id="manifacturer" required @if(isset($box)) style="display: none" @endif>
                            <option selected value="" disabled>Please select manufacturer</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                            @endforeach
                            <option value="4">Miscellaneous</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="reference">Box Reference:</label>
                        @if(isset($box))
                            <input type="text" class="form-control" disabled value="{{$box->tray_grade}}">
                        @endif
                        <select class="form-control" name="reference" id="reference" disabled @if(isset($box)) style="display: none" @endif>
                            <option selected value="" disabled>Please select reference</option>
                            <option value="a" >A</option>
                            <option value="b+" >B+</option>
                            <option value="b" >B</option>
                            <option value="c" >C</option>
                            <option value="wsi" >WSI</option>
                            <option value="wsd" >WSD</option>
                            <option value="nwsi" >NWSI</option>
                            <option value="nwsd" >NWSD</option>
                            <option value="cat" >CAT</option>
                            <option value="fimp" >FMIP</option>
                            <option value="gock" >GOCK</option>
                            <option value="sick" >SICK</option>
                            <option value="tab" >TAB</option>
                            <option value="sw" >SW</option>
                            <option value="bl" >BL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="network">Network:</label>
                        @if(isset($box))
                            <input type="text" class="form-control" disabled value="{{$box->tray_network}}">
                        @endif
                        <select class="form-control" name="network" id="network" disabled @if(isset($box)) style="display: none" @endif>
                            <option selected value='' disabled>Please select network</option>
                            <option value="l">Locked</option>
                            <option value="u">Unlocked</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Box number:</label>
                        @if(isset($box))
                            <input type="text" class="form-control" disabled value="{{$box->tray_name}}">
                        @endif
                        <input type="number" class="form-control" name="number" id="number" disabled @if(isset($box)) style="display: none" @endif>
                    </div>

                    <div class="form-group">
                        <label for="capacity" @if(isset($box)) style="display: none" @endif>Box Capacity:</label>
                        <input type="number" max="100" class="form-control" name="capacity" id="capacity" required @if(isset($box)) style="display: none" @endif>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><input type="submit" class="btn btn-primary my-3" value="Start" @if(isset($box)) style="display: none" @endif></div>
                    </div>
                </form>

                <!--  -->
                <form @isset($box) action="/portal/warehouse-management/box-management/addtobox" method="post" @endisset>
                    @csrf

                    @isset($box)
                    <input type="hidden" name="boxid" value="{{$box->id}}">
                    @endisset

                    <div class="form-group">
                        <label for="tradein_barcode">Scan trade in barcode:</label>
                        <input type="number" class="form-control" name="tradein_barcode" id="tradein_barcode" required autofocus>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><button type="submit" class="btn btn-primary my-3" @if(isset($box)) @else disabled @endif>Submit</button></div>
                    </div>

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                      </div>
                    @endif
                </form>

                @if(isset($box))

                <div class="row my-3">
                    <div class="button-box col-lg-12">
                        <button id="cancel-box" style="width:32%" class="btn btn-info" data-value="{{$box->id}}" role="button">Cancel</button>
                        <button id="suspend-box" style="width:32%" class="btn btn-info" data-value="{{$box->id}}" role="button">Suspend</button>
                        <button id="complete-box" style="width:32%" class="btn btn-info" data-value="{{$box->id}}" role="button">Complete box</button>
                    </div>
                </div>

                @endif
            </div>

            
            
            <div class="col-md-8" id="boxtabledevices">
                <div class="row my-3 align-items-center">
                    <div class="button-box col-lg-4">
                        <button id="box-in-progress" class="btn btn-info" role="button" @if(!isset($box)) disabled @endif>In progress</button>
                        <button id="boxed-devices" class="btn btn-info" role="button">Boxed</button>
                        <button id="boxes-summary" class="btn btn-info" role="button">Summary</button>
                    </div>
                    <div class="button-box col-lg-6 d-flex align-items-center">

                        @if(isset($box))

                        <div class="d-flex align-items-center mr-3 p-3 border">
                            <span style="color: #000">Box Reference:</span>
                            <span style="color: red"><b>{{$box->tray_name}}</b></span>
                        </div>

                        <div class="d-flex flex-column ml-3">
                            <p style="color: red"><b>Boxed device: {{$box->getNumberOfDevices()}} / {{$box->max_number_of_devices}}</b></p>
                            <p style="color: red"><b>Devices left to scan: {{$box->max_number_of_devices - $box->getNumberOfDevices()}}</b></p>
                        </div>

                        @endif
                    </div>
                    <div class="button-box col-lg-2">
                        @if(isset($box))
                        <button id="remove-device-from-box" class="btn btn-info" role="button" disabled>Remove devices</button>
                        @endif
                    </div>
                </div>

                <div class="box-table-hidden" id="box-in-progress-table-container">
                    <table class="portal-table" id="box-in-progress-table">
                        <thead>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Trade in barcode</div></td>
                                <td><div class="table-element">Grade</div></td>
                                <td><div class="table-element">IMEI</div></td>
                                <td><div class="table-element">Manufacturer/Model</div></td>
                                <td><div class="table-element">Checkbox</div></td>
                            </tr> 
                        </thead>
                        <tfoot>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Trade in barcode</div></td>
                                <td><div class="table-element">Grade</div></td>
                                <td><div class="table-element">IMEI</div></td>
                                <td><div class="table-element">Manufacturer/Model</div></td>
                                <td><div class="table-element">Checkbox</div></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(isset($box))
                            @foreach ($tradeins as $tradein)
                            <tr>
                                <td><div class="table-element">{{$box->tray_name}}</div></td>
                                <td><div class="table-element">{{$tradein->barcode}}</div></td>
                                <td><div class="table-element">{{$tradein->getDeviceBambooGrade()}}</div></td>
                                <td><div class="table-element">{{$tradein->imei_number ?? null ?: $tradein->serial_number}}</div></td>
                                <td><div class="table-element">{{$tradein->getProductName()}}</div></td>
                                <td><div class="table-element"><input type="checkbox" class="select-to-remove-from-box" id="{{$tradein->id}}"></div></td>
                            </tr>
                            @endforeach

                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-table-hidden" id="boxed-devices-table-container">
                    <table class="portal-table" id="boxed-devices-table">
                        <thead>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Trade in barcode</div></td>
                                <td><div class="table-element">Grade</div></td>
                                <td><div class="table-element">IMEI</div></td>
                                <td><div class="table-element">Manufacturer/Model</div></td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Trade in barcode</div></td>
                                <td><div class="table-element">Grade</div></td>
                                <td><div class="table-element">IMEI</div></td>
                                <td><div class="table-element">Manufacturer/Model</div></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($boxedTradeIns as $boxedTradein)
                            @if(!$boxedTradein->isPicked())
                            <tr>
                                <td><div class="table-element">{{$boxedTradein->getTrayName($boxedTradein->id)}}</div></td>
                                <td><div class="table-element">{{$boxedTradein->barcode}}</div></td>
                                <td><div class="table-element">{{$boxedTradein->getDeviceBambooGrade()}}</div></td>
                                @if($boxedTradein->imei_number  !== null)<td><div class="table-element">{{$boxedTradein->imei_number}}</div></td>
                                @elseif($boxedTradein->serial_number  !== null)<td><div class="table-element">{{$boxedTradein->serial_number}}</div></td>
                                @else<td><div class="table-element">N/A</div></td>@endif
                                <td><div class="table-element">{{$boxedTradein->getProductName()}}</div></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="box-table-hidden" id="box-summary-table-container">
                    <table class="portal-table" id="box-summary-table">
                        <thead>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Total Quantity</div></td>
                                <td><div class="table-element">Status</div></td>
                                <td><div class="table-element">Actions</div></td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td><div class="table-element">Box number</div></td>
                                <td><div class="table-element">Total Quantity</div></td>
                                <td><div class="table-element">Status</div></td>
                                <td><div class="table-element">Actions</div></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                            @foreach ($boxes as $test)
                                @if($test->status !== 10)
                                    <tr>
                                        <td><div class="table-element">{{$test->tray_name}}</div></td>
                                        <td><div class="table-element">{{$test->getNumberOfDevices()}}</div></td>
                                        <td><div class="table-element">{{$test->getBoxStatus()}}</div></td>
                                        <td><div class="table-element">
                                            <a role="button" class="printboxlabel" data-value="{{$test->tray_name}}" id="{{$test->tray_name}}">Label</a> / 
                                            <a role="button" class="printboxmanifest" data-value="{{$test->tray_name}}" id="{{$test->tray_name}}">Manifest</a> / 
                                            <a role="button" class="printboxsummary" data-value="{{$test->tray_name}}" id="{{$test->tray_name}}">Summary</a> / 
                                            @if(!$test->isBoxInSaleLot() && $test->trolley_id === null) <a href="/portal/warehouse-management/box-management/{{$test->id}}" id="{{$test->tray_name}}">Re-open Box</a> 
                                            @else 
                                                @if($test->trolley_id !== null)
                                                <a href="/portal/warehouse-management/bay-overview/bay/?bay_id_scan={{$test->getTrolleyName($test->trolley_id)}}" target="_blank">Box in a bay. </a>
                                                @else
                                                <a href="/portal/warehouse-management/box-management/{{$test->id}}" >Unsuspend box </a>
                                                @endif
                                            @endif
                                        </div></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@if(isset($box) && $box !== null)

    @if(Session::get('boxstatus') && Session::get('boxstatus')===3 && isset(Session::get('response')->original))
    <script>
        //window.open('/pdf/boxlabels/box-' + {{$box->id}}  + '.pdf', '_blank');
        window.open('{!!Session::get('response')->original!!}');
        location.href="/portal/warehouse-management/box-management/";
    </script>
    @endif

    @if(Session::has('filename'))
    <script>
        //window.open('/pdf/boxlabels/box-' + {{$box->id}}  + '.pdf', '_blank');
        window.open("{!!Session::get('filename')!!}");
    </script>
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>

    (function() {
        $('#boxed-devices').removeClass('btn-red');
        $('#boxes-summary').removeClass('btn-red');
        
        $('#box-in-progress').toggleClass('btn-red');
        if($('#box-in-progress-table-container').hasClass('box-table-hidden')){
            $('#box-in-progress-table-container').removeClass('box-table-hidden');
            $('#box-in-progress-table-container').addClass('box-table-show');
        }
        else{
            $('#box-in-progress-table-container').addClass('box-table-hidden');
            $('#box-in-progress-table-container').removeClass('box-table-show');
        }

        $('#boxed-devices-table-container').addClass('box-table-hidden');
        $('#boxed-devices-table-container').removeClass('box-table-show');

        $('#box-summary-table-container').addClass('box-table-hidden');
        $('#box-summary-table-container').removeClass('box-table-show');


    })();


    </script>

@endif
@endsection