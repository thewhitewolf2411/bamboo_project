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

</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Categories</p>
                    </div>
                </div>
                <div class="portal-table-container">

                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td>Id</td>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Total Products in Tree</td>
                            <td>Tree</td>
                            <td>
                                <a href="/portal/categories/add">
                                <i class="fa fa-plus-circle"></i>
                                </a>
                            </td>
                        </tr>

                        @foreach($categories as $category )

                        <tr>
                            <td><div class="table-element">{{$category->id}}</td>
                            <td ><div class="table-element"><img src="{{asset('/storage/category_images').'/'.$category->category_image}}" height="50px"></div></td>
                            <td><div class="table-element">{{$category->category_name}}</div></td>
                            <td><div class="table-element">{{$category->total_produts}}</div></td>
                            <td><div class="table-element">{{$category->category_name}}</div></td>
                            <td><div class="table-element">
                                <a href="/portal/categories/edit/{{$category->id}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="/portal/categories/delete/{{$category->id}}">
                                    <i class="fa fa-times remove"></i>
                                </a>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </table>

                </div>
            </div>
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Brands</p>
                    </div>
                </div>
                <div class="portal-table-container">

                    <table class="portal-table" id="brands-table">
                        <tr>
                            <td>Id</td>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Total Products in Tree</td>
                            <td>Tree</td>
                            <td>
                                <a href="/portal/brands/add">
                                <i class="fa fa-plus-circle"></i>
                                </a>
                            </td>
                        </tr>

                        @foreach($brands as $brand )

                            <tr>
                                <td><div class="table-element">{{$brand->id}}</td>
                                <td ><div class="table-element"><img src="{{asset('/storage/brand_images').'/'.$brand->brand_image}}" height="50px"></div></td>
                                <td><div class="table-element">{{$brand->brand_name}}</div></td>
                                <td><div class="table-element">{{$brand->total_produts}}</div></td>
                                <td><div class="table-element">{{$brand->brand_name}}</div></td>
                                <td><div class="table-element">
                                    <a href="/portal/brands/edit/{{$brand->id}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/portal/brands/delete/{{$brand->id}}">
                                        <i class="fa fa-times remove"></i>
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
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[1];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>

</html>