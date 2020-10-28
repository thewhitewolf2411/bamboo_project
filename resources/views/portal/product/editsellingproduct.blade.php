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

    <title>Bamboo Recycle::Edit Salvage Product</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Edit Salvage Product</p>
                    </div>
                </div>
                <div class="add-product-container">
                    @if(Session::has('product_edited'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_edited')}}
                    </div>
                    @endif
                    <form action="/portal/product/editsellingproduct/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="product_id" type="hidden" value="{{$product->id}}" required>
                        <div class="product-tab">
                            <div class="form-group select_brand_button">
                                <label for="product_name">Product name:</label>
                                <input name="product_name" type="text" value="{{$product->product_name}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="brand">Brand:</label>
                                    <select class="form-control" id="brand" name="brand" required>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" >{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="brand" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <label for="product_color">Product color:</label>
                                <input name="product_color" type="text" value="{{$product->color}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <label for="product_network">Product network:</label>
                                <input name="product_network" type="text" value="{{$product->network}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <label for="product_memory">Product memory:</label>
                                <input name="product_memory" type="text" value="{{$product->memory}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_image">Product image:</label>
                                    <input name="product_image" type="file" accept="image/x-png,image/gif,image/jpeg" value="{{$product->product_image}}" required>
                                </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_grade">Product Grade:</label>
                                    <div class="d-flex">
                                        <div class="form-group mr-2">
                                            <input type="text" name="product_grade_1" value="Excellent working" readonly>
                                            <input type="text" name="product_grade_2" value="Good working" readonly>
                                            <input type="text" name="product_grade_3" value="Poor working" readonly>
                                            <input type="text" name="product_grade_4" value="Damaged working" readonly>
                                            <input type="text" name="product_grade_5" value="Faulty" readonly>
                                        </div>
                                        <div class="form-group ml-2">
                                            <input type="number" name="customer_grade_price_1" id="customer_grade_price_1" value="{{$product->customer_grade_price_1}}" placeholder="Enter price for grade 'Excellent working'">
                                            <input type="number" name="customer_grade_price_2" id="customer_grade_price_2" value="{{$product->customer_grade_price_2}}" placeholder="Enter price for grade 'Good working'">
                                            <input type="number" name="customer_grade_price_3" id="customer_grade_price_3" value="{{$product->customer_grade_price_3}}" placeholder="Enter price for grade 'Poor working'">
                                            <input type="number" name="customer_grade_price_4" id="customer_grade_price_4" value="{{$product->customer_grade_price_4}}" placeholder="Enter price for grade 'Damaged working'">
                                            <input type="number" name="customer_grade_price_5" id="customer_grade_price_5" value="{{$product->customer_grade_price_5}}" placeholder="Enter price for grade 'Faulty'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary btn-blue">Save changes</button>
                                  </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</body>