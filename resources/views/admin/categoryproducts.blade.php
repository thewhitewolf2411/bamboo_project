<div>

<a href="{{ url('/admin/addcategory') }}">Add Category</a>

</div>

@foreach($products as $product)

    <img src="{{asset('product_images/'.$product->product_image)}}" widht="50px" height="50px" />
    <p><a href="#">{{$product->product_name}}</a></p>
    <p>{{$product->price_new}}</p>
    <a href="#">Action</a>

@endforeach

<div>

<a href="{{ url('/admin/products/addproduct/'.$categoryid) }}">Add new product</a>

</div>