@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="portal-title-container">
        <div class="portal-title">
            <div class="row justify-content-around">
                <p class="pt-2 text-center">Despatch devices</p>

                <form class="d-flex align-items-center mx-5 text-center" action="/portal/despatch/despatchdevices" method="GET">              
                    <label for="searchtradeins">Search by Trade-in barcode:</label>
                    <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                    @if(isset(request()->search)) <a class="btn" href="/portal/despatch/despatchdevices">Cancel</a> @endif
                </form>
            </div>
        </div>
    </div>

    <div class="portal-table-container">
        {{-- <h5 class="text-center">Devices</h5> --}}

        <div class="row justify-content-center mb-4 ml-auto mr-auto w-50">
            <form target="_blank" class="hidden" method="POST" id="exportDespatchForm" action="{{route('exportDespatch')}}">
                @csrf
                <input type="hidden" name="ids" id="exportdeviceids" value="">
            </form>
            <form target="_blank" class="hidden" method="POST" id="despatchForm" action="{{route('sendToDespatch')}}">
                @csrf
                <input type="hidden" name="despatch_ids" id="despatchdeviceids" value="">
            </form>
            <div id="export_btn" class="btn btn-success disabled mr-4" onclick="despatchDevices()">Despatch</div>
            <div id="despatch_btn" class="btn btn-info disabled ml-4" onclick="exportDespatchedDevices()">Export</div>
        </div>

        <table class="portal-table sortable" id="despatch-devices-table">
            <tr>
                <td><div class="table-element">Trade-in ID</div></td>
                <td class="text-center"><div class="table-element">Trade-in barcode number</div></td>
                <td class="text-center"><div class="table-element">Model</div></td>
                <td class="text-center"><div class="table-element">Customer Name</div></td>
                <td class="text-center"><div class="table-element">Postcode</div></td>
                <td class="text-center"><div class="table-element">Address Line 1</div></td>
                <td class="text-center"><div class="table-element">Bamboo Status</div></td>
                <td class="text-center"><div class="table-element">Carrier</div></td>
                <td class="text-center"><div class="table-element">Tracking Reference</div></td>
                <td class="text-center p-3"><div class="table-element"><input type="checkbox" id="selectAllDespatch" class="form-check-input m-0 w-auto" onclick="selectAllDespatch()"></div></td>
            </tr>
            @foreach($tradeins as $tradein)
                <tr id="tradein-{{$tradein->id}}">
                    <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                    <td><div class="table-element">{{$tradein->barcode}}</div></td>
                    <td><div class="table-element">{{$tradein->getProductName($tradein->id)}}</div></td>
                    <td><div class="table-element">{{$tradein->customerName()}}</div></td>
                    <td><div class="table-element">{{$tradein->postCode()}}</div></td>
                    <td><div class="table-element">{{$tradein->addressLine()}}</div></td>
                    <td class="text-center"><div class="table-element">{{$tradein->getBambooStatus()}}</div></td>
                    <td class="text-center"><div class="table-element">Royal Mail</div></td>
                    <td><div class="table-element">{{$tradein->tracking_reference}}</div></td>
                    <td><div class="table-element"><input type="checkbox" name="selected_despatch_devices" class="form-check-input m-0 w-auto" value="{!!$tradein->id!!}"></div></td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

<script>

    var CAN_EXPORT = false;
    var CAN_DESPATCH = false;

    var userSelection = document.getElementsByName('selected_despatch_devices');
    for(var i = 0; i < userSelection.length; i++) {
        (function(index) {
            userSelection[index].addEventListener("change", function() {
                checkDespatchDevices();

            })
        })(i);
    }


    function selectAllDespatch(){
        let rowCount = document.getElementById("despatch-devices-table").rows.length;
        let selectState = document.getElementById("selectAllDespatch").checked;
        if(rowCount > 1){
            let items = document.getElementsByName('selected_despatch_devices');

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

        checkDespatchDevices();
    }

    function checkDespatchDevices(){
        let selected =  document.getElementsByName('selected_despatch_devices');
        let exportbtn = document.getElementById('export_btn');
        let despatchbtn = document.getElementById('despatch_btn');

        let total = 0;
        for (let index = 0; index < selected.length; index++) {
            if(selected[index].checked){
                total++;
            }
        }

        if(total > 0){
            CAN_EXPORT = true;
            CAN_DESPATCH = true;
            if(exportbtn.classList.contains('disabled')){
                exportbtn.classList.remove('disabled');
            }
            if(despatchbtn.classList.contains('disabled')){
                despatchbtn.classList.remove('disabled');
            }
        } else {
            CAN_DESPATCH = false;
            CAN_EXPORT = false;
            if(!exportbtn.classList.contains('disabled')){
                exportbtn.classList.add('disabled');
            }
            if(!despatchbtn.classList.contains('disabled')){
                despatchbtn.classList.add('disabled');
            }
        }
    }


    function despatchDevices(){
        if(CAN_DESPATCH){
            let selected =  document.getElementsByName('selected_despatch_devices');
            let ids = [];
            for (let index = 0; index < selected.length; index++) {
                if(selected[index].checked){
                    ids.push(selected[index].value);
                }  
            }
            if(ids.length > 0){

                $.ajax({
                    type: "POST",
                    url: "{{route('sendToDespatch')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        despatch_ids: ids
                    },
                    success: function(data, textStatus, xhr) {
                        if(xhr.status === 200){
                            confirm(data.success + data.error);
                            window.location.reload(true);
                        }
                    }
                });
            }
        }
    }

    function exportDespatchedDevices(){
        if(CAN_EXPORT){
            let selected =  document.getElementsByName('selected_despatch_devices');
            let ids = [];
            for (let index = 0; index < selected.length; index++) {
                if(selected[index].checked){
                    ids.push(selected[index].value);
                }
                
            }
            if(ids.length > 0){
                let form = document.getElementById('exportDespatchForm');
                let values = document.getElementById('exportdeviceids');
                values.value = ids;
                form.submit(); 
            }
        }
    }

</script>

@endsection