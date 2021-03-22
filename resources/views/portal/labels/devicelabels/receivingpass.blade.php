<style>
    @page {
    margin:1cm;
    text-align:center;
    }

div{
    font-size: 9pt;
}

</style>
    <div style='margin:0 auto;'>

        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradein_barcode,'C128') }}" height="25" width="180" />
        <div>
            <span><strong>Trade-In Barcode: </strong>{{$tradein_barcode}}</span>
        </div>
        <div>
            <span><strong>Make/Model: </strong>{{$model}}</span>
        </div>
        @if(isset($imei) && $imei !== null)
        <div>
            <span><strong>IMEI: </strong>{{$imei}}</span>
        </div>
        @endif
        @if(isset($serial) && $serial !== null)
        <div>
            <span><strong>SN: </strong>{{$serial}}</span>
        </div>
        @endif
        <div>
            <span><strong>Location: </strong>{{$location}}</span>
        </div>


   
    </div>

