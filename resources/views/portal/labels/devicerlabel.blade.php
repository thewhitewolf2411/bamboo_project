@if($tradein->marked_for_quarantine)


@else
<style>
    body > div:nth-child(1) > div:nth-child(2) {
        margin: auto;
        }</style>
<div style='text-align:center; margin:0 auto;'>

    <p>Trade-In Barcode: {!! $tradein_barcode !!}</p>
    <p>Manifacturer: {{$manifacturer}}</p>
    <p>Model: {{$model}}</p>
    <p>IMEI: {{$imei}}</p>
    <p>Location: {{$location}}</p>

</div>
@endif