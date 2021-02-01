<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <title>Bamboo Recycle::Payments Awaiting Assignment</title>
</head>

<body class="portal-body" onclick="handle()">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p class="pt-2 text-center">Awaiting Payments</p>

                        
                    </div>
                </div>

                <div class="m-auto w-75">
                    <form class="d-flex align-items-center mx-5 text-center" action="/portal/payments/awaiting" method="GET">              
                        <label for="searchtradeins">Search by Trade-in barcode / Trade-in ID:</label>
                        <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                        <button type="submit" class="btn btn-primary btn-blue">Search</button>
                        @if(isset(request()->search)) <a class="btn" href="/portal/payments/awaiting">Cancel</a> @endif
                    </form>
                    <div class="mt-4">
                        <div class="btn btn-primary btn-blue w-25 m-auto" style="display:block;" data-toggle="modal" data-target="#batchModal">New Batch</div>
                    </div>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Devices</h5>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in Barcode</div></td>
                            <td><div class="table-element">Model</div></td>
                            <td><div class="table-element">IMEI</div></td>
                            <td><div class="table-element">Bamboo Grade</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->id)}}</div></td>
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            <td><div class="table-element">{{$tradein->bamboo_grade}}</div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Trays</h5>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Tray ID</div></td>
                            <td><div class="table-element">Tray name</div></td>
                            <td><div class="table-element">Assigned trolley</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                        </tr>
                        @foreach($trays as $tray)
                        <tr>
                            <td><div class="table-element">{{$tray->id}}</div></td>
                            <td><div class="table-element">{{$tray->tray_name}}</div></td>
                            <td><div class="table-element">@if($tray->trolley_id == null) <p style="color:red;">Unassigned</p> @else <p style="color:green;"> {{$tray->getTrolleyName($tray->trolley_id)}} </p> @endif</div></a></td>
                            <td><div class="table-element">{{$tray->getTrayNumberOfDevices($tray->id)}}</div></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Trolleys</h5>
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trolley ID</div></td>
                            <td><div class="table-element">Trolley</div></td>
                            <td><div class="table-element">No of Trays</div></td>
                            <td><div class="table-element">No of Devices</div></td>
                        </tr>
                        @foreach($trolleys as $trolley)
                        <tr>
                            <td><div class="table-element">{{$trolley->id}}</div></td>
                            <td><div class="table-element">{{$trolley->trolley_name}}</div></td>
                            <td><div class="table-element">{{$trolley->number_of_trays}}</div></td>
                            <td><div class="table-element">{{$trolley->getNumberOfDevices($trolley->id)}}</div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                
                <!-- Batch Modal -->
                <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="batchModalLabel">Create Batch</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color: black;">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="d-flex align-items-center mx-5 text-center p-4">              
                                <label for="search_id">Search by Trade-in barcode / Trade-in ID:</label>
                                <input id="search_id" type="text" minlength="7" class="form-control mx-3 my-0" required>
                                <div class="btn btn-primary btn-blue" onclick="search()">Search</div>
                            </div>

                            <div id="search-results">
                                <table class="portal-table sortable" id="search-results-table">
                                    <tr id="hr">
                                        <td><div class="table-element">Trade-in Barcode</div></td>
                                        <td><div class="table-element">Model</div></td>
                                        <td><div class="table-element">IMEI</div></td>
                                        <td><div class="table-element">Bamboo Price</div></td>
                                        <td><div class="table-element">
                                            <input id="selectAll" type="checkbox" class="form-check-input m-0" onclick="selectAll()"/>
                                        </div></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" onclick="reset()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="create-button" onclick="createBatch()" type="button" class="btn btn-primary disabled">Create batch</button>
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

    var elem = $('.portal-links-container > .portal-header-element')[5];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // console.log(elem.children[0]);

    // elem.children[0].style.color = "#fff";
    // elem.children[0].children[0].style.opacity = 1;

});

function search(){
    clearTable();
    let searchterm = document.getElementById('search_id').value;
    $.ajax({
        type: "GET",
        url: "awaiting/search/"+searchterm,
        success: function(response) {
            if(response.length > 0){
                loadResults(response);
            }
        }
    });
}

function createBatch(){
    let button = document.getElementById('create-button');
    if(!button.classList.contains('disabled')){
        let devices = document.querySelectorAll("input[name='selected_devices']:checked");
        let ids = [];
        for (let i = 0; i < devices.length; i++) {
            let item = devices[i];
            ids.push(item.id);
        }

        $.ajax({
            type: "POST",
            url: "awaiting/createbatch",
            data: {
                _token: '{{csrf_token()}}',
                ids: ids
            },
            success: function(data, textStatus, xhr) {
                if(xhr.status === 200){
                    alert('Payment batch successfully created.');
                    window.location.reload(true);
                }
            }
        });
    }
}

function loadResults(results){
    let container = document.getElementById("search-results-table").childNodes[1];

    for (const [key, item] of Object.entries(results)) {

        let row = document.createElement('tr');

        let td_barcode = document.createElement('td');
        let barcode_div = document.createElement('div');
        barcode_div.classList.add('table-element');
        barcode_div.innerHTML = item.barcode;
        td_barcode.appendChild(barcode_div);

        let td_model = document.createElement('td');
        let model_div = document.createElement('div');
        model_div.classList.add('table-element');
        model_div.innerHTML = item.model;
        td_model.appendChild(model_div);

        let td_imei = document.createElement('td');
        let imei_div = document.createElement('div');
        imei_div.classList.add('table-element');
        imei_div.innerHTML = item.imei_number;
        td_imei.appendChild(imei_div);

        let td_bamboo_price = document.createElement('td');
        let bamboo_price_div = document.createElement('div');
        bamboo_price_div.classList.add('table-element');
        bamboo_price_div.innerHTML = item.bamboo_price + " £";
        td_bamboo_price.appendChild(bamboo_price_div);

        let td_select = document.createElement('td');
        let select_div = document.createElement('div');
        select_div.classList.add('table-element');

        let checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'selected_devices';
        checkbox.classList.add('form-check-input');
        checkbox.classList.add('m-0');
        checkbox.id = item.id;
        checkbox.onchange = function(){checkSubmit()};
        select_div.appendChild(checkbox);

        td_select.appendChild(select_div);

        row.appendChild(td_barcode);
        row.appendChild(td_model);
        row.appendChild(td_imei);
        row.appendChild(td_bamboo_price);
        row.appendChild(td_select);

        container.appendChild(row);
    }
}

function checkSubmit(){
    let items = document.getElementsByName('selected_devices');
    let button = document.getElementById('create-button');
    var canSubmit = false;
    items.forEach(element => {
        if(element.checked){
            canSubmit = true;
        }
    });
    if(canSubmit){
        if(button.classList.contains('disabled')){
            button.classList.remove('disabled');
        }
    } else {
        if(!button.classList.contains('disabled')){
            button.classList.add('disabled');
        }
    }
}

function reset(){
    clearTable();
    document.getElementById('search_id').value = '';
}

function clearTable(){
    let table = document.getElementById("search-results-table");
    var rowCount = table.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
        table.deleteRow(i);
    }
}

function handle(){
    let modal = document.getElementById('batchModal');
    
    setTimeout(function(){ 
        if(modal.classList.contains('show')){
            // modal opened
            //document.getElementById('search_id').autofocus = true;
        } else {
            clearTable()
            document.getElementById('search_id').value = '';
        }
    }, 200);

}

function selectAll(){
    let rowCount = document.getElementById("search-results-table").rows.length;
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

    checkSubmit();
}

</script>


</html>
