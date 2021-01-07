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

    <title>Bamboo Recycle::Edit Sales Model</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Edit Sales Model</p>
                    </div>
                </div>
                <div class="add-product-container">
                    <form action="/portal/product/editbuyingproduct/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
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
                                            <option value="{{$brand->id}}" @if($product->brand_id === $brand->id) selected @endif >{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="brand" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($product->category_id === $category->id) selected @endif>{{$category->category_name}}</option>
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
                            <table class="portal-table" id="categories-table">
                                <tr>
                                    <td><div class="table-element">Memory</div></td>
                                    <td><div class="table-element">Excellent Working</div></td>
                                    <td><div class="table-element">Good Working</div></td>
                                    <td><div class="table-element">Damaged working</div></td>
                                </tr>

                                @foreach($productInformation as $key=>$pinfo)
                                <input type="hidden" name="memory-{{$pinfo->id}}" value="{{$pinfo->id}}">
                                <tr>
                                    <th><input class="table-element" value="{{$pinfo->memory}}" type="text" name="memory-{{$pinfo->id}}-new"></th>
                                    <th><input class="table-element" value="{{$pinfo->excellent_working}}" type="number" name="price{{$pinfo->id}}-1-new"></th>
                                    <th><input class="table-element" value="{{$pinfo->good_working}}" type="number" name="price{{$pinfo->id}}-2-new"></th>
                                    <th><input class="table-element" value="{{$pinfo->poor_working}}" type="number" name="price{{$pinfo->id}}-3-new"></th>
                                </tr>
                                @endforeach

                            </table>

                            <div class="portal-title-container">
                                <div class="portal-title">
                                    <p>Different Network Base Prices change in £</p>
                                </div>
                            </div>
                            <table class="portal-table sortable" id="categories-table">
                                <tr>
                                    @foreach($networks as $network)
                                    <td><div class="table-element"><img style="max-width:50px; width:50px" src="{{$network->getNetWorkImage($network->network_id)}}"></div></td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($networks as $network)
                                    <td><div class="table-element"><input class="table-element" value="{{$network->knockoff_price}}" type="number" name="network_{{$network->id}}"></div></td>
                                    @endforeach
                                </tr>
                            </table>
                            <div class="portal-title-container">
                                <div class="portal-title">
                                    <p>Available colours for the product</p>
                                </div>
                            </div>
                            <table class="portal-table" id="categories-table">
                                <tr>
                                    <td><div class="table-element"><input class="table-element" type="text" name="color_1"></div></td>
                                    <td><div class="table-element"><input class="table-element" type="text" name="color_2"></div></td>
                                    <td><div class="table-element"><input class="table-element" type="text" name="color_3"></div></td>
                                    <td><div class="table-element"><input class="table-element" type="text" name="color_4"></div></td>
                                    <td><div class="table-element"><input class="table-element" type="text" name="color_5"></div></td>
                                </tr>
                            </table>
                            <div class="portal-title-container">
                                <div class="portal-title">
                                    <p>Product information (Not required)</p>
                                </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_dimensions">Product Dimensions:</label>
                                    <input type="text" value="{{$product->product_dimensions}}" name="product_dimensions" id="product_dimensions">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_processor">Product Processor:</label>
                                    <input type="text" value="{{$product->product_processor}}" name="product_processor" id="product_processor">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_weight">Product Weight:</label>
                                    <input type="text" value="{{$product->product_weight}}" name="product_weight" id="product_weight">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_screen">Product Screen:</label>
                                    <input type="text" value="{{$product->product_screen}}" name="product_screen" id="product_screen">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_system">Product System:</label>
                                    <input type="text" value="{{$product->product_system}}" name="product_system" id="product_system">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_connectivity">Product Conectivity:</label>
                                    <input type="text" value="{{$product->product_connectivity}}" name="product_connectivity" id="product_connectivity">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_battery">Product Battery:</label>
                                    <input type="text" value="{{$product->product_battery}}" name="product_battery" id="product_battery">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_signal">Product Signal:</label>
                                    <input type="text" value="{{$product->product_signal}}" name="product_signal" id="product_signal">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_main_camera">Product main camera:</label>
                                    <input type="text" value="{{$product->product_camera}}" name="product_main_camera" id="product_main_camera">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_secondary_camera">Product secondary camera:</label>
                                    <input type="text" value="{{$product->product_camera_2}}" name="product_secondary_camera" id="product_secondary_camera" >
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_sim">Product SIM:</label>
                                    <input type="text" value="{{$product->product_sim}}" name="product_sim" id="product_sim">
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_memory_slots">Product Memory Slot:</label>
                                    <input type="text" value="{{$product->product_memory_slots}}" name="product_memory_slots" id="product_memory_slots">
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