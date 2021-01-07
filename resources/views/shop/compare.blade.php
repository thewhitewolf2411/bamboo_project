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

        
        <title>Bamboo Mobile::Shopping</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">


        <meta name="csrf_token" content="{{ csrf_token() }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{asset('js/Price.js')}}"></script>
        <script src="{{asset('js/Compare.js')}}"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>

        <main>
            <div class="app">
                <div class="shop-top-header">
                    <div class="shop-search-container">
                        <div class="search-bar">
                            <form class="shop-search-form" action="/searchproducts" method="POST">
                                @csrf
                                <input type="text" placeholder="Search...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="shop-menu-container">

                        <div class="shop-menu-element">
                            <a href="/shop/category/latest"><div class="shop-link">Latest Offers</div></a>
                        </div>
                        <div class="shop-menu-element shop-dropdown">
                            <a href="/shop/category/mobile"><div class="shop-link">Shop Mobile Phones</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/tablets"><div class="shop-link">Shop Tablets</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/accesories"><div class="shop-link">Shop Accessories</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/watches"><div class="shop-link">Shop Watches</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/compare/"><div class="shop-link">Compare Models</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/why"><div class="shop-link">Why Shop With Us</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/let"><div class="shop-link">Let boo do it, for you</div></a>
                        </div>
                    </div>
                    <div class="trustpilot-container">
                        <div class="trustpilot-element">
                            <img src="{{asset('/customer_page_images/body/trustpilot.png')}}">
                        </div>
                        <div class="trustpilot-element">
                            <p>Over 65,000 reviews</p>
                        </div>
                        <div class="trustpilot-element">
                            <div class="green-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="green-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="green-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="green-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="green-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                    <div class="support-title-container">
                        <div class="center-title-container">
                            <p>Compare Phone Models</p>
                        </div>
                    </div>

                </div>
                <div class="row container mx-auto">
                
                    <div class="col-md-3">
                        <div class="d-flex flex-column" id="compare-device-1">
                            <div class="form-group">
                                <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone" id="compare-select-1" onchange="selectCompareProduct1(this)">
                                    <option value="" selected disabled>Search Device</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-100 d-flex my-3">
                                <img class="mx-auto" src="{{ asset('/sell_images/Add device.svg') }}" width="60%">
                            </div>

                            <button class="btn btn-secondary" href="" disabled>
                                Add a device
                            </button>

                            <div class="my-4">
                                <h3>SPECIFICATION</h3>
                            </div>

                            <div class="my-4">
                                <p class="border-bottom">Price range</p>
                                <p id="device-1-price-range"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Dimensions</p>
                                <p id="device-1-dimensions"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Weight</p>
                                <p id="device-1-weight"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Operating System</p>
                                <p id="device-1-operating-system"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Battery</p>
                                <p id="device-1-battery"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Camera</p>
                                <p id="device-1-camera"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Processor</p>
                                <p id="device-1-processor"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Screen Size</p>
                                <p id="device-1-screen-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Connectivity</p>
                                <p id="device-1-connectivity"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Signal</p>
                                <p id="device-1-signal"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Sim Size</p>
                                <p id="device-1-sim-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Memory Card Slots</p>
                                <p id="device-1-memory-slots"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex flex-column" id="compare-device-2">
                            <div class="form-group">
                                <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone" id="compare-select-2" onchange="selectCompareProduct2(this)">
                                    <option value="" selected disabled>Search Device</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-100 d-flex my-3">
                                <img class="mx-auto" src="{{ asset('/sell_images/Add device.svg') }}" width="60%">
                            </div>
                            

                            <button class="btn btn-secondary" href="" disabled>
                                Add a device
                            </button>

                            <div class="my-4">
                                <h3>SPECIFICATION</h3>
                            </div>

                            <div class="my-4">
                                <p class="border-bottom">Price range</p>
                                <p id="device-2-price-range"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Dimensions</p>
                                <p id="device-2-dimensions"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Weight</p>
                                <p id="device-2-weight"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Operating System</p>
                                <p id="device-2-operating-system"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Battery</p>
                                <p id="device-2-battery"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Camera</p>
                                <p id="device-2-camera"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Processor</p>
                                <p id="device-2-processor"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Screen Size</p>
                                <p id="device-2-screen-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Connectivity</p>
                                <p id="device-2-connectivity"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Signal</p>
                                <p id="device-2-signal"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Sim Size</p>
                                <p id="device-2-sim-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Memory Card Slots</p>
                                <p id="device-2-memory-slots"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex flex-column" id="compare-device-3">
                            <div class="form-group">
                                <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone" id="compare-select-3" onchange="selectCompareProduct3(this)">
                                    <option value="" selected disabled>Search Device</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-100 d-flex my-3">
                                <img class="mx-auto" src="{{ asset('/sell_images/Add device.svg') }}" width="60%">
                            </div>

                            <button class="btn btn-secondary" href="" disabled>
                                Add a device
                            </button>

                            <div class="my-4">
                                <h3>SPECIFICATION</h3>
                            </div>

                            <div class="my-4">
                                <p class="border-bottom">Price range</p>
                                <p id="device-3-price-range"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Dimensions</p>
                                <p id="device-3-dimensions"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Weight</p>
                                <p id="device-3-weight"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Operating System</p>
                                <p id="device-3-operating-system"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Battery</p>
                                <p id="device-3-battery"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Camera</p>
                                <p id="device-3-camera"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Processor</p>
                                <p id="device-3-processor"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Screen Size</p>
                                <p id="device-3-screen-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Connectivity</p>
                                <p id="device-3-connectivity"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Signal</p>
                                <p id="device-3-signal"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Sim Size</p>
                                <p id="device-3-sim-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Memory Card Slots</p>
                                <p id="device-3-memory-slots"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex flex-column" id="compare-device-4">
                            <div class="form-group">
                                <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone" id="compare-select-4" onchange="selectCompareProduct4(this)">
                                    <option value="" selected disabled>Search Device</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-100 d-flex my-3">
                                <img class="mx-auto" src="{{ asset('/sell_images/Add device.svg') }}" width="60%">
                            </div>

                            <button class="btn btn-secondary" href="" disabled>
                                Add a device
                            </button>

                            <div class="my-4">
                                <h3>SPECIFICATION</h3>
                            </div>

                            <div class="my-4">
                                <p class="border-bottom">Price range</p>
                                <p id="device-4-price-range"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Dimensions</p>
                                <p id="device-4-dimensions"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Weight</p>
                                <p id="device-4-weight"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Operating System</p>
                                <p id="device-4-operating-system"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Battery</p>
                                <p id="device-4-battery"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Camera</p>
                                <p id="device-4-camera"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Processor</p>
                                <p id="device-4-processor"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Screen Size</p>
                                <p id="device-4-screen-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Connectivity</p>
                                <p id="device-4-connectivity"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Signal</p>
                                <p id="device-4-signal"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Sim Size</p>
                                <p id="device-4-sim-size"></p>
                            </div>
                            <div class="my-4">
                                <p class="border-bottom">Memory Card Slots</p>
                                <p id="device-4-memory-slots"></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        <footer>@include('customer.layouts.footer')</footer>

    </body>



</html>