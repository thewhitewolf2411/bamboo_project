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
font-size: 8pt;

}


</style>

<div>

    <div style="padding:5%;">

        <div>
            <p>{!!$barcode!!}</p>
        </div>

        <div style="position: relative; width: 80%;">

            <p> Barcode number: {!! $tradein_barcode !!}<br>
            Manifacturer: {{$manifacturer}} <br>
            Model: {{$model}}<br>
            IMEI: {{$imei}}<br>
            Grade: {{$grade}}<br>
            Location: {{$location}}</p>

        </div>

    </div>

</div>