@extends('portal.layouts.portal')

@section('content')
    <div class="portal-app-container">
        <div class="portal-title-container">
            <div class="portal-title">
                <p>Bin {{$bin->tray_name}}</p>
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
        <form method="post" action="/portal/quarantine-bins/{{$bin->tray_name}}/allocatedevice">
            @csrf
            <div class="row mb-3">
                <!-- Check security issues later -->
                <div class="col-md-2">
                    <input id="export_csv" type="submit" class="custombtn btn-green" value="Allocate devices">
                </div>
            </div>
            <div class="portal-table-container">
                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Bin Location</div></td>
                        <td><div class="table-element">Device Quantity</div></td>
                        <td><div class="table-element">Maximum number of devices</div></td>
                        <td><div class="table-element">Print Label</div></td>
                    </tr>
                    <tr>
                        <td><div class="table-element">{{$bin->tray_name}}</div></td>
                        <td><div class="table-element">{{$bin->number_of_devices}}</div></td>
                        <td><div class="table-element">{{$bin->max_number_of_devices}}</div></td>
                        <td><div class="table-element"><a class="printbinlabel" data-value="{{$bin->id}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Bin Label</p></div></a></div></td>
                    </tr>
                </table>

                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Bin {{$bin->tray_name}} Content</p>
                    </div>
                </div>

                <table class="portal-table sortable" id="categories-table">
                    <tr>
                        <td><div class="table-element">Trade-in ID</div></td>
                        <td><div class="table-element">Tradein Barcode</div></td>
                        <td><div class="table-element">Product name</div></td>
                        <td><div class="table-element">IMEI Number</div></td>
                    </tr>
                    @foreach($quarantineBinContent as $tradein)
                    <tr>
                        <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                        <td><div class="table-element">@if($tradein->imei_number === null) {{$tradein->serial_number}} @else {{$tradein->imei_number}} @endif</div></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </form>

    </div>


    @if(Session::has('adddevices') && Session::get('adddevices'))

    <div id="add-devices-to-bin" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add devices to bin {{$bin->tray_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form action="/portal/quarantine/add-devices-to-bin-form" method="post">
                    <table id="addeddevicestable" class="portal-table" id="categories-table">
                        <div id="statement">
                        
                        </div>

                        <label>You can only add {{Session::get('devices_type')}} devices to this bin.</label>
                    

                            @csrf
                            <div class="form-group" id="form-inputs">
                                <label for="checkdevice">Scan or type Trade-in Barcode number:</label>
                                <input type="text" class="form-control" id="checkdevice">
                                <input type="hidden" id="bingrade" value="{{Session::get('devices_type')}}">
                                <input type="hidden" id="binname" value="{{$bin->tray_name}}">
                                <input type="hidden" name="binname" value="{{$bin->tray_name}}">
                                <a role="button" id="checkdevicesubmit"><div class="btn btn-primary">Add device</div></a>
                            </div>

                            <div id="addeddevices">
                                <tr>
                                    <td><div class="table-element">Trade-in Barcode</div></td>
                                    <td><div class="table-element">Model</div></td>
                                    <td><div class="table-element">IMEI</div></td>
                                    <td><div class="table-element">Bamboo Grade</div></td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('js\scanner\scannerdetection.js')}}"></script>
    <script>

        $(document).ready(function(){
            $('#add-devices-to-bin').modal('show');
        });


        $('#checkdevicesubmit').on('click', function(){

            var id = $('#checkdevice').val();
            var bintype = $('#bingrade').val();
            var binname = $('#binname').val();

            $.ajax({
                    url: "/portal/quarantine-bins/bin/checkAddingDevicesToBin",
                    type:"POST",
                    data:{
                        _token: "{{ csrf_token() }}",
                        id: id,
                        bintype: bintype,
                        binname: binname,

                    },
                    success:function(response){
                        if(response.deviceadded == 0){
                            $('#statement').html('<div class="alert alert-warning">' + response.error + '</div>');
                        }
                        else if(response.deviceadded == 1){

                            if($('#addeddevicestable tr').length > 1){
                                if($('#addeddevicestable #' + response.order.id).length == 0 ){
                                    if(response.order.imei_number === null){
                                        $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.serial_number + '</div></td><td><div class="table-element">' + response.order.cosmetic_condition + '</div></td></tr>');
                                    }
                                    else{
                                        $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.imei_number + '</div></td><td><div class="table-element">' + response.order.cosmetic_condition  + '</div></td></tr>');
                                    }
                                    $('#form-inputs').append('<input type="hidden" name="tradein-'+ response.order.id + '" value="'+ response.order.id +'">');
                                }
                                else{
                                    $('#statement').html('<div class="alert alert-warning"> This device was already added. </div>');
                                }
                                
                            }
                            else{
                                if(response.order.imei_number === null){
                                        $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.serial_number + '</div></td><td><div class="table-element">' + response.grade + '</div></td></tr>');
                                }
                                else{
                                    $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.imei_number + '</div></td><td><div class="table-element">' + response.grade + '</div></td></tr>');
                                }
                                //$('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.imei_number + '</div></td><td><div class="table-element">' + response.grade + '</div></td></tr>');
                                $('#form-inputs').append('<input type="hidden" name="tradein-'+ response.order.id + '" value="'+ response.order.id +'">');
                            }

                            
                        }

                        $('#checkdevice').val('');
                    },
            });


        });

        $(document).scannerDetection({
	   
       //https://github.com/kabachello/jQuery-Scanner-Detection
       
       timeBeforeScanTest: 200, // wait for the next character for upto 200ms
       avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
       preventDefault: true,
   
       endChar: [13],
       onComplete: function(barcode, qty){
           //validScan = true;
           //$('#search_id').val (barcode);
       }, // main callback function	,
       onError: function(string, qty) {
           $('#checkdevice').val (string);
           document.getElementById('checkdevicesubmit').click();
       }
            
            
    });

    </script>
    @endif

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
