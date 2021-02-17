<style>
    @page {
    margin:5%;
    
    }
    div{
    font-size: 9pt;
}
    
    </style>
    <div style=' margin:0 auto;'>
    
        <div>
            <span><strong>Trade-In Barcode: </strong>{{$barcode_number}}</span>
        </div>
        <div>
            <span><strong>Manifacturer: </strong>{{$manifacturer}}</span>
        </div>
        <div>
            <span><strong>Model: </strong>{{$model}}</span>
        </div>
        <div>
            <span><strong>IMEI: </strong>{{$imei}}</span>
        </div>
        <div>
            <span><strong>Location: </strong>{{$location}}</span>
        </div>
        <div>
            <span><strong>Quarantine Reason: </strong>{{$quarantineReason}}</span>
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: center;flex-direction: unset;width: 100%;align-items: center;">
            <div style="flex: 1;display: inline-block;text-align: right;">{!!$barcode!!}</div>
        </div>
   
    
    </div>