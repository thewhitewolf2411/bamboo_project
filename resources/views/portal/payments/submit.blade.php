<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <title>Bamboo Recycle::Pending Payment Jobs</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Submit Payments</p>
                    </div>
                </div>

                <div class="portal-table-container">
                    <div class="row">
                        <h5 class="text-center ml-auto">Payment batches</h5>
                        <form id="export-batches" class="mb-2 ml-auto mr-4" method="POST" action="{{route('exportBatchesCSV')}}">
                            @csrf
                            <input id="batches_ids" type="hidden" name="batches" value=""/>
                            <button id="export-button" onclick="exportBatches()" class="btn btn-light disabled mb-2 ml-auto mr-0">Export</button>
                        </form>
                    </div>
                    <table class="portal-table sortable" id="batches-table">
                        <tr>
                            <td><div class="table-element">Reference</div></td>
                            <td><div class="table-element">Arrival Date</div></td>
                            <td><div class="table-element">Devices</div></td>
                            <td><div class="table-element">
                                <input id="selectAll" type="checkbox" class="form-check-input m-0" onclick="selectAll()"/>
                            </div></td>
                        </tr>
                        @foreach($payment_batches as $batch)
                            <tr>
                                <td><div class="table-element">{{$batch->reference}}</div></td>
                                <td><div class="table-element">{{$batch->arrive_at}}</div></td>
                                <td><button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#batchDevices{{$batch->id}}">
                                    {{$batch->devicesCount()}}
                                </button></td>
                                <td><div class="table-element">
                                    <input type="checkbox" onchange="checkExport()" id="{{$batch->id}}" name="selected_batches" value="{{$batch->id}}" class="table-element m-0"/>
                                </div></td>

                                 <!-- Modal -->
                                <div class="modal fade" id="batchDevices{{$batch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Batch devices</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color: black;">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="p-4 row justify-content-center">
                                                    @foreach($batch->getDevices() as $tradein)
                                                        <div class="card p-2 m-2 shadow-none col-3 border-secondary">
                                                            <p class="m-0">Customer: </p> {!!$tradein->customer!!}
                                                            <p class="m-0 mt-1">Device: </p> {!!$tradein->device!!}
                                                            <p class="m-0 mt-1">Order price: </p> {!!$tradein->order_price !!} £
                                                        </div>
                                                    @endforeach      
                                                </div>                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </table>

                </div>


                <div class="portal-table-container">
                    <div class="row">
                        <h5 class="text-center ml-auto mr-auto mb-4">Submitted batches</h5>
                    </div>
                    <table class="portal-table sortable" id="batches-table">
                        <tr>
                            <td><div class="table-element">Reference</div></td>
                            <td><div class="table-element">Arrival Date</div></td>
                            <td><div class="table-element">Devices</div></td>
                            <td><div class="table-element"></div></td>
                        </tr>
                        @foreach($submitted_batches as $submitted_batch)
                            <tr>
                                <td><div class="table-element">{{$submitted_batch->reference}}</div></td>
                                <td><div class="table-element">{{$submitted_batch->arrive_at}}</div></td>
                                <td><button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#submittedBatchDevices{{$submitted_batch->id}}">
                                    {{$submitted_batch->devicesCount()}}
                                </button></td>
                                <td><div class="table-element">
                                    {{-- <input type="checkbox" onchange="checkExport()" id="{{$submitted_batch->id}}" name="selected_batches" value="{{$submitted_batch->id}}" class="table-element m-0"/> --}}
                                    <a class="btn btn-green" href="{{ route('getBatchCSV' , ['batchid' =>$submitted_batch->id]) }}" target="_blank">Download</a>
                                </div></td>

                                 <!-- Modal -->
                                <div class="modal fade" id="submittedBatchDevices{{$submitted_batch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Batch devices</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color: black;">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="p-4 row justify-content-center">
                                                    @foreach($submitted_batch->getDevices() as $tradein)
                                                        <div class="card p-2 m-2 shadow-none col-3 border-secondary">
                                                            <p class="m-0">Customer: </p> {!!$tradein->customer!!}
                                                            <p class="m-0 mt-1">Device: </p> {!!$tradein->device!!}
                                                            <p class="m-0 mt-1">Order price: </p> {!!$tradein->order_price !!} £
                                                        </div>
                                                    @endforeach      
                                                </div>                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </table>

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

function selectAll(){
    let rowCount = document.getElementById("batches-table").rows.length;
    let selectState = document.getElementById("selectAll").checked;
    if(rowCount > 1){
        let items = document.getElementsByName('selected_batches');

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

    checkExport();
}

function checkExport(){
    let items = document.getElementsByName('selected_batches');
    let button = document.getElementById('export-button');
    var canSubmit = false;
    items.forEach(element => {
        if(element.checked){
            canSubmit = true;
        }
    });
    if(canSubmit){
        if(button.classList.contains('disabled')){
            button.classList.remove('disabled');
            button.classList.remove('btn-light');
            button.classList.add('btn-green');
        }
    } else {
        if(!button.classList.contains('disabled')){
            button.classList.remove('btn-green');
            button.classList.add('disabled');
            button.classList.add('btn-light');
        }
    }
}

function exportBatches(){
    event.preventDefault();
    if(!document.getElementById('export-button').classList.contains('disabled')){
        let items = document.getElementsByName('selected_batches');
        let ids = [];
        for (let index = 0; index < items.length; index++) {
            if(items[index].checked){
                ids.push(items[index].id);
            }
        }

        let inputval = document.getElementById('batches_ids');
        inputval.value = ids;
        // /submit/export/csv
        document.getElementById('export-batches').submit();

        document.getElementById('selectAll').checked = false;
        items.forEach(element => {
            element.checked = false;
        });
        checkExport();
    }
}

function showModal(id){
    let modal = document.getElementById('batchDevices');
    if(modal.classList.contains('fade')){
        modal.classList.add('show');
    }
}

</script>


</html>
