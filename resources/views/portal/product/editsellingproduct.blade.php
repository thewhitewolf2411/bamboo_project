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

    <script src="{{ asset('js/Sellingproduct.js') }}"></script>

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
                                            <option value="{{$brand->id}}" @if($brand->id === $product->brand_id) selected @endif) >{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="brand" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category->id === $product->category_id) selected @endif)>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <label for="product_image">Product image:</label>
                                    <input name="product_image" type="file" accept="image/x-png,image/gif,image/jpeg" value="{{$product->product_image}}">
                                </div>
                            </div>
                            <div class="form-group select_brand_button">
                                <div class="form-group">
                                    <div class="portal-title-container">
                                        <div class="portal-title">
                                            <p>Different Memory Base Prices expressed in £</p>
                                        </div>
                                    </div>
                                    @if(Session::has('product_option_deleted'))
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('product_option_deleted')}}
                                    </div>
                                    @endif
                                    <table class="portal-table sortable" id="categories-table">
                                        <tr>
                                            <td><div class="table-element">Memory</div></td>
                                            <td><div class="table-element">Excellent Working</div></td>
                                            <td><div class="table-element">Good Working</div></td>
                                            <td><div class="table-element">Poor working</div></td>
                                            <td><div class="table-element">Damaged working</div></td>
                                            <td><div class="table-element">Faulty</div></td>
                                            <td><div class="table-element">Remove option</div></td>
                                        </tr>
                                        @foreach($productinformation as $info)
                                        <tr>
                                            <input type="hidden" name="info{{$info->id}}" value="{{$info->id}}">
                                            <th><input class="table-element" type="text" name="memory_{{$info->id}}" value="{{$info->memory}}" required></th>
                                            <th><input class="table-element" type="number" name="price1_{{$info->id}}" value="{{$info->excellent_working}}" required></th>
                                            <th><input class="table-element" type="number" name="price2_{{$info->id}}" value="{{$info->good_working}}" required></th>
                                            <th><input class="table-element" type="number" name="price3_{{$info->id}}" value="{{$info->poor_working}}" required></th>
                                            <th><input class="table-element" type="number" name="price4_{{$info->id}}" value="{{$info->damaged_working}}" required></th>
                                            <th><input class="table-element" type="number" name="price5_{{$info->id}}" value="{{$info->faulty}}" required></th>
                                            <th><div class="table-element">

                                            <a onclick="return confirm('Are you sure? This will delete this product option from customer view!')" href="/portal/product/removesellingproductoption/{{$info->id}}">
                                                <i class="fa fa-times remove"></i>
                                            </a>
                                            
                                            </div></th>
                                        </tr>
                                        @endforeach
                                        <tr id="newMemoryRow">
                                            <th><input class="table-element" type="text" name="memory_new"></th>
                                            <th><input class="table-element" type="number" name="price1_new"></th>
                                            <th><input class="table-element" type="number" name="price2_new"></th>
                                            <th><input class="table-element" type="number" name="price3_new"></th>
                                            <th><input class="table-element" type="number" name="price4_new"></th>
                                            <th><input class="table-element" type="number" name="price5_new"></th>
                                            <td><div class="table-element">

                                            <a onclick="cancelNewMemoryPoint()">
                                                <i class="fa fa-times remove"></i>
                                            </a>
                                            
                                            </div></td>
                                        </tr>
                                        <tr id="newMemoryRowButton">
                                            <th>
                                                <div class="table-element">
                                                    <a onclick="addNewMemoryPoint()">
                                                        <div class="btn btn-primary">
                                                            Add new memory point
                                                        </div>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>
                                    </table>

                                    <div class="portal-title-container">
                                        <div class="portal-title">
                                            <p>Different Network Base Prices change in £</p>
                                        </div>
                                    </div>
                                    <table class="portal-table" id="categories-table">
                                        <tr>
                                            @foreach($productnetworks as $network)
                                            <td><div class="table-element"><img style="max-width:50px; width:50px" src="{{$network->getNetWorkImage($network->network_id)}}"></div></td>
                                            @endforeach
                                            <td id="add_new_network_container"><div class="table-element" >
                                                <select class="form-control" name="add_new_network_id">
                                                    <option value="" selected disabled>Select new network</option>
                                                    @foreach($newNetworks as $newNetwork)
                                                    <option value="{{$newNetwork->id}}">{{$newNetwork->network_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div></td>
                                        </tr>
                                        <tr>
                                            @foreach($productnetworks as $network)
                                            <td><div class="table-element"><input class="table-element" type="number" name="network_{{$network->id}}" value="{{$network->knockoff_price}}" required></div></td>
                                            @endforeach
                                            @if(count($productnetworks) !== 5)
                                            <td id="add_new_network_price_container">
                                                <div class="table-element">
                                                    <input class="table-element" type="number" name="add_new_network_knockoffprice" placeholder="Knockoff price">
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @foreach($productnetworks as $network)
                                            <td><div class="table-element"><a title="Remove Network" onclick="return confirm('Are you sure? This will delete this product option from customer view!')" href="/portal/product/removesellingproductnetwork/{{$network->id}}"><i class="fa fa-times remove"></i></a></div></td>
                                            @endforeach
                                        </tr>
                                    </table>
                                    @if(count($productnetworks) !== 5)
                                    <div class="table-element mt-5">                                                
                                        <a onclick="addNewNetwork()">
                                            <div class="btn btn-primary" id="add_new_network_btn">
                                                Add new network
                                            </div>
                                        </a>
                                    </div>
                                    @else
                                    <div class="table-element">                                                
                                        Unable to add new network
                                    </div>
                                    @endif

                                    <div class="portal-title-container">
                                        <div class="portal-title">
                                            <p>Available product colours</p>
                                        </div>
                                    </div>
                                    <table class="portal-table" id="categories-table">
                                        <tr>
                                            @foreach($colors as $color)
                                            <td><div class="table-element"><input class="table-element" type="text" name="color_{{$color->id}}" value="{{$color->color_value}}"></div></td>
                                            @endforeach
                                            <td><div class="table-element"><input class="table-element" type="text" name="color_new" placeholder="Add new colour"></div></td>
                                        </tr>
                                    </table>

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