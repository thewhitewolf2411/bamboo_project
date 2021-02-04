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

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <div class="row justify-content-around">
                            <p class="pt-2 text-center">Awaiting Payments</p>

                            <form class="d-flex align-items-center mx-5 text-center" action="/portal/payments/awaiting" method="GET">              
                                <label for="searchtradeins">Search by Trade-in barcode / Trade-in ID:</label>
                                <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                                <button type="submit" class="btn btn-primary btn-blue">Search</button>
                                @if(isset(request()->search)) <a class="btn" href="/portal/payments/awaiting">Cancel</a> @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="portal-table-container">
                    <h5 class="text-center">Devices</h5>
                    <table class="portal-table sortable" id="tradeins-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Order date</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Price</div></td>
                            <td><div class="table-element">Stock location</div></td>
                            {{-- <td><div class="table-element">
                                <input id="selectAll" type="checkbox" class="form-check-input m-0" onclick="selectAll()"/>
                            </div></td> --}}
                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr id="tradein-{{$tradein->id}}">
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                            <td><div class="table-element">{{$tradein->getOrderDate()}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->id)}}</div></td>
                            <td><div class="table-element">{{$tradein->bamboo_price}} £</div></td>
                            <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                {{-- <div class="portal-table-container">
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
                </div> --}}

                <div class="m-auto w-75">
                    <div class="mt-4 mb-4 row">
                        <div class="btn btn-primary btn-blue w-25 mr-0 ml-auto" onclick="showSearch()" style="display:block;">New Batch</div>
                        <div id="batchref" class="ml-0 mr-auto p-2 border">{!!$batch_ref!!}</div>
                    </div>
                    <div class="row justify-content-center mt-2 hidden" id="scan-options">
                        <div>
                            <div id="trolly-option" class="btn btn-light" onclick="toggleScanOption('trolley')">TROLLY</div>
                            <div id="tray-option" class="btn btn-light" onclick="toggleScanOption('tray')">TRAY</div>
                            <div id="tradein-option" class="btn btn-light" onclick="toggleScanOption('barcode')">TRADEIN-BARCODE</div>
                        </div>
                    </div>
                    <div class="row hidden" id="search-box">
                        <div class="row ml-auto mr-auto">
                            <div class="d-flex align-items-center mx-5 text-center p-4">              
                                <input id="search_id" type="text" minlength="7" class="form-control mx-3 my-0" required>
                                <div id="searchbtn" class="btn btn-primary btn-blue disabled" onclick="search()">Scan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="batch-devices-box" class="mt-2 hidden">

                    <div class="portal-table-container pt-1">
                        <div id="search-results">
                            <table class="portal-table sortable" id="search-results-table">
                                <tr id="hr">
                                    <td><div class="table-element">Trade-in barcode number</div></td>
                                    <td><div class="table-element">Product</div></td>
                                    <td><div class="table-element">Stock location</div></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="/portal/payments/awaiting" class="btn btn-secondary">Cancel</a>
                        <button id="create-button" onclick="createBatch()" type="button" class="btn btn-primary disabled">Create batch</button>
                    </div>

                </div>
                
                <!-- Batch Modal -->
                {{-- <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="batchModalLabel">Create Batch</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color: black;">&times;</span>
                            </button>
                        </div>
                        
                        
                    </div>
                    </div>
                </div> --}}

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

var scanoption = null;
var CAN_SCAN = null;


function showSearch(){
    let options = document.getElementById('scan-options');
    let box = document.getElementById('search-box');
    if(options.classList.contains('hidden')) options.classList.remove('hidden');
    if(box.classList.contains('hidden')) box.classList.remove('hidden');
    clearSearchTable();
}

function toggleScanOption(option){
    let element;
    let trolleyoption = document.getElementById('trolly-option');
    let trayoption = document.getElementById('tray-option');
    let tradeinoption = document.getElementById('tradein-option');
    let disable_buttons = [];
    switch (option) {
        case 'trolley':
            element = trolleyoption;
            disable_buttons.push(trayoption);
            disable_buttons.push(tradeinoption);
            break;
        case 'tray':
            element = trayoption;
            disable_buttons.push(trolleyoption);
            disable_buttons.push(tradeinoption);
            break;
        case 'barcode':
            element = tradeinoption;
            disable_buttons.push(trayoption);
            disable_buttons.push(trolleyoption);
            break;
        default:

            return;
    }

    disable_buttons.forEach(button => {
        if(button.classList.contains('btn-blue')){
            button.classList.add('btn-light');
            button.classList.remove('btn-blue');
        }
    });

    if(element.classList.contains('btn-light')){
        element.classList.remove('btn-light');
        element.classList.add('btn-blue');
    }

    if(trolleyoption.classList.contains('btn-blue') || trayoption.classList.contains('btn-blue') || tradeinoption.classList.contains('btn-blue')){
        CAN_SCAN = true;
    } else {
        CAN_SCAN = false;
    }


    scanoption = option;

    let searchbutton = document.getElementById('searchbtn');
    if(!CAN_SCAN){
        searchbutton.classList.add('disabled');
    } else {
        if(searchbutton.classList.contains('disabled')){
            searchbutton.classList.remove('disabled');
        }
    }
}

function search(){
    if(CAN_SCAN){
        //clearSearchTable();

        let searchterm = document.getElementById('search_id').value;

        $.ajax({
            type: "GET",
            url: "awaiting/batchsearch?term="+searchterm + "&option=" + scanoption,
            success: function(response) {
                loadResults(response);
            }
        });
    } else {
        alert('Please choose one scanning option.');
    }
}

function createBatch(){
    let button = document.getElementById('create-button');
    if(!button.classList.contains('disabled')){
        let devices = document.getElementById("search-results-table").childNodes[1].rows;
        let ids = [];

        for (let index = 0; index < devices.length; index++) {
            let row = devices[index];        
            if(row.id !== "hr"){
                ids.push(row.id);
            } 
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
    var alldevices = document.getElementById("tradeins-table").childNodes[1].rows;


    if(results.length > 0){
        for (const [key, item] of Object.entries(results)) {

            // check for moving (removing duplicates) from other table
            for (let index = 0; index < alldevices.length; index++) {
                let device = alldevices[index];
                if(device.id === 'tradein-'+item.id){
                    alldevices[index].parentNode.removeChild(alldevices[index]);
                }
            }

            // avoid re-adding same devices again
            let alreadyScanned = false;
            for(let i = 0; i < container.rows.length; i++){
                let scanned = container.rows[i];
                if(parseInt(scanned.id) === parseInt(item.id)){
                    alreadyScanned = true;
                }
            }

            if(!alreadyScanned){
                let row = document.createElement('tr');
                row.id = item.id;

                let td_barcode = document.createElement('td');
                let barcode_div = document.createElement('div');
                barcode_div.classList.add('table-element');
                barcode_div.innerHTML = item.barcode;
                td_barcode.appendChild(barcode_div);

                let td_product = document.createElement('td');
                let product_div = document.createElement('div');
                product_div.classList.add('table-element');
                product_div.innerHTML = item.product;
                td_product.appendChild(product_div);

                let td_stock_location = document.createElement('td');
                let stock_location_div = document.createElement('div');
                stock_location_div.classList.add('table-element');
                stock_location_div.innerHTML = item.stock_location;
                td_stock_location.appendChild(stock_location_div);

                row.appendChild(td_barcode);
                row.appendChild(td_product);
                row.appendChild(td_stock_location);

                container.appendChild(row);
            }
        }
    }

    

    let results_table = document.getElementById('batch-devices-box');
    if(results_table.classList.contains('hidden')){
        results_table.classList.remove('hidden');
    }

    checkSubmit();
}

function checkSubmit(){
    let search_results_length = document.getElementById('search-results-table').rows.length;
    let button = document.getElementById('create-button');
    if(search_results_length > 2){
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

function clearSearchTable(){
    let table = document.getElementById("search-results-table");
    var rowCount = table.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
        table.deleteRow(i);
    }
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
