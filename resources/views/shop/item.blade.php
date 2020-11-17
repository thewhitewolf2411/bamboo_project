

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
                            <a href="/shop/category/compare"><div class="shop-link">Compare Models</div></a>
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


                </div>

                <div class="single-product-container">

                    <div class="product-image-container">
                        <img src="{{asset('/storage/product_images').'/'.$itemData->product_image}}">
                    </div>
                    <div class="product-data">
                        <div class="product-selected product-name-container">
                            <p class="product-title">{{$itemData->product_name}}</p>
                        </div>
                        <div class="product-selected product-network-container">
                            <p>Product Network:</p>
                        </div>
                        <div class="product-selected product-memory-container">
                            <p>Product Memory:</p>
                            <p>{{$itemData->product_memory}}</p>
                        </div>
                        <div class="product-selected">
                            <p>Product Colour:</p>
                            <div class="product-color-container" style="background: {{$itemData->product_colour}}"></div>
                        </div>
                        <div class="product-selected product-grade-container">
                            <p>Product Grade:</p>
                            <p>{{$itemData->product_grade}}</p>
                        </div>
                        <div class="product-selected product-price-container">
                            <p>Product price:</p>
                            <p>£{{$itemData->product_buying_price}}</p>
                        </div>
                        @if(Auth::user())
                        <div class="add-to-container">
                            <form action="/addtocart" method="POST">
                                <div class="add-to-cart-container">
                                    @csrf
                                    <input type="hidden" name="productid" value="{{$itemData->id}}">
                                    <button type="submit" class="btn btn-primary btn-blue">Add to Basket</button>
                                </div>
                            </form>
                            <form action="/addtowishlist" method="POST">
                                <div class="add-to-wishlist-container">
                                    @csrf
                                    <input type="hidden" name="productid" value="{{$itemData->id}}">
                                    <button type="submit" class="btn btn-primary btn-orange">Add to Wishlist</button>
                                </div>
                            </form>

                            @if(Session::has('productaddedtocart'))
                                <p>Product was added to the cart. </p>
                            @endif
                        </div>
                        @else
                        <div class="add-to-container">
                            <div class="add-to-cart-container">
                                <button type="submit" class="btn btn-primary btn-blue" onclick="showModal()">Add to Basket</button>
                            </div>

                            <div class="add-to-wishlist-container">
                                <button type="submit" class="btn btn-primary btn-orange" onclick="showModal()">Add to Wishlist</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="assurance-container">
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-1.svg')}}">
                        <p>FREE NEXT DAY NATIONWIDE DELIVERY</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-2.svg')}}">
                        <p>BAMBOO QUALITY APPROVED OVER 100 FUNCTIONAL CHECKS</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-3.svg')}}">
                        <p>NO QUIBBLE MONEY BACK</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-4.svg')}}">
                        <p>12 MONTH GUARANTEE</p>
                    </div>
                </div>
                <div class="shop-spilt">
                    <div class="shop-split-image">
                        <img src="{{asset('/shop_images/shop_split_image.png')}}">
                    </div>
                    <div class="shop-split-text">
                        <div class="shop-split-text-container">
                            <p class="shop-title">Spoilt for choice?</p>
                            <p class="category-title">Use our handy comparison tool <br> to find the best option for you.</p>
                        </div>
                        <div class="shop-split-arrow">
                            <img src="">
                        </div>
                    </div>
                </div>

                <div class="product-description-container">
                    <div class="product-description-left">
                        <p class="left-title-text">DESCRIPTION</p>
                        <div class="product-description-text">
                            <p><strong>And then there was Pro</strong></p>
                            <p class="description-text">{{$itemData->product_description}}</p>
                        </div>
                    </div>

                    <div class="product-description-right">
                        <p class="left-title-text">SPECIFICATIONS</p>
                        <div class="product-description-data">
                            <div class="product-description-data-text">
                                <p class="product-description-title">Dimensions</p>
                                <p>{{$itemData->product_dimensions}} mm</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Processor</p>
                                <p>{{$itemData->product_processor}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Weight</p>
                                <p>{{$itemData->product_weight}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Screen size</p>
                                <p>{{$itemData->product_screen}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Operating System</p>
                                <p>{{$itemData->product_system}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Connectivity</p>
                                <p>{{$itemData->product_connectivity}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Battery</p>
                                <p>{{$itemData->product_battery}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title"> Signal</p>
                                <p>{{$itemData->product_signal}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Camera</p>
                                <p>{{$itemData->product_camera}}</p>
                                @if($itemData->product_camera_2 !== null)
                                <p>{{$itemData->product_camera_2}}</p>
                                @endif
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Sim Size</p>
                                <p>{{$itemData->product_sim}}</p>
                            </div>
                            <div class="product-description-data-text">
                                <p class="product-description-title">Memory Card Slots</p>
                                <p>{{$itemData->product_memory_slots}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bl-100"></div>

                <div class="warranty-container">

                    <div class="product-description-left">
                        <p class="left-title-text">WARRANTY</p>
                        <div class="product-description-text">
                            <p class="description-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus. Mauris blandit dolor sit amet posuere hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean at erat tempor, aliquam orci vitae, rutrum lorem. Etiam nec semper lorem.</p>
                        </div>
                    </div>

                    <div class="product-description-right">
                        <div class="assurance-element">
                            <img src="{{asset('/customer_page_images/body/Assurance-image-3.svg')}}">
                            <p>NO QUIBBLE MONEY BACK</p>
                        </div>
                        <div class="assurance-element">
                            <img src="{{asset('/customer_page_images/body/Assurance-image-4.svg')}}">
                            <p>12 MONTH GUARANTEE</p>
                        </div>
                    </div>

                </div>

                <div class="bl-100"></div>

                <div class="home-element sign-up">
        
                    <div class="center-title-container">
                        <p>Sign up to our newsletter!</p>
                    </div>
            
                    <div class="text-center-container">
                        <p>amazing offers, hints and tips and just awesome-ness</p>
                    </div>
            
                    <form action="/" method="POST">
                        @csrf
            
                        <input class="email-input" type="email" placeholder="Enter email address here">
                        <input class="email-submit" type="submit" value="Sign me up!">
            
                    </form>
            
                </div>

            </div>

            @if(session('showLogin') || $errors->all())
                <script>
                    $(window).on('load',function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-first-element">
                                <div class="register-elements-container">
                                    <h3>New Customers</h3>
                                    <button onclick="showRegistrationForm()" class="btn btn-primary">
                                        Sign up
                                    </button>
                                </div>

                                <div class="login-form-container">
                                    <h3>Sign in</h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username or Email" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-0" style="display:flex; flex-direction: row; justify-content:space-between; align-items:center;">
                                            @if (Route::has('password.request'))
                                                <a class="btn-link" style="color: #000; margin:0;" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>    
                                    </form>
                                </div>
                            </div>
                            <div class="modal-second-element">
                                <div class="register-form-container">
                                    @include('auth.register')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>@include('customer.layouts.footer')</footer>

        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

            function showModal(){
                $('#loginModal').modal('show');
            }

        </script>
    </body>



</html>