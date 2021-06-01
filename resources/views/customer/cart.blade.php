<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>

        
        <title>Bamboo Mobile</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="https://try.access.worldpay.com/access-checkout/v1/checkout.js"></script>
        <script src="{{ asset('/js/Payment.js')}} "></script>
        <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="shop-top-header" style="margin: 0;">
                <div class="center-title-container">
                    <div class="let-top-container">
                        <div class="center-title-container">
                            <p> Basket </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-breadcrumbs p-3 ml-5">
                <p class="black-cart-info-text m-0 mr-2">Basket</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="grey-cart-info-text m-0 ml-2 mr-2">Your details</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_grey.svg')}}">
                <p class="grey-cart-info-text m-0 ml-2">Confirmation</p>
            </div>

            @if(Session::has('success'))

                <div class="alert alert-success w-50 m-auto text-center" role="alert">
                    {{Session::get('success')}}
                </div>

            @endif


                @if(Session::has('barcode'))

                    <script>
                        $.ajax({
                            url: "/cart/printtradein",
                            method:"POST",
                            data:{
                                _token: "{!! csrf_token() !!}",
                                user:{!! Auth::User() !!},
                                tradein:{!! Session::get('tradein') !!},
                                
                            },
                            success:function(response){
                                console.log(response['code'], response.code);
                                if(response['code'] == 200){
                                    $('#tradein-iframe').attr('src', '/' + response['filename']);
                                    $('#label-trade-in-modal').modal('show');
                                }
                            },
                        });
                    </script>

                @endif

                @if(isset($cart) && count($cart)>0)

                    @if($cart->count() < 2)
                        @include('partial.sellsearch', ['title' => 'More devices to sell?', 'info' => 'Use the search bar below to find your specific device'])
                    @endif

                    <div class="d-flex p-5 basket-details-container">

                        <div class="d-flex flex-column w-75 basket-device-details">

                            {{-- @if($hasTradeOut)
                                <div class="left-title-container">
                                    <img src="{{asset('/shop_images/Icon-Shop.svg')}}">
                                    <p class="mx-3 mt-3">Basket</p>
                                </div>
                            @endif --}}

                            {{-- <div class="d-flex flex-column w-100"> --}}

                                {{-- @foreach($cart as $key=>$cartitem)
                                    @if($cartitem->type === 'tradeout')
                                        <div class="cart-product row justify-content-between mt-3">
                                            <div class="cart-product-image w-25">
                                                <img src="{{asset('/storage/product_images').'/' . $cartitem->getProductImage($cartitem->id)}}">
                                            </div>
                                            <div class="d-flex flex-column w-25">
                                                <h6 class="m-0 mb-3 font-weight-bold">{{$cartitem->getProductName($cartitem->id)}}</h6>
                                                <p class="m-0">Network: {{$cartitem->network}}</p>
                                                <p class="m-0">Memory: {{$cartitem->memory}}</p>
                                                <p class="m-0">Grade: {{$cartitem->grade}}</p>
                                            </div>
                                            <div class="d-flex flex-column w-25">
                                                <h6 class="m-0 mb-3 font-weight-bold">Item price</h6>
                                                <p class="m-0">Offered Price: £{{$cartitem->price}}</p>
                                            </div>
                                            <div class="d-flex flex-column w-25">
                                                <h6 class="m-0 mb-3 font-weight-bold">Total Price</h6>
                                                <p class="m-0 font-weight-bold">Total Price: £{{$cartitem->price}}</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="w-50"></div>
                                            <a href="/removefromcart/{{$key}}" class="w-25 m-0">
                                                <div class="">
                                                    <p class="m-0" style="">REMOVE</p>
                                                </div>
                                            </a>
                                            <a href="" class="w-25 m-0">
                                                <div class="">
                                                    <p class="m-0" style="">Move to wishlist</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach --}}

                            {{-- </div> --}}

                            @if($hasTradeIn)
                                {{-- <div class="left-title-container"> --}}
                                <div class="basket-title-container">
                                    <img class="basket-summary-icon" src="{{asset('/shop_images/Icon-Sell.svg')}}">
                                    <p class="basket-summary-title">Basket - Trade in</p>
                                </div>
                                {{-- </div> --}}
                            @endif

                            {{-- <div class="d-flex flex-column w-100"> --}}

                            @foreach($cart as $key=>$cartitem)
                                @if($cartitem->type === 'tradein')

                                    <div class="cart-product d-flex justify-content-between mt-3">
                                        {{-- <div class="cart-product-image w-25">
                                            <img src="{{asset('/storage/product_images').'/' . $cartitem->getProductImage($cartitem->id)}}" width="80%">
                                        </div> --}}
                                        <div class="d-flex flex-column w-25 cart-product-single-column">
                                            <h6 class="m-0 mb-3 summary-cart-text-bold-large">{{$cartitem->getProductName($cartitem->id)}}</h6>
                                            <p class="m-0 summary-regular-text">Network: {{$cartitem->network}}</p>
                                            <p class="m-0 summary-regular-text">Memory: {{$cartitem->memory}}</p>
                                            <p class="m-0 summary-regular-text">Grade: {{$cartitem->grade}}</p>
                                        </div>
                                        <div class="d-flex flex-column w-25 cart-product-single-column">
                                            <h6 class="m-0 mb-3 summary-cart-text-bold">Item price</h6>
                                            <p class="m-0 summary-regular-text">£{{$cartitem->price}}</p>
                                        </div>
                                        <div class="d-flex flex-column w-25 cart-product-single-column">
                                            <h6 class="m-0 mb-3 summary-cart-text-bold">Quantity</h6>
                                            <p class="m-0 cart-text-bold">1</p>
                                        </div>
                                        <div class="d-flex flex-column w-25 cart-product-single-column">
                                            <h6 class="m-0 mb-3 summary-cart-text-bold">Total Price</h6>
                                            <p class="m-0 summary-cart-text-bold">£{{$cartitem->price}}</p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="w-25"></div>

                                        @if(Auth::user())
                                            <a href="/removefromcart/{{$cartitem->id}}" class="w-25 m-0">
                                                <div class="">
                                                    <p class="m-0 pl-2 summary-regular-text">REMOVE</p>
                                                </div>
                                            </a>
                                        @else
                                            <a href="/removefromabandoned/{{$cartitem->id}}" class="w-25 m-0">
                                                <div class="">
                                                    <p class="m-0 pl-2 summary-regular-text">REMOVE</p>
                                                </div>
                                            </a>
                                        @endif

                                        <div class="w-25 remove-from-cart-tohide"></div>
                                        <div class="w-25"></div>
                                    </div>

                                @endif

                            @endforeach

                            {{-- </div> --}}

                        </div>

                        <div class="d-flex flex-column w-25 p-3 basket-summary">
                            <div class="order-summary-cart margin-top flex-column">
                                <p class="order-summary-bold w-100">Order Summary</p>

                                @if($hasTradeOut)
                                <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                                @endif
                                
                                @if($hasTradeIn)
                                    <div class="summary-cart">
                                        <p class="summary-cart-text-total">Subtotal</p>
                                        <p class="summary-cart-text-total">£{{$sellPrice}}</p>
                                    </div>
                                    <div class="summary-cart">
                                        <p class="summary-cart-text-bold-total">TOTAL</p>
                                        <p class="summary-cart-text-bold-total">£{{$sellPrice}}</p>
                                    </div>
                                    {{-- <select class="form-control my-3" onchange="changelabelstatus(this)">
                                        <option value="1" selected>Make an order without printing label</option>
                                        <option value="2">Print and send trade label yourself</option>
                                    </select> --}}
                                @endif   
                            </div>
                            {{-- <p style="text-align: center;">Before submitting your order, be sure to read <br> <a style="color:blue;" href="/terms" target="_blank"> our terms and conditions </a>.</p> --}}

                            @if($hasTradeOut)
                            <div class="form-container">

                                <form onsubmit="return showPaymentDetails()" action="/cart/sell" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-blue w-100">Checkout</button>
                
                                </form>
                
                                <script>
                                    function changelabelstatus(value){
                                        document.getElementById('label_status').value = value.value;
                                    }
                                </script>

                            </div>

                            @endif

                            @if($hasTradeIn)
                            <div class="form-container">

                                {{-- <form action="/cart/sell" method="POST"> --}}
                                    {{-- @csrf --}}
                                    {{-- <input type="hidden" id="label_status" name="label_status" value="1"> --}}
                                    {{-- Set testing cart to 50 23.04.2021 --}}
                                    @if(App\Helpers\CartHelper::cartItems() > 15000)
                                        <button id="addToCart" class="btn btn-primary btn-orange w-100 mt-2" data-toggle="modal" data-target="#newOrderModal">Sell my device</button>
                                    @else
                                        <a href="/cart/details" class="btn start-selling cart mt-2"><p>Sell my device</p></a>
                                    @endif

                                    @if($cart->count() < 2)
                                        <a class="btn cart-purple basket mt-2" href="/sell"><p>More devices to Sell?</p></a>
                                    @endif
                
                                {{-- </form> --}}
                
                                <script>
                                    function changelabelstatus(value){
                                        document.getElementById('label_status').value = value.value;
                                    }
                                </script>

                            </div>

                            @endif

                        </div>

                    </div>

                @else
                    <h4 class="text-center">No devices in basket.</h4>
                    @include('partial.sellsearch', ['title' => 'More devices to sell?', 'info' => 'Use the search bar below to find your specific device'])

                @endif

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

        <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trade pack label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="tradein-iframe"></iframe>
                </div>
                </div>
            </div>
		</div>

        
        {{-- <div class="modal fade" tabindex="-1" role="dialog" id="payment-container">
            <section class="modal-dialog" role="document">
                <section class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <section class="modal-body">
                        <section class="container">
                            <section class="card">
                            <form action="/cart/buy" id="paymentForm" method="post">
                                <span id="paymentErrors"></span>
                                @csrf

                                <input type="hidden" name="price" value="{{$fullprice}}">
                                <div class="form-row">
                                    <label>Name on Card</label>
                                    <input data-worldpay="name" name="name" type="text" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" />
                                </div>
                                <div class="form-row">
                                    <label>Card Number</label>
                                    <input data-worldpay="number" name="card_number" size="20" type="number" />
                                </div>
                                <div class="form-row">
                                    <label>Expiration (MM/YYYY)</label> 
                                    <input data-worldpay="exp-month" name="exp_month" size="2" type="number" /> 
                                    <label> / </label>
                                    <input data-worldpay="exp-year" name="exp_year" size="4" type="number" />
                                </div>
                                <div class="form-row">
                                    <label>CVC</label>
                                    <input data-worldpay="cvc" size="4" type="text" />
                                </div>
                                <input type="submit" value="Place Order" />
                            </form>
                            </section>
                        </section>
                    </section>

                </section>
            </section>
        </div> --}}

        <div class="modal fade" id="newOrderModal" tabindex="-1" role="dialog" aria-labelledby="newOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                {{-- <div class="modal-header">
                  <h5 class="modal-title" id="newOrderModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> --}}
                <div class="modal-body p-5">
                    <img class="close-neworder-modal" src="{{ asset('/images/front-end-icons/close_modal_orange.svg') }}" data-dismiss="modal" aria-label="Close">
                    <div class="new-order-info-row">
                        <div class="col">
                            <img class="newOrderPopupImg" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                            <p class="uhoh-info-neworder">Uh-oh!</p>
                        </div>
                        <p class="newOrderText w-75">
                            We are sorry Boo is only able to process two device at once, if you with you wish to sell more devices, 
                            please complete this order first and then create a new order.
                        </p>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div> --}}
              </div>
            </div>
          </div>
        

        </main>
        

        </main>


        {{-- @if(session('showLogin'))
            <script>
                $(window).on('load',function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif --}}
        <footer>@include('customer.layouts.footer', ['showGetstarted' => false])</footer>    
    </body>
    <script>

        var rand = Math.floor(10000000 + Math.random() * 900000);
        document.getElementById('order_code').value = rand;

    </script>
</html>