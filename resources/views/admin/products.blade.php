Products

@foreach($allCategories as $category)
<div>
    <img src="{{asset('category_images/'.$category->category_image)}}" widht="50px" height="50px" />
    <a href="/admin/category/{{$category->id}}"> <p>{{$category->category_name}}</p> </a>
    <a href="">Action</a>
</div>
@endforeach

<div>

<a href="{{ url('/admin/addcategory') }}">Add Category</a>

</div>