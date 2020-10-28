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

    <title>Bamboo Recycle::Edit Sale Model</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Edit Sale Model</p>
                    </div>
                </div>
                <div class="add-product-container">
                    @if(Session::has('product_edited'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('product_edited')}}
                    </div>
                    @endif
                    <form action="/portal/product/editbuyingproduct/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="product_id" type="hidden" value="{{$product->id}}" required>
                        <div class="product-tab">
                            <div class="form-group select_brand_button">
                                <label for="product_name">Product name:</label>
                                <input name="product_name" type="text" value="{{$product->product_name}}" required>
                            </div>
                            <div class="form-group select_brand_button">
                                <label for="wordbox_description">Product description:</label>
                                <textarea id="description" class="form-control" name="wordbox_description" required>{{$product->product_description}}</textarea>
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
                                <div class="form-group">
                                    <label for="product_image">Product image:</label>
                                    <input name="product_image" type="file" accept="image/x-png,image/gif,image/jpeg">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_network">Product Network:</label>
                                    <input type="text" name="product_network" id="product_network" value="{{$product->product_network}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_memory">Product Memory:</label>
                                    <input type="text" name="product_memory" id="product_memory" value="{{$product->product_memory}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_color">Product Color:</label>
                                    <input type="text" name="product_color" id="product_color" value="{{$product->product_colour}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_grade">Condition:</label>
                                    <select class="form-control" id="product_grade" name="product_grade" required>
                                        @foreach($conditions as $condition)
                                        <option value="{{$condition->name}}" >{{$condition->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_dimensions">Product Dimensions:</label>
                                    <input type="text" name="product_dimensions" id="product_dimensions" value="{{$product->product_dimensions}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_processor">Product Processor:</label>
                                    <input type="text" name="product_processor" id="product_processor" value="{{$product->product_processor}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_weight">Product Weight:</label>
                                    <input type="text" name="product_weight" id="product_weight" value="{{$product->product_weight}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_screen">Product Screen:</label>
                                    <input type="text" name="product_screen" id="product_screen" value="{{$product->product_screen}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_system">Product System:</label>
                                    <input type="text" name="product_system" id="product_system" value="{{$product->product_system}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_connectivity">Product Conectivity:</label>
                                    <input type="text" name="product_connectivity" id="product_connectivity" value="{{$product->product_connectivity}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_battery">Product Battery:</label>
                                    <input type="text" name="product_battery" id="product_battery" value="{{$product->product_battery}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_signal">Product Signal:</label>
                                    <input type="text" name="product_signal" id="product_signal" value="{{$product->product_signal}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_main_camera">Product main camera:</label>
                                    <input type="text" name="product_main_camera" id="product_main_camera" value="{{$product->product_camera}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_secondary_camera">Product secondary camera:</label>
                                    <input type="text" name="product_secondary_camera" id="product_secondary_camera" value="{{$product->product_camera_2}}" >
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_sim">Product SIM:</label>
                                    <input type="text" name="product_sim" id="product_sim" value="{{$product->product_sim}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_memory_slots">Product Memory Slot:</label>
                                    <input type="text" name="product_memory_slots" id="product_memory_slots" value="{{$product->product_memory_slots}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_quantity">Product Quantity:</label>
                                    <input type="number" name="product_quantity" id="product_quantity" value="{{$product->product_quantity}}" required>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_price">Product Buying Price:</label>
                                    <input type="number" name="product_buying_price" id="product_buying_price" value="{{$product->product_buying_price}}">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary btn-blue">Save product</button>
                                  </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</body>