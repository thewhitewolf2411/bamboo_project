<p>{{$product->product_name}}</p>
<p>{{$product->product_grade_1}}</p>
<p>{{$product->product_selling_price_1}}</p>
<p>{{$product->product_grade_2}}</p>
<p>{{$product->product_selling_price_2}}</p>
<p>{{$product->product_grade_3}}</p>
<p>{{$product->product_selling_price_3}}</p>

<form action="/sell/shop/item/addtocart" method="POST">

    @csrf

    <label for="network">Select network:</label>

    <select id="network" name="network" onchange="networkChanged(this)">
        <option value="network_1" selected>Network 1</option>
        <option value="network_2">Network 2</option>
        <option value="network_3">Network 3</option>
        <option value="network_4">Network 4</option>
    </select>

    <label for="grade">Select network:</label>

    <select id="grade" name="grade" onchange="gradeChanged(this)">
        <option value="{{$product->customer_grade_price_1 }}, " selected>Excellent working</option>
        <option value="{{$product->customer_grade_price_2 }}">Good working</option>
        <option value="{{$product->customer_grade_price_3 }}">Poor working</option>
        <option value="{{$product->customer_grade_price_4 }}">Damaged working</option>
        <option value="{{$product->customer_grade_price_5 }}">Faulty</option>
    </select> 

    <label for="price">Your price:</label>
    <input type="text" name="price" id="price" value="{{$product->customer_grade_price_1}}" disabled></input>
    <input type="hidden" name="phoneid" value="{{$product->id}}"></input>
    <input type="hidden" name="type" value="tradein"></input>

    <button type="submit">Add to cart</button>

</form>



<script>

    var price = document.getElementById('price');

    var network = document.getElementById('network');
    var grade = document.getElementById('grade');

    function networkChanged(selectObject){
        var value = selectObject.value;
    }
    
    function gradeChanged(selectObject){
        var value = selectObject.value;
        document.getElementById('price').value = value;
    }



</script>