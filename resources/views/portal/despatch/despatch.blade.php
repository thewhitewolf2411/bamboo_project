@extends('portal.layouts.portal')

@section('content')

<div class="portal-app-container">

    <div class="portal-title-container">
        <div class="portal-title">
            <div class="row justify-content-around">
                <p class="pt-2 text-center">Despatch devices</p>

                {{--<form class="d-flex align-items-center mx-5 text-center" action="/portal/despatch/despatchdevices" method="GET">              
                    <label for="searchtradeins">Search by Trade-in barcode:</label>
                    <input type="text" minlength="7" name="search" class="form-control mx-3 my-0" @if(isset(request()->search)) value="{{request()->search}}" @endif required>
                    <button type="submit" class="btn btn-primary btn-blue">Search</button>
                    @if(isset(request()->search)) <a class="btn" href="/portal/despatch/despatchdevices">Cancel</a> @endif
                </form>--}}
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
            <form class="hidden" method="POST" id="requestDespatchForm" action="{{route('requestDespatch')}}">
                @csrf
                <input type="hidden" name="despatch_ids" id="despatchdeviceids" value="">
            </form>
            <form class="hidden" method="POST" id="confirmDespatchForm" action="{{route('confirmDespatch')}}">
                @csrf
                <input type="hidden" name="despatch_ids" id="confirmdespatchdeviceids" value="">
            </form>
            <div id="request_btn" class="btn btn-success disabled" onclick="requestDespatch()">Request Despatch</div>
            <div id="export_btn" class="btn btn-info disabled ml-2 mr-2" onclick="exportDespatchedDevices()">Export</div>
            <div id="confirm_btn" class="btn btn-success disabled mr-4" onclick="confirmDespatch()">Confirm Despatch</div>
        </div>

        @if(Session::has('messages'))
            @if(isset(Session::get('messages')['error']))
                <div class="alert alert-danger text-center" role="alert">
                    @foreach(Session::get('messages')['error'] as $message)
                        {!!$message!!}<br>
                    @endforeach
                </div>
            @endif
            @if(isset(Session::get('messages')['success']))
                <div class="alert alert-success text-center" role="alert">
                    @foreach(Session::get('messages')['success'] as $message)
                        {!!$message!!}<br>
                    @endforeach
                </div>
            @endif
            @if(isset(Session::get('messages')['info']))
                <div class="alert alert-info text-center" role="alert">
                    @foreach(Session::get('messages')['info'] as $message)
                        {!!$message!!}<br>
                    @endforeach
                </div>
            @endif
        @endif

        <table class="portal-table" id="despatch-devices-table">
            <thead>
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
                    <td class="text-center p-3 sorttable_nosort"><div class="table-element"><input type="checkbox" id="selectAllDespatch" class="form-check-input m-0 w-auto" onclick="selectAllDespatch()"></div></td>
                </tr>
            </thead>
            <tfoot>
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
                    <td class="text-center p-3 sorttable_nosort"><div class="table-element"><input type="checkbox" id="selectAllDespatch" class="form-check-input m-0 w-auto" onclick="selectAllDespatch()"></div></td>
                </tr>
            </tfoot>
            <tbody>
                @foreach($tradeins as $tradein)
                    <tr id="tradein-{{$tradein->id}}" @if($tradein->isManifested()) class="can_confirm" @endif>
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
            </tbody>


        </table>
    </div>

</div>

<script>

    var CAN_EXPORT = false;
    var CAN_OPERATE_DESPATCH = false;

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
        let request_btn = document.getElementById('request_btn');
        let confirm_btn = document.getElementById('confirm_btn');

        let total = 0;
        for (let index = 0; index < selected.length; index++) {
            if(selected[index].checked){
                total++;
            }
        }

        if(total > 0){
            CAN_EXPORT = true;
            CAN_OPERATE_DESPATCH = true;
            if(exportbtn.classList.contains('disabled')){
                exportbtn.classList.remove('disabled');
            }
            if(request_btn.classList.contains('disabled')){
                request_btn.classList.remove('disabled');
            }
            if(confirm_btn.classList.contains('disabled')){
                confirm_btn.classList.remove('disabled');
            }
        } else {
            CAN_DESPATCH = false;
            CAN_OPERATE_DESPATCH = false;
            if(!exportbtn.classList.contains('disabled')){
                exportbtn.classList.add('disabled');
            }
            if(!request_btn.classList.contains('disabled')){
                request_btn.classList.add('disabled');
            }
            if(!confirm_btn.classList.contains('disabled')){
                confirm_btn.classList.add('disabled');
            }
        }
    }


    function requestDespatch(){
        if(CAN_OPERATE_DESPATCH){
            let selected =  document.getElementsByName('selected_despatch_devices');
            let ids = [];
            for (let index = 0; index < selected.length; index++) {
                if(selected[index].checked){
                    ids.push(selected[index].value);
                }  
            }
            if(ids.length > 0){
                document.getElementById('despatchdeviceids').value = ids;
                document.getElementById('requestDespatchForm').submit();
            }
        }
    }

    function confirmDespatch(){
        if(CAN_OPERATE_DESPATCH){
            let selected =  document.getElementsByName('selected_despatch_devices');
            let ids = [];
            for (let index = 0; index < selected.length; index++) {
                if(selected[index].checked){
                    ids.push(selected[index].value);
                }
            }
            document.getElementById('confirmdespatchdeviceids').value = ids;
            document.getElementById('confirmDespatchForm').submit();
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