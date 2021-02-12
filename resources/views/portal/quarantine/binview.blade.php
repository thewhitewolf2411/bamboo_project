<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Bin</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
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
                                <td><div class="table-element"><a href="/portal/quarantine-bins/printlabel/{{$bin->tray_name}}"><div class="btn btn-primary btn-red"><p style="color: #fff;">Print Bin Label</p></div></a></div></td>
                            </tr>
                        </table>

                        <div class="portal-title-container">
                            <div class="portal-title">
                                <p>Bin {{$bin->bin_name}} Content</p>
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
                                <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </form>

            </div>
        </div>
    </main>

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

                        console.log($('#addeddevicestable #' + response.order.id));
                        if(response.deviceadded == 0){
                            $('#statement').html('<div class="alert alert-warning">' + response.error + '</div>');
                        }
                        else if(response.deviceadded == 1){

                            if($('#addeddevicestable tr').length > 1){
                                if($('#addeddevicestable #' + response.order.id).length == 0 ){
                                    $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.imei_number + '</div></td><td><div class="table-element">' + response.order.bamboo_grade + '</div></td></tr>');
                                    $('#form-inputs').append('<input type="hidden" name="tradein-'+ response.order.id + '" value="'+ response.order.id +'">');
                                }
                                else{
                                    $('#statement').html('<div class="alert alert-warning"> This device was already added. </div>');
                                }
                                
                            }
                            else{
                                $('#addeddevicestable').append('<tr id="' + response.order.id + '"><td><div class="table-element">' + response.order.barcode + '</div></td><td><div class="table-element">' + response.model + '</div></td><td><div class="table-element">' + response.order.imei_number + '</div></td><td><div class="table-element">' + response.order.bamboo_grade + '</div></td></tr>');
                                $('#form-inputs').append('<input type="hidden" name="tradein-'+ response.order.id + '" value="'+ response.order.id +'">');
                            }

                            
                        }
                    },
            });


        });


    </script>
    @endif


</body>

</html>
