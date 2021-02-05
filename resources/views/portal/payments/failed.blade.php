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

    <title>Bamboo Recycle::Payment Report</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Failed Payments</p>
                    </div>
                </div>

                <div class="p-2">

                    <table class="portal-table sortable" id="failed-batch-devices-table">
                        <tr>
                            <td><div class="table-element">Batch Reference</div></td>
                            <td><div class="table-element">Tradein ID</div></td>
                            <td><div class="table-element">Tradein Barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Price</div></td>
                            <td><div class="table-element">Failed date</div></td>
                            <td><div class="table-element">Bank details updated</div></td>
                            <td><div class="table-element">Cheque</div></td>
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
                                <td><div class="table-element">{!!$batch_device->failedDate()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->bankDetailsUpdated()!!}</div></td>
                                <td><div class="table-element">{!!$batch_device->cheque_number!!}</div></td>
                                <td><div class="table-element">
                                    <input type="checkbox" onchange="checkBatchDevices()" id="{{$batch_device->id}}" name="selected_devices" value="{{$batch_device->id}}" class="table-element m-0 w-auto"/>
                                </div></td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="m-auto w-75">
                        <div class="mt-4 mb-4 row">
                            <div id="fpbatchref" class="btn btn-blue w-25 mr-0 ml-auto disabled" onclick="toggleFpBatch()" style="display:block;">New Batch</div>
                            <div class="ml-0 mr-auto p-2 border">{!!$fp_ref!!}</div>
                        </div>
                        <div class="mt-4 mb-4 row">
                            <div id="fcbatchref" class="btn btn-blue w-25 mr-0 ml-auto disabled" onclick="toggleFcBatch()" style="display:block;">New Batch</div>
                            <div class="ml-0 mr-auto p-2 border">{!!$fc_ref!!}</div>
                        </div>
                        <div class="mt-4 mb-4 row">
                            <div id="submitbatch" class="btn btn-blue w-25 mr-auto ml-auto disabled" onclick="submitBatch()" style="display:block;">Submit batch</div>
                        </div>
                    </div>

                </div>

            </div>

            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    // var elem = $('.portal-links-container > .portal-header-element')[5];
    
    // console.log(elem.children[0]);

    // elem.children[0].style.color = "#fff";
    // elem.children[0].children[0].style.opacity = 1;

});

var ANY_SELECTED = false;
var CAN_SUBMIT = false;
var BATCH_TYPE = null;

function selectAll(){
    let rowCount = document.getElementById("failed-batch-devices-table").rows.length;
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
    let newfpbatch = document.getElementById('fpbatchref');
    let newfcbatch = document.getElementById('fcbatchref');
    let submit = document.getElementById('submitbatch');

    ANY_SELECTED = false;
    items.forEach(element => {
        if(element.checked){
            ANY_SELECTED = true;
        }
    });

    if(ANY_SELECTED){
        if(newfpbatch.classList.contains('disabled')){
            newfpbatch.classList.remove('disabled');
        }
        if(newfcbatch.classList.contains('disabled')){
            newfcbatch.classList.remove('disabled');
        }
    } else {
        if(!newfpbatch.classList.contains('disabled')){
            newfpbatch.classList.add('disabled');
        }
        if(!newfcbatch.classList.contains('disabled')){
            newfcbatch.classList.add('disabled');
        }
     
        if(newfcbatch.classList.contains('btn-orange')){
            newfcbatch.classList.remove('btn-orange');
            newfcbatch.classList.add('btn-blue');
        }
        if(newfpbatch.classList.contains('btn-orange')){
            newfpbatch.classList.remove('btn-orange');
            newfpbatch.classList.add('btn-blue');
        }

        if(!submit.classList.contains('disabled')){
            submit.classList.add('disabled');
        }

        BATCH_TYPE = null;
    }
}

function toggleFpBatch(){
    let submit = document.getElementById('submitbatch');
    let fpbtn = document.getElementById('fpbatchref');
    let fcbtn = document.getElementById('fcbatchref');

    if(ANY_SELECTED){

        if(fcbtn.classList.contains('btn-orange')){
            fcbtn.classList.remove('btn-orange');
            fcbtn.classList.add('btn-blue');
        }

        if(fpbtn.classList.contains('btn-blue')){
            fpbtn.classList.remove('btn-blue');
            fpbtn.classList.add('btn-orange');
            if(submit.classList.contains('disabled')){
                submit.classList.remove('disabled');
            }
            BATCH_TYPE = 'FP';
        } else {
            fpbtn.classList.remove('btn-orange');
            fpbtn.classList.add('btn-blue');
            if(!submit.classList.contains('disabled')){
                submit.classList.add('disabled');
            }
            BATCH_TYPE = null;
        }
    }
}

function toggleFcBatch(){
    let submit = document.getElementById('submitbatch');
    let fcbtn = document.getElementById('fcbatchref');
    let fpbtn = document.getElementById('fpbatchref');

    if(ANY_SELECTED){

        if(fpbtn.classList.contains('btn-orange')){
            fpbtn.classList.remove('btn-orange');
            fpbtn.classList.add('btn-blue');
        }

        if(fcbtn.classList.contains('btn-blue')){
            fcbtn.classList.remove('btn-blue');
            fcbtn.classList.add('btn-orange');
            if(submit.classList.contains('disabled')){
                submit.classList.remove('disabled');
            }
            BATCH_TYPE = 'FC';

        } else {
            fcbtn.classList.remove('btn-orange');
            fcbtn.classList.add('btn-blue');
            if(!submit.classList.contains('disabled')){
                submit.classList.add('disabled');
            }
            BATCH_TYPE = null;
        }
    }
}

function submitBatch(){
    let items = document.getElementsByName('selected_devices');
    var device_ids = [];
    for (let index = 0; index < items.length; index++) {
        if(items[index].checked){
            device_ids.push(items[index].id);
        }
        
    }
    if(BATCH_TYPE !== null){
        CAN_SUBMIT = true;
    } else {
        CAN_SUBMIT = false;
    }

    if(CAN_SUBMIT){
        $.ajax({
            type: "POST",
            url: "failed/createbatch",
            data: {
                _token: '{{csrf_token()}}',
                ids: device_ids,
                type: BATCH_TYPE
            },
            success: function(data, textStatus, xhr) {
                if(xhr.status === 200){
                    alert('Batch successfully created.');
                    window.location.reload(true);
                }
            }
        });
    }
}

</script>


</html>
