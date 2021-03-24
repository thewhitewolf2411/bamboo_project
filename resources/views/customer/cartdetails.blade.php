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
                            <p> Your details </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-breadcrumbs p-3 ml-5">
                <p class="black-cart-info-text m-0 mr-2">Basket</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="black-cart-info-text m-0 ml-2 mr-2">Your details</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="grey-cart-info-text m-0 ml-2">Confirmation</p>
            </div>

            @if(Session::has('success'))

            <div class="alert alert-success" role="alert">
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


                <div class="d-flex p-5 ml-5">

                    <div class="d-flex flex-column w-75">
                        <h3>Your details</h3>

                        <div class="trade-pack-type w-75">
                            <div class="col m-0 p-4">
                                <p class="title-trade-pack-type-large">How would you like to send your device?</p>
                                <p class="title-trade-pack-type">Please select how you would like to send your device(s) to us</p>

                                <div class="select-pack-type mt-4">

                                    <div class="order-label-print-type m-2" id="bamboo-print-selected" onclick="selectType('bamboo')">
                                        <div class="col p-0">
                                            <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_bamboo_trade_pack.svg')}}">
                                            <p class="order-label-print-text">FREE bamboo <br>Trade Pack</p>
                                            <img class="order-label-select-svg" id="bamboo-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                        </div>
                                    </div>

                                    <div class="order-label-print-type m-2" id="own-print-selected" onclick="selectType('own')">
                                        <div class="col p-0">
                                            <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                                            <p class="order-label-print-text">FREE print your <br>own label</p>
                                            <img class="order-label-select-svg" id="own-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>

                    </div>

                    <div class="d-flex flex-column w-25 pb-3 ml-2">
                        <div class="order-summary-cart flex-column">
                            <p class="order-summary-bold w-100">Order Summary</p>

                            @if($hasTradeOut)
                            <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                            @endif
                            
                            @if($hasTradeIn)
                                <div class="summary-cart">
                                    <p class="summary-cart-text">Subtotal</p>
                                    <p class="summary-cart-text">£{{$sellPrice}}</p>
                                </div>
                                <div class="summary-cart">
                                    <p class="summary-cart-text-bold">TOTAL</p>
                                    <p class="summary-cart-text-bold">£{{$sellPrice}}</p>
                                </div>
                                {{-- <select class="form-control my-3" onchange="changelabelstatus(this)">
                                    <option value="1" selected>Make an order without printing label</option>
                                    <option value="2">Print and send trade label yourself</option>
                                </select> --}}
                            @endif   
                        </div>

                        @if($hasTradeIn)
                        <div class="form-container">

                            <form action="/cart/sell" method="POST">
                                @csrf
                    
                                <input type="hidden" id="label_status" name="label_status" value="1">

                                <button type="submit" id="submit-sell" disabled class="btn btn-orange w-100 mt-2">Sell my device</button>
            
                            </form>
            
                            <script>
                                function changelabelstatus(value){
                                    document.getElementById('label_status').value = value.value;
                                }
                            </script>

                        </div>

                        @endif

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

        
        <div class="modal fade" tabindex="-1" role="dialog" id="payment-container">
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
        </div>
        

        </main>


        @if(session('showLogin'))
            <script>
                $(window).on('load',function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
        <footer>@include('customer.layouts.footer', ['showGetstarted' => false])</footer>    
    </body>
    <script>

        function selectType(type){
            let owndiv = document.getElementById('own-print-selected');
            let owntick = document.getElementById('own-print-selected-tick');
            let bamboodiv = document.getElementById('bamboo-print-selected');
            let bambootick = document.getElementById('bamboo-print-selected-tick');
            let ordertype = document.getElementById('label_status');

            if(type === 'own'){
                owndiv.classList.add('selected');
                bamboodiv.classList.remove('selected');
                owntick.src = '/customer_page_images/body/orange_selected.svg';
                bambootick.src = '/customer_page_images/body/orange_deselected.svg';
                ordertype.value = 2;
            }
            if(type === 'bamboo'){
                bamboodiv.classList.add('selected');
                owndiv.classList.remove('selected');
                owntick.src = '/customer_page_images/body/orange_deselected.svg';
                bambootick.src = '/customer_page_images/body/orange_selected.svg';
                ordertype.value = 1;
            }
            document.getElementById('submit-sell').disabled = false;
        }

        var rand = Math.floor(10000000 + Math.random() * 900000);
        document.getElementById('order_code').value = rand;

    </script>
</html>