@if(count(Session::get('cart')->items)>0)
<div class="hovercart" id="hovercart">

    @foreach(Session::get('cart')->items as $key=>$cartitem)
    <div class="d-flex">
        <p class="mx-2">{{$key}}</p>
        <p class="mx-2">{{$cartitem['product']->product_name}}</p>
        <p class="mx-2">£{{$cartitem['price']}}</p>
    </div>
    @endforeach

</div>

<script>

setTimeout(function(){ 

$('#hovercart').addClass('hovercart-hide')

 }, 3000);


</script>

@else

<div class="hovercart" id="hovercart">

    <div class="d-flex">
        <p class="mx-2">Your basket is empty</p>
    </div>

</div>

<script>

setTimeout(function(){ 

$('#hovercart').addClass('hovercart-hide')

 }, 3000);


</script>

@endif