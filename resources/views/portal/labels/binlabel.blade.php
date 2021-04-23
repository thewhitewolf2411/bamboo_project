<style type="text/css" media="all">

    @page{
        margin: 10mm;
        font-size: 10pt;
        width: 100%;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr{
        width: 100%;
    }

    td{
        width: 100% !important;
        padding: 0 !important;
        min-width: 141px;
        position: relative;
        height: 20px;
    }

    p{
        margin: 0 auto;
        text-align: center;
    }



</style>

<div style="margin: 0 auto">
    
    <table style="margin-bottom: 10px;">
        <tr>
            <td><p>{{$binreason}}</p></td>
        </tr>
    </table>
    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($barcode,'C128') }}" height="25" width="180" />
    <table>

        <tr>
            <td><p>{{$barcode}}</p></td>
        </tr>
        @if($detailedreason !== null)
        <tr>
            <td><p>{{$detailedreason}}</p></td>
        </tr>
        @endif
    </table>
    
</div>