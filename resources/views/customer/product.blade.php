<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>


        <header>@include('customer.layouts.header')</header>

            <div>
                <form action="/addtocart/{{$product->id}}" method="post">
                    @csrf
                    
                    @if($product->category_id == 1)
                    <select name="network">
                        <option value="T-Mobile">T-Mobile</option>
                        <option value="O2">O2</option>
                    </select>
                    @endif

                    <div>
                        <input type="radio" name="state" value="new" id="radio_new" checked onclick="changeTotalPrice({{ $product->price_new }}, {{ $product->price_working_b }}, {{ $product->price_faulty }} )" >
                        <label for="new">New</label>
                        <input type="radio" name="state" value="working" id="radio_working" onclick="changeTotalPrice({{ $product->price_new }}, {{ $product->price_working_b }}, {{ $product->price_faulty }} )">
                        <label for="working">Working</label>
                        <input type="radio" name="state" value="faulty" id="radio_faulty" onclick="changeTotalPrice({{ $product->price_new }}, {{ $product->price_working_b }}, {{ $product->price_faulty }} )">
                        <label for="faulty">Faulty</label>
                    </div>

                    <select name="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>

                    <input type="hidden" id="price" name="price" value="{{$product->price_new}}"></input>

                    <h3 id="total_price">Total price: £{{$product->price_new}} </h3>
                
                    <button type="submit">Add to cart</button>
                </form>

            
            </div>

        <footer>@include('customer.layouts.footer')</footer>

    <script>
        function changeTotalPrice(price_new, price_working, price_faulty){
            if(document.getElementById('radio_new').checked){
                document.getElementById('total_price').innerHTML = 'Total price: £' + price_new;
                document.getElementById('price').value = price_new;
            }
            if(document.getElementById('radio_working').checked){
                document.getElementById('total_price').innerHTML = 'Total price: £' + price_working;
                document.getElementById('price').value = price_working;
            }
            if(document.getElementById('radio_faulty').checked){
                document.getElementById('total_price').innerHTML = 'Total price: £' + price_faulty;
                document.getElementById('price').value = price_faulty;
            }
        }

    
    </script>
        
    </body>
</html>