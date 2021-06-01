<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="{{asset('js\scanner\scannerdetection.js')}}"></script>

    <title>Bamboo Recycle::Payments Awaiting Assignment</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">

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

            <div class="m-auto w-75">
                <div class="mt-4 mb-4 row">
                    <div class="btn btn-primary btn-blue w-25 mr-0 ml-auto" style="display:block;" onclick="showBatchCreate()">New Batch</div>
                    <div id="batchref" class="ml-0 mr-auto p-2 border">{!!$batch_ref!!}</div>
                </div>
            </div>

            <div class="container-fluid">
                <div id="scanning-payment-items" class="hidden">
                    <h5 class="text-center mb-3">Choose scanning option:</h5>
                    <div class="row justify-content-around mt-2" id="scan-options">
                        <div>
                            <div id="trolly-option" class="btn btn-light" onclick="toggleScanOption('trolley')">TROLLY</div>
                            <div id="tray-option" class="btn btn-light" onclick="toggleScanOption('tray')">TRAY</div>
                            <div id="tradein-option" class="btn btn-light" onclick="toggleScanOption('barcode')">TRADEIN-BARCODE</div>
                        </div>
                    </div>
                    <div class="row" id="search-box">
                        <div class="row ml-auto mr-auto">
                            <div class="d-flex align-items-center mx-5 text-center p-4">              
                                <input id="search_id" type="text" minlength="7" class="form-control mx-3 my-0" required>
                                <div id="searchbtn" class="btn btn-primary btn-blue disabled" onclick="search()">Scan</div>
                                <div id="create-button" class="btn btn-secondary disabled w-100 ml-2" onclick="createBatch()">Create batch</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="alert alert-danger w-75 text-center ml-auto mr-auto hidden mb-4" role="alert" id="scanerror"></div>

                <div class="scanning-items-table justify-content-around mb-4">

                    <div class="all-batch-available-devices" id="all-devices-div">

                        <table class="portal-table sortable" id="tradeins-table">
                            <tr>
                                <td><div class="table-element">Trade-in ID</div></td>
                                <td><div class="table-element">Trade-in barcode number</div></td>
                                <td><div class="table-element">Order date</div></td>
                                <td><div class="table-element">Product</div></td>
                                <td><div class="table-element">Price</div></td>
                                <td><div class="table-element">Stock location</div></td>
                            </tr>
                            @foreach($tradeins as $tradein)
                                <tr id="tradein-{{$tradein->id}}">
                                    <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                                    <td><div class="table-element">{{$tradein->barcode}}</div></td>
                                    <td><div class="table-element">{{$tradein->getOrderDate()}}</div></td>
                                    <td><div class="table-element">{{$tradein->getProductName($tradein->id)}}</div></td>
                                    <td><div class="table-element">£ {{$tradein->getDevicePrice()}}</div></td>
                                    <td><div class="table-element">{{$tradein->getTrayName($tradein->id)}}</div></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="scanned mr-auto hidden" id="scanned-awaiting-table">
                        <div id="batch-devices-box">
                            <div class="portal-table-container p-0 pl-1">
                                <div id="search-results">
                                    <table class="portal-table sortable" id="search-results-table">
                                        <tr id="hr">
                                            <td><div class="table-element">Trade-in barcode number</div></td>
                                            <td><div class="table-element">Product</div></td>
                                            <td><div class="table-element">Stock location</div></td>
                                            <td><div class="table-element"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
<script>

var scanoption = null;
var CAN_SCAN = null;


function showBatchCreate(){
    let scanitems = document.getElementById('scanning-payment-items');
    let alldevices = document.getElementById('all-devices-div');
    let scanneddevices = document.getElementById("scanned-awaiting-table");

    if(scanitems.classList.contains('hidden')){
        scanitems.classList.remove('hidden');
    }
    if(!alldevices.classList.contains('ml-auto')){
        alldevices.classList.add('ml-auto');
    }
    if(scanneddevices.classList.contains('hidden')){
        scanneddevices.classList.remove('hidden');
    }
}


function toggleScanOption(option){
    let element;
    let trolleyoption = document.getElementById('trolly-option');
    let trayoption = document.getElementById('tray-option');
    let tradeinoption = document.getElementById('tradein-option');
    let focusInput = document.getElementById('search_id');
    let disable_buttons = [];
    switch (option) {
        case 'trolley':
            element = trolleyoption;
            disable_buttons.push(trayoption);
            disable_buttons.push(tradeinoption);
            focusInput.focus();
            break;
        case 'tray':
            element = trayoption;
            disable_buttons.push(trolleyoption);
            disable_buttons.push(tradeinoption);
            focusInput.focus();

            break;
        case 'barcode':
            element = tradeinoption;
            disable_buttons.push(trayoption);
            disable_buttons.push(trolleyoption);

            focusInput.focus();
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
        $('#search_id').val (string);
        search();
        // console.log(string);
        // console.log(qty);
        //$('#userInput').val ($('#userInput').val()  + string);
    }
         
         
});


function search(){
    if(CAN_SCAN){
        //clearSearchTable();

        let searchterm = document.getElementById('search_id').value;

        $.ajax({
            type: "GET",
            url: "awaiting/batchsearch?term="+searchterm + "&option=" + scanoption,
            success: function(response) {
                if(response.error){
                    let erroralert = document.getElementById('scanerror');
                    erroralert.innerHTML = response.error;
                    if(erroralert.classList.contains('hidden')){
                        erroralert.classList.remove('hidden');
                    }
                    setTimeout(function(){
                        erroralert.classList.add('hidden');
                    },10000)
                } else {
                    loadResults(response);
                }

                document.getElementById('search_id').value = null;
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
    var container = document.getElementById("search-results-table").childNodes[1];
    var alldevices = document.getElementById("tradeins-table").childNodes[1].rows;
    var alldevicestable = document.getElementById("tradeins-table").childNodes[1];


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

                let td_remove = document.createElement('td');
                let remove_div = document.createElement('div');
                remove_div.classList.add('table-element');

                let remove_action = document.createElement('div');
                remove_action.innerHTML = "&#10005;";
                remove_action.onclick = function(){removeFromScanned(item.id)};

                let info = document.createElement("input");
                info.id = 'info-'+item.id;
                info.type = 'hidden';
                info.value = JSON.stringify(item);
                row.appendChild(info);

                remove_div.appendChild(remove_action);
                td_remove.appendChild(remove_div);

                row.appendChild(td_barcode);
                row.appendChild(td_product);
                row.appendChild(td_stock_location);
                row.appendChild(td_remove);

                container.appendChild(row);
            }
        }
    } else {
        // clear when no results
        for(let j = 0; j < container.rows.length; j++){
            if(container.rows[j].id !== 'hr'){
                container.rows[j].parentNode.removeChild(container.rows[j]);
            }
        }
    }

    

    let results_table = document.getElementById('batch-devices-box');
    if(results_table.classList.contains('hidden')){
        results_table.classList.remove('hidden');
    }

    checkSubmit();
}

function removeFromScanned(id){
    let element = document.getElementById(id);
    let iteminfoelem = document.getElementById('info-'+id);
    let iteminfo = JSON.parse(iteminfoelem.value);
    element.parentNode.removeChild(element);

    let table = document.getElementById('tradeins-table').childNodes[1];

    let row = document.createElement('tr');
    row.id = 'tradein-'+iteminfo.id;

    let td_id = document.createElement('td');
    let id_div = document.createElement('div');
    id_div.classList.add('table-element');
    id_div.innerHTML = iteminfo.barcode_original;
    td_id.appendChild(id_div);

    let td_barcode = document.createElement('td');
    let barcode_div = document.createElement('div');
    barcode_div.classList.add('table-element');
    barcode_div.innerHTML = iteminfo.barcode;
    td_barcode.appendChild(barcode_div);

    let td_orderdate = document.createElement('td');
    let orderdate_div = document.createElement('div');
    orderdate_div.classList.add('table-element');
    orderdate_div.innerHTML = iteminfo.order_date;
    td_orderdate.appendChild(orderdate_div);

    let td_product = document.createElement('td');
    let product_div = document.createElement('div');
    product_div.classList.add('table-element');
    product_div.innerHTML = iteminfo.product;
    td_product.appendChild(product_div);

    let td_price = document.createElement('td');
    let price_div = document.createElement('div');
    price_div.classList.add('table-element');
    price_div.innerHTML = iteminfo.device_price;
    td_price.appendChild(price_div);

    let td_location = document.createElement('td');
    let location_div = document.createElement('div');
    location_div.classList.add('table-element');
    location_div.innerHTML = iteminfo.stock_location;
    td_location.appendChild(location_div);

    row.appendChild(td_id);
    row.appendChild(td_barcode);
    row.appendChild(td_orderdate);
    row.appendChild(td_product);
    row.appendChild(td_price);
    row.appendChild(td_location);

    table.appendChild(row);
    checkSubmit();
}

function checkSubmit(){
    let search_results_length = document.getElementById('search-results-table').rows.length;
    let button = document.getElementById('create-button');
    if(search_results_length > 1){
        if(button.classList.contains('disabled')){
            if(!button.classList.contains('btn-blue')){
                button.classList.remove('btn-secondary');
                button.classList.add('btn-blue');
            }
            button.classList.remove('disabled');
        }
    } else {
        if(!button.classList.contains('disabled')){
            if(button.classList.contains('btn-blue')){
                button.classList.remove('btn-blue');
                button.classList.add('btn-secondary');
            }
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
