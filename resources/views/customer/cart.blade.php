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

            <div class="center-title-container">
                <p style="display: flex; align-items: center;"><i style="color: #000; opacity: 1;" class="fa fa-keyboard-o" aria-hidden="true"></i>Basket</p>
            </div>

            <div class="d-flex p-5">

            @if(isset($cart))

                <div class="d-flex flex-column w-75">
                    <div class="center-title-container">
                        <p style="color: #23AAF7;">Buying items</p>
                    </div>
                    <div class="d-flex flex-column w-100">
                        @foreach($cart->items as $key=>$cartitem)
                            @if($cartitem['type'] == 'tradeout')
                                <div class="cart-product d-flex justify-content-between">
                                    <div class="cart-product-image w-25">
                                        <img src="{{$cartitem['product']->product_image}}">
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">{{$cartitem['product']->product_name}}</h6>
                                        <p class="m-0">Network: {{$cartitem['product']->product_network}}</p>
                                        <p class="m-0">Memory: {{$cartitem['product']->product_memory}}</p>
                                        <p class="m-0">Colour: {{$cartitem['product']->product_colour}}</p>
                                        <p class="m-0">Grade: {{$cartitem['product']->product_grade}}</p>
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">Item price</h6>
                                        <p class="m-0">Price: £{{$cartitem['product']->product_buying_price}}</p>
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">Total Price</h6>
                                        <p class="m-0 font-weight-bold">Total Price: £{{$cartitem['product']->product_buying_price}}</p>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                    <div class="center-title-container">
                        <p style="color: #F28E33;">Selling items</p>
                    </div>
                    <div class="d-flex flex-column w-100">
                        @foreach($cart->items as $key=>$cartitem)
                            @if($cartitem['type'] == 'tradein')
                                <div class="cart-product d-flex justify-content-between">
                                    <div class="cart-product-image w-25">
                                        <img src="{{$cartitem['product']->product_image}}">
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">{{$cartitem['product']->product_name}}</h6>
                                        <p class="m-0">Network: {{$cartitem['product']->product_network}}</p>
                                        <p class="m-0">Memory: {{$cartitem['product']->product_memory}}</p>
                                        <p class="m-0">Colour: {{$cartitem['product']->product_colour}}</p>
                                        <p class="m-0">Grade: {{$cartitem['product']->product_grade}}</p>
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">Item price</h6>
                                        <p class="m-0">Price: £{{$cartitem['price']}}</p>
                                    </div>
                                    <div class="d-flex flex-column w-25">
                                        <h6 class="m-0 mb-3 font-weight-bold">Total Price</h6>
                                        <p class="m-0 font-weight-bold">Total Price: £{{$cartitem['price']}}</p>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>

                <div class="d-flex flex-column w-25 p-3">
                    <div class="center-title-container">
                        <p style="display: flex; align-items: center;">Order Summary</p>
                    </div>

                    <div class="form-container">

                    

                        <form action="/cart/sell" method="POST">
                            @csrf
        
                            @foreach($cart->items as $key=>$cartitem)
        
                                <input type="hidden" name="ordertype-{{$key}}" value="{{$cartitem['type']}}">
                                <input type="hidden" name="orderproduct-{{$key}}" value="{{$cartitem['product']}}">
                                <input type="hidden" name="productprice-{{$key}}" value="{{$cartitem['price']}}">
        
                            @endforeach
        
                            <button type="submit" class="btn btn-primary w-100">Submit Order</button>
        
                        </form>
        
                    </div>
                </div>

            </div>

            @else

                Your basket is empty

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


        @if(session('showLogin'))
            <script>
                $(window).on('load',function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
        <footer>@include('customer.layouts.footer')</footer>    
    </body>
    <script>

        var rand = Math.floor(10000000 + Math.random() * 900000);
        document.getElementById('order_code').value = rand;

    </script>
</html>