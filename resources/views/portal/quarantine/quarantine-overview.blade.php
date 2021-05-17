@extends('portal.layouts.portal')

@section('content')
<div class="container-fluid">
    <div class="portal-title-container">
        <div class="portal-title">
            <p>Quarantine Overview</p>
        </div>
    </div>


    <div class="">

        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}

            @if(Session::has('notallocated'))
            Barcode numbers of the devices that hasn't been allocated to new trays:
            <ul>
                @foreach(Session::get('notallocated') as $notAssigned)
                    <li>{{$notAssigned}}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif
        <form method="post">
            @csrf
            <div class="row mb-3">
                <!-- Check security issues later -->
                <div class="col-md-2">
                    <input id="export_csv" type="submit" class="custombtn btn-green" onclick="javascript: form.action='/portal/quarantine/export-csv';" value="Export CSV" disabled>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <input id="allocate_to_tray" type="submit" class="custombtn btn-green" onclick="javascript: form.action='/portal/quarantine/allocate-to-tray';" value="Allocate to Tray">
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <input id="return_to_customer" type="submit" class="custombtn btn-green" onclick="javascript: form.action='/portal/quarantine/return-to-customer';" value="Return to Customer">
                </div>
            </div>
            <table class="portal-table" id="quarantine-overview-table">
                <thead>
                    <tr>
                        <td><div class="table-element">Trade-in ID</div></td>
                        <td><div class="table-element">Trade-in Barcode</div></td>
                        <td><div class="table-element">Model</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Bamboo Status</div></td>
                        <td><div class="table-element">Quarantine Reason</div></td>
                        <td><div class="table-element">Stock location</div></td>
                        <td><div class="table-element">Order Date</div></td>
                        <td><div class="table-element">Quarantine Date</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element"><input type="checkbox" id="selectAllQuarantineDevices"></div></td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td><div class="table-element">Trade-in ID</div></td>
                        <td><div class="table-element">Trade-in Barcode</div></td>
                        <td><div class="table-element">Model</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Bamboo Status</div></td>
                        <td><div class="table-element">Quarantine Reason</div></td>
                        <td><div class="table-element">Stock location</div></td>
                        <td><div class="table-element">Order Date</div></td>
                        <td><div class="table-element">Quarantine Date</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Tag</div></td>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($tradeins as $tradein)

                    <tr>
                        <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                        <td><div class="table-element">{{$tradein->barcode}}</div></td>
                        <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                        @if($tradein->imei_number !== null)
                        <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                        @elseif($tradein->serial_number !== null)
                        <td><div class="table-element">{{$tradein->serial_number}}</div></td>
                        @else
                        <td><div class="table-element">N/A</div></td>
                        @endif
                        <td><div class="table-element">{{$tradein->getBambooStatus()}}</div></td>
                        <td><div class="table-element">
                            @if($tradein->job_state === '7')
                            <select name="quarantinereasons" id="quarantinereasons-{{$tradein->id}}" class="form-control quarantinereasons">
                                <option value="" disabled default selected>Select quarantine reason</option>
                                <option value="1">Lost</option>
                                <option value="2">Insurance Claim</option>
                                <option value="3">Blocked / FRP</option>
                                <option value="4">Stolen</option>
                                <!--<option value="5">Knox</option>-->
                                <option value="6">Asset Watch</option>
                            </select>
                            @elseif($tradein->getQuarantineReason())

                                <div class="row w-100">
                                    <div class="col-md-9 d-flex align-items-center">
                                    <p>{{$tradein->quarantine_reason}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="removeQuarantineReason({{$tradein->id}})" class="btn btn-green" title="Remove quarantine reason">x</a>
                                    </div>
                                </div>
                                
                            @else
                                {{$tradein->getTestingQuarantineReason()}}
                            @endif
                        </div></td>
                        <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                        <td><div class="table-element">{{$tradein->created_at}}</div></td>
                        <td><div class="table-element">{{$tradein->quarantine_date}}</div></td>
                        <td><div class="table-element">{{$tradein->getDeviceBambooGrade()}}</div></td>
                        <td><div class="table-element"><input onclick="enablebtn()" class="exportbtn" type="checkbox" name="tradein-{{$tradein->id}}"></div></td>
                    </tr>

                    @endforeach
                </tbody>


            </table>

        </form>

    </div>

</div>


@if(Session::has('hasTradeIns'))
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<div id="return-to-customer-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Devices to send to customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">

            <form action="/portal/quarantine/return-to-customer" method="POST">
                @csrf
                <div class="form-group my-3">
                    <label for="submitscannedid_returntocustomer">Scan or type trade in id:</label>
                    <input type="text" class="form-control" name="submitscannedid_returntocustomer" id="submitscannedid_returntocustomer">
                    <button class="btn btn-primary btn-blue" id="submitscannedid_returntocustomer">Scan</button>
                </div>
            </form>

            <div id="statement">
                    
            </div>

            <form action="/portal/quarantine/mark-devices-return-to-customer" method="post">
                <table class="portal-table" id="categories-table">

                    <label>These devices are marked for return to customer. Please confirm.</label>
                    <tr>
                        <td><div class="table-element">Trade-in Barcode</div></td>
                        <td><div class="table-element">Model</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Stock Location</div></td>
                    </tr>
                    
                        @csrf
                        @foreach(Session::get('returnToCustomer') as $tradein)
                        <input type="hidden" name="tradein-{{$tradein->id}}" value="{{$tradein->id}}">
                        @if($tradein->job_state !== '19')
                        <script>
                        
                            $('#statement').append('<div class="alert alert-warning"> Order number ' + {!! $tradein->barcode !!} + ' has not been requested by customer to be returned. Are you sure? </div>')
                        
                        </script>
                        @endif
                        <tr @if($tradein->job_state !== '19') style="background: #fff3cd !important" @else style="background: #d4edda !important" @endif >
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            @if($tradein->imei_number === null)
                            <td><div class="table-element">{{$tradein->serial_number}}</div></td>
                            @else
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            @endif
                            <td><div class="table-element">{{$tradein->cosmetic_condition}}</div></td>
                            <td><div class="table-element">Despatch</div></td>
                        </tr>
                        @endforeach

                        
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
        $('#return-to-customer-modal').modal('show');
    });


</script>
@endif

@if(Session::has('hasAllocateToTrays'))
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<div id="allocate-to-tray-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Allocate devices to tray</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body p-5">

            <form action="/portal/quarantine/allocate-to-tray" method="POST">
                @csrf
                <div class="form-group my-3">
                    <label for="submitscannedid_allocatetotray">Scan or type trade in id:</label>
                    <input type="text" class="form-control" name="submitscannedid_allocatetotray" id="submitscannedid_allocatetotray">
                    <button class="btn btn-primary btn-blue" id="submitscannedid_allocatetotray">Scan</button>
                </div>
            </form>

            <div id="statement">
                    
            </div>


            <form action="/portal/quarantine/reallocate-devices-to-trays" method="post">
                <table class="portal-table" id="categories-table">

                    <label>These devices are being removed from quarantine to another tray. Please select new destination and confirm.</label>
                    <tr>
                        <td><div class="table-element">Trade-in Barcode</div></td>
                        <td><div class="table-element">Model</div></td>
                        <td><div class="table-element">IMEI</div></td>
                        <td><div class="table-element">Bamboo Grade</div></td>
                        <td><div class="table-element">Stock Location</div></td>
                    </tr>
                    
                        @csrf
                        @foreach(Session::get('allocateToTrays') as $tradein)
                            <tr>
                                <td><div class="table-element">{{$tradein->barcode}}</div></td>
                                <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                                <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                                <td><div class="table-element">{{$tradein->getDeviceBambooGrade()}}</div></td>
                                <td><div class="table-element"><select id="newtray" name="newtray-{{$tradein->id}}" class="form-control" ><option value="" selected disabled>Select new tray</option>@foreach(Session::get('trays') as $tray) <option value="{{$tray->id}}">{{$tray->tray_name}}</option> @endforeach</select></div></td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="form-group my-3">
                        
                    </div>

                <div class="row">
                    <div class="col-md-6"><input type="submit" id="submitallocation" class="btn btn-primary my-3" value="Submit" disabled onclick="return confirm('Are you sure you want to allocate these devices to selected tray?.');"></div>
                    <div class="col-md-6"><a role="button" class="w-100 my-3" data-dismiss="modal" aria-label="Cancel"><div class="btn btn-primary w-100 my-3">Cancel</div> </a></div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){
        $('#allocate-to-tray-modal').modal('show');
    });


</script>
@endif


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>

$('.quarantinereasons').change(function(){

    var val = "";
    var id = this.id;
    var numval = this.value;

    var name = this.options[this.selectedIndex].text;

    id = id.split('-')[1];

    switch(this.value){
        case "1":
            val = "8a";
        break;

        case "2":
            val = "8b";
        break;

        case "3":
            val = "8c";
        break;

        case "4":
            val = "8d";
        break;

        case "5":
            val = "8e";
        break;

        case "6":
            val = "8f";
        break;
    }

    if(confirm('This will set quarantine reason as ' + name + '. Are you sure?')){
        $.ajax({
            url: "/portal/quarantine/addQuarantineStatus",
            type:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                id: id,
                val: val,

            },
            success:function(response){
                if(response == 200){
                    location.reload();
                }
            },
        });
    }

});

function removeQuarantineReason(tradeinId){

    if(confirm('This will remove quarantine reason from this order. Are you sure?')){

        $.ajax({
            url: "/portal/quarantine/removeQuarantineStatus",
            type:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                id: tradeinId,
            },
            success:function(response){
                if(response == 200){
                    location.reload();
                }
            },
        });
        
    }

}

function enablebtn(){

    var k=0;
    var chckbox = $('.exportbtn');

    for(var i=0; i<chckbox.length; i++){
        if(chckbox[i].checked){
            k++;
        }
    }

    if(k>0){
        $('#export_csv').prop("disabled", false);
    }

    else{
        $('#export_csv').prop("disabled", true);
    }

}

$('#selectAllQuarantineDevices').on('change', function(){
    $('input:checkbox').not(this).prop('checked', this.checked);

    enablebtn();
})

</script>
@endsection