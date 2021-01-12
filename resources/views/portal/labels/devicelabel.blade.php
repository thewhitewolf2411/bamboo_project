<style>
@page {
margin:5%;

}
body > div:nth-child(1) > div:nth-child(2) {
            margin: auto;
}

</style>
<div style='text-align:center; margin:0 auto;'><p style='margin:auto;'>{!!$barcode!!}<br>{!! $tradein_barcode !!}<br>Manifacturer: {{$manifacturer}}<br>Model: {{$model}}<br>IMEI: {{$imei}}<br>Location: {{$location}}</p></div>