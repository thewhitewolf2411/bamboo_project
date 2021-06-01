<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Salvage products</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Salvage products</p>
                    </div>
                </div>
                <div class="portal-table-container">

                    @if(Session::has('product_edited'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_edited')}}
                    </div>
                    @endif

                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Id</div></td>
                            <td><div class="table-element">Image</div></td>
                            <td><div class="table-element">Name</div></td>
                            <td><div class="table-element">Category</div></td>
                            <td><div class="table-element">Brand</div></td>
                            <td>
                                <a href="/portal/product/addsellingproduct">
                                <i title="Add a new product" class="fa fa-plus-circle"></i>
                                </a>
                            </td>
                        </tr>

                        @foreach($sellingProducts as $sellingProduct )
                        <tr>
                            <td><div class="table-element">{{$sellingProduct->id}}</td>
                            <td ><div class="table-element"><img src="{{asset('/storage/product_images').'/'.$sellingProduct->product_image}}" height="50px">{{$sellingProduct->product_image}}</div></td>
                            <td><div class="table-element">{{$sellingProduct->product_name}}</div></td>
                            <td><div class="table-element">{{$sellingProduct->getCategory($sellingProduct->category_id)}}</div></td>
                            <td><div class="table-element">{{$sellingProduct->getBrand($sellingProduct->brand_id)}}</div></td>
                            <td><div class="table-element">
                                <a href="/portal/product/editsellingproduct/{{$sellingProduct->id}}">
                                    <i title="Edit product" class="fa fa-pencil"></i>
                                </a>
                                <a onclick="return confirm('Are you sure? This will delete this product from customer view!')" href="/portal/product/removesellingproduct/{{$sellingProduct->id}}">
                                    <i title="Delete product" class="fa fa-times remove"></i>
                                </a>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </table>

                </div>
            </div>
        </div>

    </main>

</body>

</html>