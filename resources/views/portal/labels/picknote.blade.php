<style>

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th{
        border: 1px solid #000;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

</style>

@if(count($boxes) > 0)

<h5 class="modal-title">Full Boxes</h5>
<table class="portal-table my-3" id="sales-lot-boxes">
    <tr>
        <th><div class="table-element">Box Name</div></th>
        <th><div class="table-element">Box Location</div></th>
        <th><div class="table-element">Qty</div></th>
    </tr>
    @foreach ($boxes as $box)
    <tr>
        <th><div class="table-element">{{$box->tray_name}}</div></th>
        <th><div class="table-element">{{$box->trolley_id}}</div></th>
        <th><div class="table-element">{{$box->number_of_devices}}</div></th>
    </tr>
    @endforeach
</table>

@endif

@if(count($devices) > 0)

<h5 class="modal-title">Individual Devices</h5>
<table class="portal-table my-3" id="sales-lot-devices">
    <tr>
        <th><div class="table-element">Trade in id</div></th>
        <th><div class="table-element">Model</div></th>
        <th><div class="table-element">IMEI</div></th>
        <th><div class="table-element">Bay Location</div></th>
        <th><div class="table-element">Box Name</div></th>
    </tr>
    @foreach ($devices as $device)
    <tr>
        <th><div class="table-element">{{$device->barcode}}</div></th>
        <th><div class="table-element">{{$device->product_name}}</div></th>
        <th><div class="table-element">{{$device->imei_number}}</div></th>
        <th><div class="table-element">{{$device->box_location}}</div></th>
        <th><div class="table-element">{{$device->bay_location}}</div></th>
    </tr>
    @endforeach
</table>

@endif