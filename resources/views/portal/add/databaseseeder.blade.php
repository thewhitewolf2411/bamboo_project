<form action="/portal/seeddata" method="post">

    @csrf

    @foreach($sellingProducts as $sellingProduct)
        <div style="display:flex;">
            <input type="text" disabled value="{{$sellingProduct->product_name}}"><br>
            <input type="text" disabled name="sellingProduct-{{$sellingProduct->id}}" value="{{$sellingProduct->id}}"><br>
            <input type="number" name="sellingProductNumber-{{$sellingProduct->id}}">
        </div>
    @endforeach

    <input type="submit" value="Add orders">
</form>