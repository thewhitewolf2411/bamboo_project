<!--<style>
@page {
margin:5%;

}
body > div:nth-child(1) > div:nth-child(2) {
            margin: auto;
}

</style>
<div style='text-align:center; margin:0 auto;'><p style='margin:auto;'>{!!$barcode!!}<br> {!! $tradein_barcode !!}<br>Manifacturer: {{$manifacturer}}<br>Model: {{$model}}<br>IMEI: {{$imei}}<br>Location: {{$location}}</p></div>

-->

<style>
@page {
margin:5%;

}


</style>

<div>

    <div style="display:inline-block; padding:5%;">

        <div style="width: 20%;">
            <div style="scale(0.8); -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg); -o-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg);">
            {!!$barcode!!}
            </div>
        </div>

        <div style="width: 80%; float:right;">

        <p style='margin:auto;'> Barcode number: {!! $tradein_barcode !!}<br>
        Manifacturer: {{$manifacturer}} Model: {{$model}}<br>
        IMEI: {{$imei}}<br>Location: {{$location}}</p>

        </div>

    </div>

</div>