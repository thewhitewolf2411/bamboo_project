
<div>

@foreach(session('categories') as $category)

<a href="/products/{{$category->category_name}}">{{$category->category_name}}</a>

@endforeach

</div>
