<style>
    @page {
    margin:5%;
    
    }
    body > div:nth-child(1) > div:nth-child(2) {
                margin: auto;
    }
    
    </style>
    <div style='text-align:center; margin:0 auto;'>
    
        <div>
            <span><strong>Trade-In Barcode</strong>{{$barcode_number}}</span>
        </div>
        <div>
            <span><strong>Manifacturer</strong>{{$manifacturer}}</span>
        </div>
        <div>
            <span><strong>Model</strong>{{$model}}</span>
        </div>
        <div>
            <span><strong>IMEI</strong>{{$imei}}</span>
        </div>
        <div>
            <span><strong>Location</strong>{{$location}}</span>
        </div>
        <div>
            <span><strong>Bamboo Grade</strong>{{$bambooGrade}}</span>
        </div>
        <div>
            <span><strong>Network</strong>{{$network}}</span>
        </div>
        <div>
            <span>{!!$barcode!!}</span>
        </div>
    
    </div>