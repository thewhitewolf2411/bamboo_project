<style type="text/css" media="all">

    @page{
        margin: 10mm;
        font-size: 7pt;
        width: 100%;
        text-align: center;
        page-break-inside: avoid;
        page-break-before: always;
    }

    table {
        border-collapse: collapse;
        height: auto;
    }

    tr{
        width: 284px;
    }

    td{
        width: 121px !important;
        padding: 0 !important;
        min-width: 121px;
    }

</style>

<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($barcodenumber,'C128') }}" height="25" width="180" />
<table>
    <tr>
        <td>Trade-IN Barcode:</td>
        <td>{{$barcodenumber}}</td>
    </tr>
    <tr>
        <td>Make/Model:</td>
        <td>{{$makeModel}}</td>
    </tr>
    @if(isset($imei) && $imei !== null)
    <tr>
        <td>IMEI:</td>
        <td>{{$imei}}</td>
    </tr>
    @endif
    @if(isset($serial) && $serial !== null)
    <tr>
        <td>SN:</td>
        <td>{{$serial}}</td>
    </tr>
    @endif
    <tr>
        <td>Location:</td>
        <td>{{$location}}</td>
    </tr>
    <tr>
        <td>Bamboo Grade:</td>
        <td>{{$bambooGrade}}</td>
    </tr>
    <tr>
        <td>Network:</td>
        <td>{{$network}}</td>
    </tr>
</table>
