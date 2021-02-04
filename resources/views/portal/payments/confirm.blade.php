<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/Sort.js') }}"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <title>Bamboo Recycle::Completed Payment Jobs</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Payment Confirmations</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    <div class="row mb-4">
                        {{-- <h5 class="text-center m-auto">Devices submitted for payment</h5> --}}


                        <form class="d-flex align-items-center ml-auto mr-auto text-center" action="/portal/payments/confirm" method="GET">              
                            <label for="searchbatches">Search by Reference/Barcode/ID:</label>
                            <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                            <button type="submit" class="btn btn-primary btn-blue">Search</button>
                            @if(isset(request()->search)) <a class="btn" href="/portal/payments/confirm">Cancel</a> @endif
                        </form>
                    </div>

                    <table class="portal-table sortable" id="batch-devices-table">
                        <tr>
                            <td><div class="table-element">Batch Reference</div></td>
                            <td><div class="table-element">Tradein ID</div></td>
                            <td><div class="table-element">Tradein Barcode number</div></td>
                            <td><div class="table-element">Order Date</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Price</div></td>
                            <td><div class="table-element">Cheque number</div></td>
                            <td class="sorttable_nosort"><div class="table-element">
                                <input id="selectAll" type="checkbox" class="form-check-input m-0 w-auto" onclick="selectAll()"/>
                            </div></td>
                        </tr>
                        @foreach($devices as $batch_device)
                            <tr id="{{$batch_device->id}}">
                                <td><div class="table-element">{!!$batch_device->batchReference()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->tradeinId()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->tradeinBarcode()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->orderDate()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->product()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->price()!!} £</div></td>
                                <td><div class="table-element">{!!$batch_device->cheque_number!!}</div></td>
                                <td><div class="table-element">
                                    <input type="checkbox" onchange="checkBatchDevices()" id="{{$batch_device->id}}" name="selected_devices" value="{{$batch_device->id}}" class="table-element m-0 w-auto"/>
                                </div></td>
                            </tr>
                        @endforeach
                    </table>

                </div>

                <div class="row justify-content-center">
                    <div class="btn btn-danger disabled m-2" id="mark-failed" onclick="markAsFailed()">Mark as failed</div>
                    <div class="btn btn-info disabled m-2" id="mark-success" onclick="markAsSuccessful()">Mark as paid</div> 
                    <div class="btn btn-light disabled m-2" id="export" onclick="exportBatch()">Export file</div> 
                </div>

            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

});

var ANY_SELECTED = false;
var ONE_SELECTED = false;

function selectAll(){
    let rowCount = document.getElementById("batch-devices-table").rows.length;
    let selectState = document.getElementById("selectAll").checked;
    if(rowCount > 1){
        let items = document.getElementsByName('selected_devices');

        // check if select/deselect all
        let anyChecked = false;
        items.forEach(element => {
            if(selectState){
                element.checked = true;
            } else {
                element.checked = false;
            }
        });
    }

    checkBatchDevices();
}

function checkBatchDevices(){
    let items = document.getElementsByName('selected_devices');
    let successbtn = document.getElementById('mark-success');
    let failbtn = document.getElementById('mark-failed');
    let exportbtn = document.getElementById('export');

    ANY_SELECTED = false;
    ONE_SELECTED = false;
    let total = 0;
    items.forEach(element => {
        if(element.checked){
            ANY_SELECTED = true;
            total++;
        }
    });
    if(total === 1){
        ONE_SELECTED = true;
        if(exportbtn.classList.contains('disabled')){
            exportbtn.classList.remove('disabled');
        }
    } else {
        ONE_SELECTED = false;
        if(!exportbtn.classList.contains('disabled')){
            exportbtn.classList.add('disabled');
        }
    }

    if(ANY_SELECTED){
        if(successbtn.classList.contains('disabled')){
            successbtn.classList.remove('disabled');
        }
        if(failbtn.classList.contains('disabled')){
            failbtn.classList.remove('disabled');
        }
    } else {
        if(!successbtn.classList.contains('disabled')){
            successbtn.classList.add('disabled');
        }
        if(!failbtn.classList.contains('disabled')){
            failbtn.classList.add('disabled');
        }
    }
}


function markAsSuccessful(){
    if(ANY_SELECTED){
        let items = document.getElementsByName('selected_devices');
        let total = 0;
        let ids = [];
        items.forEach(element => {
            if(element.checked){
                ids.push(element.id);
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('markAsSuccess')}}",
            data: {
                _token: '{{csrf_token()}}',
                ids: ids
            },
            success: function(data, textStatus, xhr) {            
                // if(xhr.status === 200){
                //     alert('Device payment(s) marked as successful.');
                //     window.location.reload(true);
                // }
            },
            fail: function(xhr, textStatus, errorThrown){
                //
            }
        });
    }
}

function markAsFailed(){
    if(ANY_SELECTED){
        let items = document.getElementsByName('selected_devices');
        let total = 0;
        let ids = [];
        items.forEach(element => {
            if(element.checked){
                ids.push(element.id);
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('markAsFailed')}}",
            data: {
                _token: '{{csrf_token()}}',
                ids: ids
            },
            success: function(data, textStatus, xhr) {
                if(xhr.status === 200){
                    // alert('Device payment(s) marked as failed.');
                    // window.location.reload(true);
                }
            },
            fail: function(xhr, textStatus, errorThrown){
                //
            }
        });
    }
}

function exportBatch(batchdeviceid){
    if(ONE_SELECTED){
        window.open("/portal/payments/submit/downloadcsv?batchdevice_id="+batchdeviceid, "_blank");
    }
}

</script>


</html>
